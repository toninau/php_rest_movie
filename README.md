# Movie-Reviews

Made by: Toni Naumanen<br>
includes: REST-api, database, user interface. <br>
Database is in Finnish. JavaScript and Php comments are also in Finnish.

## REST-api

Rest-api description is in Finnish and English.

### Create

.../api/review/create.php

Luo arvostelun. ID annetaan automaattisesti. <br>
Creates review. ID is given automatically.

```
Example:
POST http://localhost/.../api/review/create.php
Content-Type: application/json

{
	"nimi": "test",
	"kommentti": "test",
	"arvosana": 5
}
```

Arvostelun luonti onnistui. <br>
The review was successfully created.


```
{
	"message": "Review created"
}
```

Arvostelun luonti epäonnistui. <br>
Failed to create review.

```
{
	"message": "Failed to create review"
}
```

### Delete

.../api/review/delete.php

Poistaa arvostelun id:n perusteella. <br>
Deletes the review based on the id.

```
Example:
DELETE http://localhost/.../api/review/delete.php
Content-Type: application/json

{
	"id": 6
}
```

Arvostelun poisto onnistui. <br>
The review was successfully deleted.

```
{
	"message": "Arvostelu poistettu"
}
```

Arvostelun poisto epäonnistui. <br>
Failed to delete the review.

```
{
	"message": "Arvostelua ei poistettu"
}
```

### Read

.../api/review/read.php

Hakee tietokannan kaikki arvostelut. Palauttaa listan, jos arvosteluja löytyi. <br>
Retrieves all the reviews from the database. Returns an array if reviews were found.


```
Example:
GET http://localhost/.../api/review/read.php
```

Arvosteluja löytyi. <br>
Reviews were found.

```
[
    {
        "id": "1",
        "nimi": "jasmine test",
        "kommentti": "test",
        "arvosana": "5",
        "kuva": null,
        "aika": "2018-12-02 18:00:36"
    },
    ...
    }
]
```

Arvosteluja ei löytynyt. <br>
Reviews were not found.

```
{
	"message": "Ei arvosteluja"
}
```

### Read_byname

.../api/review/read_byname.php?nimi=...

Hakee tietokannasta arvostelun/arvostelut elokuvan nimen perusteella. Palauttaa listan, jos arvosteluja löytyi. <br>
Retrieves reviews based on the movie's title. Returns an array if reviews were found.
 

```
Example:
GET http://localhost/.../api/review/read_byname.php?nimi=j
```

Arvosteluja löytyi. <br>
Reviews were found.

```
[
    {
        "id": "1",
        "nimi": "jasmine test",
        "kommentti": "test",
        "arvosana": "5",
        "kuva": null,
        "aika": "2018-12-02 18:00:36"
    }
]

```

Arvosteluja ei löytynyt. <br>
Reviews were not found.

```
{
	"message": "No reviews found"
}
```

### Read_single

.../api/review/read_single.php?id=...

Hakee tietokannasta arvostelun id:n perusteella. <br>
Retrieves review from the database based on the given id.

```
Example:
GET http://localhost/.../api/review/read_single.php?id=1
```


Arvostelu löytyi. <br>
Review was found.

```
{
    "id": "1",
    "nimi": "jasmine test",
    "kommentti": "test",
    "arvosana": "5",
    "kuva": null,
    "aika": "2018-12-02 18:00:36"
}
```

Arvostelua ei löytynyt. <br>
Review was not found.

```
{
	"message": "Ei arvosteluja"
}
```

### Update

.../api/review/update.php

Päivittää arvostelun id:n perusteella.
Updates the review based on the given id.

```
PUT http://localhost/.../api/review/update.php
Content-Type: application/json
```

```
{
	"nimi": "test,
	"kommentti": "test",
	"arvosana": 5,
	"id": 2
}
```

Arvostelun päivitys onnistui. <br>
Review was successfully updated.

```
{
	"message": "Arvostelu päivitetty"
}
```

Arvostelun päivitys epäonnistui. <br>
Failed to update the review.

```
{
	"message": "Arvostelua ei päivitetty"
}
```