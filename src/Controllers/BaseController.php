<?php
namespace Horoshop\Test\Controllers;

use Horoshop\Test\View\View;

abstract class BaseController{

    protected $view;
    public function __construct(){

        $this->view = new View();

    }//__construct

    protected function json( $code , $data ){

        http_response_code($code);
        header('Content-type: application/json');
        echo json_encode($data);
        exit();

    }//json

}//BaseController