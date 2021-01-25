<?php
namespace Models;
use \Services\Db;
abstract class ActiveRecord{
    public static function all(){
        $db = Db::getInstance();
        return $db->query('SELECT * FROM '.static::getTableName(),[],static::class);
    }
    public static function getByID($id){
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM '.static::getTableName().' WHERE id=?', [$id],static::class);
        return $result ? $result[0] : null;
    }
    public static function findByColumn(string $column, $value){
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM '.static::getTableName().' WHERE '.$column.'=?', [$value],static::class);
        return $result ? $result[0] : null;
    }
    // public function save(){
    //     $reflection = new \ReflectionObject($this);
    //     $properties = $reflection->getProperties();
    //     $props = [];
    //     foreach($properties as $property){
    //         $props[] = $property->name;
    //     }
    //     $str = [];
    //     $params = [];
    //     foreach($props as $p){
    //         $str[] = $p.'=:'.$p;
    //         $params[$p] = ''.$this->$p.'';
    //     }
    //     $sql = 'UPDATE '. static::getTableName().' SET '.implode(', ', $str).' WHERE id=:id';
    //     $db =  Db::getInstance();
    //     $db->query($sql, $params);
    // }
    public function save(){
        $reflection = new \ReflectionObject($this);
        $properties = $reflection->getProperties();
        $str = [];
        $params = [];
        $str_ins = [];
        $params_ins = [];
        foreach($properties as $property){
            $p = $property->name;
            if($this->$p != null){
                $str[]= $p.'=:'.$p;
                $params[$p]= ''.$this->$p.'';
                $str_ins[]= $p;
                $params_ins[$p]= ':'.$p.'';
            }
        }
        if(static::getId()!=null){
            $sql = 'UPDATE '. static::getTableName().' SET '.implode(', ', $str).' WHERE id=:id';
        }else{
            $sql = 'INSERT INTO '. static::getTableName().' ('.implode(', ', $str_ins).') VALUES('.implode(', ', $params_ins).')';
        }
        // var_dump( $sql);
        $db =  Db::getInstance();
        $db->query($sql, $params);
    }
    abstract public static function getTableName();
    public function delete(){
        $db =  Db::getInstance();
        $db->query('DELETE FROM '.static::getTableName().' WHERE id=?',[static::getId()]);
    }
}


