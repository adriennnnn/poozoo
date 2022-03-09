<?php


class Employee{

public function createAnimal($animal){

    include './config/db.php';
    $req = $db->prepare("INSERT INTO animals (name, type, size, weight, age, paddock_id) VALUES (?,?,?,?,?,?)");
    $req->execute([$animal->name, $animal->getType(), $animal->size, $animal->weight, $animal->age, $animal->paddockID]);

}
public function showAnimals(){

    include './config/db.php';

    $recup= $db->prepare("SELECT * FROM animals");
    $recup->execute();
    $animalsData = $recup->fetchAll();
    //pour chaque donnés d'animal on retourne un animal
    $animals = [];
    foreach ($animalsData as $data) {

        switch ($data['type']) {
            case 'tiger':
                $animal = new Tiger($data);
                break;

            case 'fish':
                $animal = new Fish($data);
                break;

            case 'eagle':
                $animal = new Eagle($data);
                break;

            case 'bear':
                $animal = new Bear($data);
                break;

        }

        array_push($animals, $animal);

    }
    return $animals;
}
public function createPaddock($paddock){

    include './config/db.php';
    $sql = $db->prepare("INSERT INTO enclos (type, paddock_name) VALUES (?,?)");
    $sql->execute([$paddock->getTypeP(), $paddock->paddockName]);

}
public function showPaddock(){

    include './config/db.php';

    $recuP= $db->prepare("SELECT * FROM enclos");
    $recuP->execute();
    $paddockData = $recuP->fetchAll();
    //pour chaque donnés d'animal on retourne un animal
    $paddocks = [];
    foreach ($paddockData as $dataP) {

        switch ($dataP['type']) {
            case 'aviary':
                $paddock = new Aviary($dataP);
                break;

            case 'aquarium':
                $paddock = new Aquarium($dataP);
                break;

            case 'enclosure':
                $paddock = new Enclosure($dataP);
                break;

        }

        array_push($paddocks, $paddock);

    }
    return $paddocks;
}

}
