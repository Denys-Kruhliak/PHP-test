<?php
namespace Controllers;

use \View\View;
use \Models\Post;
use \Models\User;

class BlogController{
    public function index(){
        $posts = Post::all();
        $title = 'Blog';
        View::render('blog/index',compact('posts','title'));
    }
    public function show(){
        $id =  $_GET['id'];
        $post = Post::getByID($id);
        if($post == null){
            throw new \Exceptions\NotFoundException();
        }
        View::render('blog/show',compact('post'));
    }
    public function edit(){
        $id =  $_GET['id'];
        $post = Post::getByID($id);
        $authors = User::all();
        $params ['post'] = $post;
        $params ['authors'] = $authors;
        if(!empty($_POST)){
            try{
                $post->setName($_POST['name']);
                $post->setText($_POST['text']);
                $post->setAuthorId($_POST['author']);
                $post->save();
                // var_dump($post);
                echo '<div class="alert alert-success">
                <strong>Все отлично!</strong> Пост изменен.
                </div>';
            }
            catch(\Exceptions\InvalidParamsException $e){
                $params ['errors'] = $e->getMessage();
            }
        }
        View::render('blog/edit',$params);
    }
    public function add(){
        if(!empty($_POST)){
            try {
                $post = Post::add($_POST);
            }
            catch(\Exceptions\InvalidParamsException $e){
                View::render('blog/add',['errors'=>$e->getMessage()]);
                return;
            }
        }
        View::render('blog/add');
    }
    public function delete(){
        $id = $_POST['id'];
        $post = Post::getByID($id);
        $post->delete();
    }
}