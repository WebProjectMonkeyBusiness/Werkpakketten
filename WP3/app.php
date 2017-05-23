<?php header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT ,DELETE');

require_once 'src/autoload.php';
use \model\PDOEventRepository;
use \view\EventJsonView;
use \controller\PersonController;

$user = 'root';
$password = '';
$database = 'monkey_business';
$pdo = null;

try {

    $pdo = new PDO("mysql:host=localhost;dbname=$database",
                   $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                       PDO::ERRMODE_EXCEPTION);

    $eventPDORepository = new PDOEventRepository($pdo);
    $eventJsonView = new EventJsonView();
    $eventController = new PersonController($eventPDORepository, $eventJsonView);


    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $eventController->handleRequest($id);


} catch (Exception $e) {
    echo 'cannot connect to database';
}


