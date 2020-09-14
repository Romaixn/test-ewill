document.addEventListener("DOMContentLoaded", function () {
	let elem = document.getElementsByClassName("nav-button");

	Array.from(elem).forEach((element) => {
		element.addEventListener("click", () => {
			document.getElementById('close-icon').classList.toggle('hidden');
			document.getElementById('close-icon').classList.toggle('block');
			document.getElementById('open-icon').classList.toggle('hidden');
			document.getElementById('open-icon').classList.toggle('block');
			document.getElementById("nav-mobile").classList.toggle("hidden");
			document.getElementById("nav-mobile").classList.toggle("block");
		});
	});
});
