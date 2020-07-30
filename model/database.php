<?php

class database {
    protected $bdd;
    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=tweet;
                charset=utf8', 'root', '');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
