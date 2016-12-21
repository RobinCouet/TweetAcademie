<?php

class database {
    protected $bdd;
    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=common-database;
                charset=utf8', 'root', '');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
