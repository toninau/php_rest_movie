'use strict';

//Haku funktio. Hakee haku tulokset palvelimelta JSON muotoisena.
function search(event) {
	var str = document.getElementById('search').value;
	var div = document.getElementById('items');
	// Tyhjentää divin arvosteluista jne. mukamas nopeammin kuin div.innerHTML='';
	while (div.firstChild) {
		div.removeChild(div.firstChild);
	}
	// Hakupalkissa merkkejä
	if (str.length > 0) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var results = JSON.parse(xmlhttp.responseText);
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
					// Kuvan asetus
					var url = 'img/nopicture.png';
					if (results[i].kuva !== null) {
						url = results[i].kuva;
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
						'</dl>' +
						'<img class="review-img" src="' + url + '" onerror="this.onerror=null;this.src=\'img/nopicture.png\';"/>';
					div.appendChild(section);
					if (i === 0) {
						section.scrollIntoView({behavior: 'smooth', block: 'end', inline: 'nearest'});
					}
				}
			} else if (xmlhttp.readyState == 4 && xmlhttp.status == 404) {
				var results = JSON.parse(xmlhttp.responseText);
				// Ei hakutuloksia, palvelin antaa { message: 'Ei arvosteluja' }
				var write = document.createElement('h1');
				write.className = 'center-text';
				write.innerHTML = results.message;
				div.appendChild(write);
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
	div.scrollIntoView({behavior: 'smooth', block: 'end', inline: 'nearest'});
	event.preventDefault();
}

// Lähettää lomakkeen tiedot JSON muodossa palvelimelle.
function processForm(event) {
	var name = document.getElementById('name').value;
	var comment = document.getElementById('comment').value;
	var rating = document.getElementById('rating').value;
	var image = document.getElementById('image').value;
	var json = {
		'nimi': name,
		'kommentti': comment,
		'arvosana': rating,
		'kuva': image
	};
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result = JSON.parse(xmlhttp.responseText);
			alert(result.message);
		} else if (xmlhttp.readyState == 4 && xmlhttp.status == 405) {
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
	document.getElementById('top-btn').style.display = 'none';
}

// Sulkee formin/lomakkeen
function closeForm() {
	document.getElementById('myForm').style.display = 'none';
	document.getElementById('top-btn').style.display = 'block';
}

//Käyttäjän painaessa nappulaa, scrollaa documentin yläosaan
function topFunction() {
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// suoritetaan, kun ikkuna latautunut
function init() {
	document.getElementById('search-form').onsubmit = search;
	document.getElementById('theForm').onsubmit = processForm;
	document.getElementById('top-btn').onclick = topFunction;
	document.getElementById('cancel').onclick = closeForm;
	document.getElementById('open-button').onclick = openForm;
}

window.onload = init;