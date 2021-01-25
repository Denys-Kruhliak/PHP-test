<?php
namespace Controllers;
use \View\View;
class HomeController{
    public function index(){
        View::render('home/index');
    }
}