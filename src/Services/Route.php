<?php
namespace Services;
use View\View;
class Route{
    public static function start(){
        $url = $_GET['url'] ?? '/';
        $routes = require __DIR__.'/../routes.php';
        try{
            if(!isset($routes[$url])){
                throw new \Exceptions\NotFoundException();
            }
            list($controllerName, $methodName) = explode('@',$routes[$url]);
            $controllerPath = 'Controllers\\'.$controllerName;
            if(!file_exists('src/'.$controllerPath.'.php')){
                throw new \Exceptions\AppEx('Controller not found');
            }
            $controller = new $controllerPath();
            if(!method_exists($controller,$methodName)){
                throw new \Exceptions\AppEx('Method not found');
            }
            $controller->$methodName();
        }catch(\Exceptions\NotFoundException $error){
            View::render('errors/404',[],404);
        }catch(\Exceptions\AppEx $error){
            View::render('errors/500',['error'=>$error->getMessage()],500);
        }catch(\Exceptions\DbExceptions $error){
            View::render('errors/505',['error'=>$error->getMessage()],505);
        }

    }
}