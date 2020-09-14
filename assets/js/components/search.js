let input = document.getElementById("searchProduct");

input.addEventListener('keyup', (e) => {
	let filter = input.value.toUpperCase();
	let table = document.getElementById("tableProduct");
	let tr = table.getElementsByTagName("tr");

	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
			txtValue = td.textContent || td.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
});