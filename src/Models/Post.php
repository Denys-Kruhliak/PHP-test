<?php
namespace Models;
use \Services\Db;
use \Exceptions\InvalidParamsException;
class Post extends ActiveRecord{
    protected $id;
    protected $name;
    protected $text;
    protected $author_id;
    protected $created_at;
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getText(){
        return $this->text;
    }
    public function getAuthorId(){
        return $this->author_id;
    }
    public function getAuthor(){
        return User::getById($this->author_id);
    }
    public function getCreated_at(){
        return $this->created_at;
    }
    public function setName(string $name){
        if(mb_strlen($name)<3){
            throw new InvalidParamsException("В название должно быть более 3-ех символов");
        }
        if(mb_strlen($name)>255){
            throw new InvalidParamsException("В название должно быть менее 255 символов");
        }
        $this->name = $name;
    }
    public function setText(string $text){
        if(mb_strlen($text)<50){
            throw new InvalidParamsException("Текст поста должен содержать более 50 символов");
        }
        $this->text = $text;
    }
    public function setAuthorId(string $author_id){
        if(!User::getByID($author_id)){
            throw new InvalidParamsException("Выберете существуещего автора");
        }
        $this->author_id = $author_id;
    }
    public static function getTableName(){
        return 'posts';
    }
    public static function add(array $postData){
        if(empty($postData['name'])){
            throw new \Exceptions\InvalidParamsException ('Name is required');
        }
        if(empty($postData['text'])){
            throw new \Exceptions\InvalidParamsException ('Post is required');
        }
        $post = new Post();
        $post->name = $postData['name'];
        $post->text = $postData['text'];
        //$post->author_id = 1;
        $post->created_at = date('Y-m-d h:i:s');
        $post->save();
        return $post;
    }
}

