<?php

abstract class Paddock {

    public $paddockName;
    public $paddockType;
    public $paddockClean;
    public $paddockID;
    private $maxSize = 6;
    public $id;
    private $name;
    public $cleanState;
    public $animals;
    private $type;
    static public $CLEANSTATE_CLEAN = 0;
    static public $CLEANSTATE_CORRECT = 1;
    static public $CLEANSTATE_DIRTY = 2;

    function __construct($dataP)
    {
        $this->hydrate($dataP);
    }
    private function hydrate($dataP) {
        $this->paddockName = $dataP['paddock_name'] ;
        $this->paddockType = $dataP['type'] ;
        $this->paddockClean = $dataP['cleanliness'] ?? 0 ;
        $this->paddockNumber = $dataP['number_of_animals'] ?? 0 ;
        $this->paddockID = $dataP['id'];
    }
    abstract function getTypeP();
    // abstract function clesning();
    public function getAnimals(){

        
    }
    //------------------------------------------------------------------------------------------------------------------
    // ajout tmp : 
    //------------------------------------------------------------------------------------------------------------------
      private function toSql() {
        // Convertit notre instance Enclos en données brutes
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'clean_state' => $this->cleanState,
        );
    }

    private function persist(){
        $database = new Database();
        $database->updateRow('enclos', $this->id, $this->toSql());
    }

    public function showStats(){

    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;

        $this->persist();
    }

    public function getAnimalsCount(){

       return count($this->animals);

    }

    public function showAnimalsStats(){

    }

    public function addAnimal($animal){

        if ($this->getAnimalsCount() < $this->maxSize){

            if ($this->isAnimalCompatible($animal)){

                array_push($this->animals, $animal);
                $animal->setEnclosId($this->id);

                $this->persist();
            }
        }
    }

    private function isAnimalCompatible($animal){
        if($this->getAnimalsCount() == 0){
             return true;
        }
        if ($animal->getType() == $this->animals[0] ->getType() ){
           return true;
        }
        return false;
    }

    public function removeAnimal($animal){
        $key = array_search($animal, $this->animals);
        unset($this->animals[$key]);

    }

    static public function getSubType($data){
        switch ($data['type']) {
            case 'paddock':
        $enclos = new Paddock($data);
            break;
            case 'aquarium':
        $enclos = new Aquarium($data);
            break;
                case 'aviary':
        $enclos = new Aviary($data);
            break;
    }
    return $enclos;
    }

    
}
?>