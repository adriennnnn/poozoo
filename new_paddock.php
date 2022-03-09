<?php
include './config/autoload.php';
$dataP = array(
    'paddock_name'=> $_POST['paddock-name'],
    'type'=> $_POST['paddock-specie']
);
switch ($dataP['type']) {
    case 'aquarium':
    $paddock = new Aquarium($dataP);
        break;
    case 'aviary':
    $paddock = new Aviary($dataP);
        break;
            case 'enclosure':
    $paddock = new Enclosure($dataP);
        break;
}
$employee = new Employee;

$employee->createPaddock($paddock);

header('location: /index.php');
?>