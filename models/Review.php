<?php

class Review
{
    // Tietokanna yhteys ja taulun nimi
    private $conn;
    private $table = 'arvostelu';

    // Taulun sarakkeet
    public $id;
    public $nimi;
    public $kommentti;
    public $arvosana;
    public $kuva;
    public $aika;

    // Konstruktori
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hae kaikki arvostelut
    public function read()
    {
        // SQL kysely
        $query = 'SELECT * FROM ' . $this->table;
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Hae yksittäinen arvostelu id:n perusteella
    public function read_single()
    {
        // Parametrisoitu SQL kysely
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Aseta id ensimmäiseen parametriin (? kohdalle)
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Aseta arvot
        $this->nimi = $row['nimi'];
        $this->kommentti = $row['kommentti'];
        $this->arvosana = $row['arvosana'];
        $this->kuva = $row['kuva'];
        $this->aika = $row['aika'];
    }

    // Hae arvostelut nimen perusteella
    public function read_byname()
    {
        // Parametrisoitu SQL kysely
        $query = "SELECT * FROM " . $this->table . " WHERE nimi LIKE ?";
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $search = $this->nimi."%";
        // Execute query
        $stmt->execute([$search]);

        return $stmt;
    }

    // Luo arvostelun
    public function create()
    {
        $null = NULL;

        // SQL kysely
        $query = 'INSERT INTO ' . $this->table . ' SET nimi = :nimi, kommentti = :kommentti, arvosana = :arvosana, kuva = :kuva';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Datan puhdistus. Muuttaa erikoismerkit ja poistaa tagit
        $this->nimi = htmlspecialchars(strip_tags($this->nimi));
        $this->kommentti = htmlspecialchars(strip_tags($this->kommentti));
        $this->arvosana = htmlspecialchars(strip_tags($this->arvosana));
        $this->kuva = htmlspecialchars(strip_tags($this->kuva));

        // Datan yhdistäminen
        $stmt->bindParam(':nimi', $this->nimi);
        $stmt->bindParam(':kommentti', $this->kommentti);
        $stmt->bindParam(':arvosana', $this->arvosana);

        if ($this->kuva !== '') {
            $stmt->bindParam(':kuva', $this->kuva);
        } else {
            $stmt->bindParam(':kuva', $null, PDO::PARAM_NULL);
        }

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Tulostaa virheilmoituksen, jos jokin meni vikaan
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Päivittää arvostelun id:n perusteella
    public function update()
    {
        $null = NULL;

        // SQL kysely
        $query = 'UPDATE ' . $this->table . ' SET nimi = :nimi, kommentti = :kommentti, arvosana = :arvosana, kuva = :kuva WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Datan puhdistus. Muuttaa erikoismerkit ja poistaa tagit
        $this->nimi = htmlspecialchars(strip_tags($this->nimi));
        $this->kommentti = htmlspecialchars(strip_tags($this->kommentti));
        $this->arvosana = htmlspecialchars(strip_tags($this->arvosana));
        $this->kuva = htmlspecialchars(strip_tags($this->kuva));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Datan yhdistäminen
        $stmt->bindParam(':nimi', $this->nimi);
        $stmt->bindParam(':kommentti', $this->kommentti);
        $stmt->bindParam(':arvosana', $this->arvosana);

        if ($this->kuva !== '') {
            $stmt->bindParam(':kuva', $this->kuva);
        } else {
            $stmt->bindParam(':kuva', $null, PDO::PARAM_NULL);
        }

        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Tulostaa virheilmoituksen, jos jokin meni vikaan
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Poistaa arvostelun id:n perusteella
    public function delete()
    {
        // SQL kysely
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Datan puhdistus. Muuttaa erikoismerkit ja poistaa tagit
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Datan yhdistäminen
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Tulostaa virheilmoituksen, jos jokin meni vikaan
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}