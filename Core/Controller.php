<?php

class Controller
{   public $modelDb='';
    public function __construct()
    {

    }
//require View files
    public function Header($urlHeader,$data=[])
    {
        require 'Views/' . $urlHeader . '.php';
    }

    public function View($urlView,$data=[])
    {
        require 'Views/' . $urlView . '.php';
    }

    public function Footer($urlFooter,$data=[])
    {
        require 'Views/' . $urlFooter . '.php';
    }
//require Model files
    public function Model($urlModel)
    {
        require 'Models/Model_' . $urlModel . '.php';
        $className ='Model_' . $urlModel ;
        #Create the object from Model class name
        $this->modelDb=new $className();

    }

}