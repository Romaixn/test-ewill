<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findBy([], ['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request, string $imgDir): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();

			if ($photo = $form['photo']->getData()) {
				$filename = bin2hex(random_bytes(6)).'.'.$photo->guessExtension();

                try {
                    $photo->move($imgDir, $filename);
                } catch (FileException $e) {
                    // upload fail
				}

                $product->setPhotoFilename($filename);
			}

            $entityManager->persist($product);
			$entityManager->flush();
			
			$this->addFlash('success', 'Produit créé avec succès !');

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product, string $imgDir): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			
			if ($photo = $form['photo']->getData()) {
				$filename = bin2hex(random_bytes(6)).'.'.$photo->guessExtension();

				try {
					$photo->move($imgDir, $filename);
				} catch (FileException $e) {
					// upload fail
				}

				$product->setPhotoFilename($filename);
			}

			$this->getDoctrine()->getManager()->flush();
			
			$this->addFlash('success', 'Produit modifié avec succès');

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
			$entityManager->flush();
			$this->addFlash('success', 'Produit supprimé avec succès');
        }

        return $this->redirectToRoute('product_index');
    }
}
