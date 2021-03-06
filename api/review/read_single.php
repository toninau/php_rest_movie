<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Review.php';

// Luo tietokanta olion ja yhdistää sen tietokantaan
$database = new Database();
$db = $database->connect();

// Luo arvostelu olion ja antaa parametriksi tietokannan
$review = new Review($db);

// Hae ID
$review->id = isset($_GET['id']) ? $_GET['id'] : die();

// Hakee arvostelun ID:n mukaan
if (is_numeric($review->id) && $review->id > 0) {
    $review->read_single();
    // Arvostelu array
    $arvostelu_arr = array(
        'id' => $review->id,
        'nimi' => $review->nimi,
        'kommentti' => $review->kommentti,
        'arvosana' => $review->arvosana,
        'kuva' => $review->kuva,
        'aika' => $review->aika
    );
    http_response_code(200);
    print_r(json_encode($arvostelu_arr));
} else {
    http_response_code(404);
    echo json_encode(
        array('message' => 'Ei arvosteluja')
    );
}


