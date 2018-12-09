<?php
// Headerit, joita tarvitaan arvostelun poistoa varten
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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
$review->id = $data->id;


if ($review->delete()) {
    echo json_encode(
        array('message' => 'Arvostelu poistettu')
    );
} else {
    echo json_encode(
        array('message' => 'Arvostelua ei poistettu')
    );
}