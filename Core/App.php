<?php

class App
{
    public $controller = "IndexController";
    public $method = "index";
    public $params = array();

    public function __construct()
    {
        //Checking the set of url
        if (isset($_GET['url'])) {

            $url = $_GET['url'];
            $url = $this->Explode($url);

            $this->controller = $url[0];
            unset($url[0]);

            //Checking the set of method
            if (isset($url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
            $this->params = array_values($url);
        }
        //Checking the existence of the controller
        $path = 'controllers/' . $this->controller . '.php';
        if (file_exists($path)) {
            require $path;
            $object = new $this->controller();
            $object->Model($this->controller);

            //Checking the existence of the method
            if (method_exists($object, $this->method)) {
                call_user_func_array([$object, $this->method], $this->params);
            } else {
                echo "This page  not found-ERROR 404";
            }
        } else {
            echo "This page  not found-ERROR 404";
        }

    }

    //String to array conversion method
    public function Explode($url)
    {
        $url=rtrim($url, '/ ');
        $url = explode('/', $url);
        return $url;
    }
}