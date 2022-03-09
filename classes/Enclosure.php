<?php
class Enclosure extends Paddock{

    function __construct($dataP)
    {
        parent::__construct($dataP);

    }
    public function getTypeP(){
        return 'enclosure';
    }


}
?>