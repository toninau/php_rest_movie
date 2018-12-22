<?php
// Headerit, joita tarvitaan koko taulun hakemista varten
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Review.php';

// Luo tietokanta olion ja yhdistää sen tietokantaan
$database = new Database();
$db = $database->connect();

// Luo arvostelu olion ja antaa parametriksi tietokannan
$review = new Review($db);

// Arvostelu kysely koko taulua varten
$result = $review->read();
// Hakee rivi määrän (Arvostelujen määrän)
$num = $result->rowCount();

// Tarkistaa onko yhtäkään arvostelua
if($num > 0) {
    // Arvostelu array
    $arvostelu_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $arvostelu_item = array(
            'id' => $id,
            'nimi' => $nimi,
            'kommentti' => $kommentti,
            'arvosana' => $arvosana,
            'kuva' => $kuva,
            'aika' => $aika
        );

        // Lisää itemin listaan
        array_push($arvostelu_arr, $arvostelu_item);
    }
    http_response_code(200);
    // Muuttaa arrayn json-muotoon ja echo.
    echo json_encode($arvostelu_arr);

} else {
    http_response_code(404);
    echo json_encode(
        array('message' => 'Ei arvosteluja')
    );
}
