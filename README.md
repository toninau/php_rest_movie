# Movie-Reviews

Toni Naumanen<br>
Sisältää mm. yksikkötestit, REST-api, tietokanta, käyttöliittymä.

## REST-rajapinnan kuvaus

Tietokanta koostuu arvoista id (int 11, AUTO_INCREMENT), nimi (varchar 50), kommentti (varchar 300), arvosana (int 11), aika (datetime, CURRENT_TIMESTAMP).

### Create

.../api/arvostelu/create.php

Luo arvostelun. ID annetaan automaattisesti.

```
Esimerkki:
POST http://localhost/.../api/arvostelu/create.php
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

.../api/arvostelu/delete.php

Poistaa arvostelun id:n perusteella.

```
Esimerkki:
DELETE http://localhost/.../api/arvostelu/delete.php
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

.../api/arvostelu/read.php

Hakee tietokannan kaikki arvostelut.
Palauttaa listan.

```
Esimerkki:
GET http://localhost/.../api/arvostelu/read.php

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

.../api/arvostelu/read_byname.php?nimi=...

Hakee tietokannasta arvostelun/arvostelut.
Palauttaa listan.

```
Esimerkki:
GET http://localhost/.../api/arvostelu/read_byname.php?nimi=j

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

.../api/arvostelu/read_single.php?id=...

Hakee tietokannasta arvostelun id:n arvostelun.

```
Esimerkki:
GET http://localhost/.../api/arvostelu/read_single.php?id=1

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

.../api/arvostelu/update.php

Päivittää arvostelun id:n perusteella.

```
PUT http://localhost/.../api/arvostelu/update.php
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