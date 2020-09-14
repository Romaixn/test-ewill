<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ProductFixtures extends Fixture
{
	private $faker;

	public function __construct()
	{
		$this->faker = Faker\Factory::create('fr_FR');
	}

    public function load(ObjectManager $manager)
    {
		$photos = [
			'cat-cloth.jpg',
			'cat-grif.jpg',
			'junior-chicken.png'
		];
		
		for ($i = 0; $i < 20; ++$i) {
			$product = (new Product())
				->setReference($this->faker->ean13())
				->setName($this->faker->words(3, true))
				->setDescription($this->faker->paragraph(3, true))
				->setPrice($this->faker->randomFloat(2, 0, 50))
				->setPhotoFilename($this->faker->randomElement($photos))
			;

			$manager->persist($product);
		}

        $manager->flush();
    }
}
