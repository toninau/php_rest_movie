# Movie-Reviews

Made by: Toni Naumanen<br>
includes: REST-api, database, user interface.

## REST-api

Rest-api description is in finnish.

### Create

.../api/review/create.php

Luo arvostelun. ID annetaan automaattisesti.

```
Esimerkki:
POST http://localhost/.../api/review/create.php
Content-Type: application/json

{
	"nimi": "test",
	"kommentti": "test",
	"arvosana": 5
}
```
Tulos:<br>
Arvostelun luonti onnistui.

```
{
	"message": "Arvostelu luotu"
}
```

Arvostelun luonti epäonnistui.

```
{
	"message": "Arvostelua ei luotu"
}
```

### Delete

.../api/review/delete.php

Poistaa arvostelun id:n perusteella.

```
Esimerkki:
DELETE http://localhost/.../api/review/delete.php
Content-Type: application/json

{
	"id": 6
}
```
Tulos:<br>
Arvostelun poisto onnistui.

```
{
	"message": "Arvostelu poistettu"
}
```

Arvostelun poisto epäonnistui.

```
{
	"message": "Arvostelua ei poistettu"
}
```

### Read

.../api/review/read.php

Hakee tietokannan kaikki arvostelut.
Palauttaa listan.

```
Esimerkki:
GET http://localhost/.../api/review/read.php

Tulos:
[
    {
        "id": "1",
        "nimi": "jasmine test",
        "kommentti": "test",
        "arvosana": "5",
        "aika": "2018-12-02 18:00:36"
    },
    ...
    }
]
```

Jos ei arvosteluja ei löytynyt.

```
{
	"message": "Ei arvosteluja"
}
```

### Read_byname

.../api/review/read_byname.php?nimi=...

Hakee tietokannasta arvostelun/arvostelut.
Palauttaa listan.

```
Esimerkki:
GET http://localhost/.../api/review/read_byname.php?nimi=j

Tulos:
[
    {
        "id": "1",
        "nimi": "jasmine test",
        "kommentti": "test",
        "arvosana": "5",
        "aika": "2018-12-02 18:00:36"
    }
]

```

Jos ei arvosteluja ei löytynyt.

```
{
	"message": "Ei arvosteluja"
}
```

### Read_single

.../api/review/read_single.php?id=...

Hakee tietokannasta arvostelun id:n arvostelun.

```
Esimerkki:
GET http://localhost/.../api/review/read_single.php?id=1

Tulos:
{
    "id": "1",
    "nimi": "jasmine test",
    "kommentti": "test",
    "arvosana": "5",
    "aika": "2018-12-02 18:00:36"
}
```

Jos ei annettu id ei ole numero tai id on pienempi kuin 0.

```
{
	"message": "Ei arvosteluja"
}
```

### Update

.../api/review/update.php

Päivittää arvostelun id:n perusteella.

```
PUT http://localhost/.../api/review/update.php
Content-Type: application/json

{
	"nimi": "test,
	"kommentti": "test",
	"arvosana": 5,
	"id": 2
}
```
Tulos:<br>
Arvostelun päivitys onnistui.

```
{
	"message": "Arvostelu päivitetty"
}
```

Arvostelun päivitys epäonnistui.

```
{
	"message": "Arvostelua ei päivitetty"
}
```