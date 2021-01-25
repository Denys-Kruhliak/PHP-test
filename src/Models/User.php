<?php
namespace Models;
use \Services\Db;
class User extends ActiveRecord{
    protected $id;
    protected $name;
    protected $email;
    protected $is_confirmed;
    protected $role;
    protected $password_hash;
    protected $auth_token;
    protected $created_at;
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getIs_confirmed(){
        return $this->is_confirmed;
    }
    public function getRole(){
        return $this->role;
    }
    public function getPassword_hash(){
        return $this->password_hash;
    }
    public function getAuthorToken(){
        return $this->auth_token;
    }
    public function getCreated_at(){
        return $this->created_at;
    }
    public static function getTableName(){
        return 'users';
    }
    public static function signUp(array $userData){
        if(empty($userData['name'])){
            throw new \Exceptions\InvalidParamsException ('Name is required');
        }
        if(empty($userData['email'])){
            throw new \Exceptions\InvalidParamsException ('Email is required');
        }
        if(empty($userData['password'])){
            throw new \Exceptions\InvalidParamsException ('Password is required');
        }
        if(!filter_var($userData['email'],FILTER_VALIDATE_EMAIL)){
            throw new \Exceptions\InvalidParamsException ('Email not valid');
        }
        if(self::findByColumn('email',$userData['email'])){
            throw new \Exceptions\InvalidParamsException ('User already exists');
        }
        $user = new User();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password_hash =password_hash($userData['password'],PASSWORD_DEFAULT);
        $user->role = 'user';
        $user->auth_token = sha1(random_bytes(50));
        $user->is_confirmed = false;
        $user->created_at = date('Y-m-d h:i:s');
        $user->save();
        return $user;
    }
}