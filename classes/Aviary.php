<?php
class Aviary extends Paddock{

    function __construct($dataP)
    {
        parent::__construct($dataP);

    }
    public function getTypeP(){
        return 'aviary';
    }


}
?>