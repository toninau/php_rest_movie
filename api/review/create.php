<?php
// Headerit, joita tarvitaan uuden arvostelun luontia varten
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: X-Requested-With');
header('Access-Control-Allow-Methods: Authorization');


include_once '../../config/Database.php';
include_once '../../models/Review.php';

// Luo tietokanta olion ja yhdistää sen tietokantaan
$database = new Database();
$db = $database->connect();

// Luo arvostelu olion ja antaa parametriksi tietokannan
$review = new Review($db);

$data = json_decode(file_get_contents("php://input"));

$review->nimi = $data->nimi;
$review->kommentti = $data->kommentti;
$review->arvosana = $data->arvosana;
$review->kuva = $data->kuva;
// Tarkistus
// Arvostelun luonti epäonnistuu, jos annettua id:tä ei löydy, vaikka ilmoitus on "arvostelu luotu".
if (strlen($review->nimi) <= 50 && strlen($review->kommentti) <= 300 && ($review->arvosana > 0 && $review->arvosana < 6) && $review->kuva <= 150) {
    if ($review->create()) {
        echo json_encode(
            array('message' => 'Arvostelu luotu')
        );
    }
} else {
    echo json_encode(
        array('message' => 'Arvostelua ei luotu')
    );
}