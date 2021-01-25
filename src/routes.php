<?php

return[
    '/'             => 'HomeController@index',
    'blog'          => 'BlogController@index',
    'post'          => 'BlogController@show',
    'post/edit'     => 'BlogController@edit',
    'post/delete'   => 'BlogController@delete',
    'post/add'      => 'BlogController@add',
    'user/register' => 'UserController@signUp',
    'pdf'           => 'AppController@pdf',
    'excel'         => 'AppController@excelExport'
];