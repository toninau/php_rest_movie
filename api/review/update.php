<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Review.php';

// Luo tietokanta olion ja yhdistää sen tietokantaan
$database = new Database();
$db = $database->connect();

// Luo arvostelu olion ja antaa parametriksi tietokannan
$review = new Review($db);

$data = json_decode(file_get_contents("php://input"));
$review->id = $data->id;
$review->nimi = $data->nimi;
$review->kommentti = $data->kommentti;
$review->arvosana = $data->arvosana;
$review->kuva = $data->kuva;

if (strlen($review->nimi) <= 50 && strlen($review->kommentti) <= 300 && ($review->arvosana > 0 && $review->arvosana < 6) && strlen($review->kuva) <= 150) {
    if ($review->update()) {
        http_response_code(200);
        echo json_encode(
            array('message' => 'Arvostelu päivitetty')
        );
    }
} else {
    http_response_code(405);
    echo json_encode(
        array('message' => 'Arvostelua ei päivitetty')
    );
}