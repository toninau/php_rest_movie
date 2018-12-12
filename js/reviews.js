'use strict';

//Haku funktio. Hakee haku tulokset palvelimelta JSON muotoisena.
function search(event) {
	var str = document.getElementById('search').value;
	var div = document.getElementById('items');
	div.innerHTML = '';
	// Hakupalkissa merkkejä
	if (str.length > 0) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var results = JSON.parse(xmlhttp.responseText);
				// Ei hakutuloksia, palvelin antaa { message: 'Ei arvosteluja' }
				if (results.message == 'Ei arvosteluja') {
					var write = document.createElement('h1');
					write.className = 'center-text';
					write.innerHTML = 'No search results';
					div.appendChild(write);
				} else {
					for (var i = 0; i < results.length; i++) {
						var section = document.createElement('section');
						section.className = 'review';
						var stars = '';
						// Täydet tähdet
						for (var j = 0; j < results[i].arvosana; j++) {
							stars += '&#9733';
						}
						// Tyhjät tähdet
						for (var j = 0; j < 5-results[i].arvosana; j++) {
							stars += '&#9734';
						}
						// HTML muotoilu tiedoille
						section.innerHTML = '<h3>' + results[i].nimi + '</h3>' +
							'<dl>' +
								'<dt>Comment</dt>' +
								'<dd>' + results[i].kommentti + '</dd>' +
								'<dt>Rating</dt>' +
								'<dd>' + stars + '</dd>' +
								'<dt>Time</dt>' +
								'<dd>' + results[i].aika + '</dd>' +
							'</dl>';
						div.appendChild(section);
					}
				}
			}
		};
		xmlhttp.open('GET', 'api/review/read_byname.php?nimi=' + str, true);
		xmlhttp.send();
	} else {
		//hakupalkissa ei ole merkkejä
		var write = document.createElement('h1');
		write.className = 'center-text';
		write.innerHTML = 'Type into the search box';
		div.appendChild(write);
	}
	event.preventDefault();
}

// Lähettää lomakkeen tiedot JSON muodossa palvelimelle.
function processForm(event) {
	var name = document.getElementById('name').value;
	var comment = document.getElementById('comment').value;
	var rating = document.getElementById('rating').value;
	var json = {
		'nimi': name,
		'kommentti': comment,
		'arvosana': rating
	};
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result = JSON.parse(xmlhttp.responseText);
			alert(result.message);
		}
	};
	xmlhttp.open('POST', 'api/review/create.php', true);
	//Headerit
	xmlhttp.setRequestHeader('Content-type', 'application/json');
	var data = JSON.stringify(json);
	xmlhttp.send(data);
	// Estää sivun uudelleen lataamisen
	event.preventDefault();
	// Resetoi formin, kun se lähetetään
	document.getElementById('theForm').reset();
	// Sulkee formin, kun se lähetetään
	closeForm();
}

// Avaa formin/lomakkeen
function openForm() {
	document.getElementById('myForm').style.display = 'block';
	document.getElementById('myBtn').style.display = 'none';
}

// Sulkee formin/lomakkeen
function closeForm() {
	document.getElementById('myForm').style.display = 'none';
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		document.getElementById('myBtn').style.display = 'block';
	}
}

// suoritetaan, kun ikkuna latautunut
function init() {
	document.getElementById('search-form').onsubmit = search;
	document.getElementById('theForm').onsubmit = processForm;
}

window.onload = init;