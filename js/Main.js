async function ShortIt() {
	// the input URL
	let url = document.querySelector('#url').value;

	// send request (method: GET) and return a response as JSON type
	let response = await fetch('php/Main.php?url=' + url).then(res => res.json());

	// displaying the output (response) btw thanks SweetAlert <3
	Swal.fire(response.message, response.url, response.icon);
}