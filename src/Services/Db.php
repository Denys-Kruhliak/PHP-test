<?php
namespace Services;
use Exceptions\DbExceptions;
class Db{
    private static $instanceCount = 0;
    private static $instance = null;
    private $pdo;
    private function __construct(){
        self::$instanceCount++;
        extract((require __DIR__.'/../settings.php')['db']);
        try{
            $this->pdo = new \PDO("mysql:host=$host;dbname=$db_name;port+$port",$user,$password);            
        }catch(\PDOException $error){
            throw new DbExceptions('Ошибка подключения к DB: '.$error->getMessage());
        }
    }
    public function query(string  $sql, array $params=[], string $className = 'stdClass'){
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if($result==false){
            return null;
        }
        else{
            return $sth->fetchAll(\PDO::FETCH_CLASS,$className); //'\Models\Post' or \Models\Post::class 
        }
    }
    public static function getInstanceCount(){
        return self::$instanceCount;
    }
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}