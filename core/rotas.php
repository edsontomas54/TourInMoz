<?php

//colecao de rotas

$rotas=[
    'inicio'=> 'main@index',
    'package'  => 'main@package',
    'book'=> 'main@book',
    'about'=> 'main@about',
    //clientes===============
    'novo_cliente'=>'main@novo_cliente',
    'criar_cliente'=> 'main@criar_cliente',
    'confirmar_email'=> 'main@confirmar_email',
    'regist_trip'=>           'main@regist_trip',     
    //========login=============================
    'login'=>            'main@login',
    'login_submit'=>      'main@login_submit',
    'logout'=>              'main@logout',
    //========login======End=======================//
     //========Perfil============================
     'perfil'   =>  'main@perfil',
     'perfil_user' => 'main@perfil_user',
     //========Perfil============================

     //admin painel=================================
     'admin_painel'=>              'AdminUsersController@admin',
     'admin_regist'=>'AdminUsersController@registAdminUser',
     'create_admin_user'=>'AdminUsersController@create_admin_user',
     //login
     'login_admin'=>'AdminUsersController@login_admin',
     'login_submit_admin'=>'AdminUsersController@login_submit_admin',
     'logout_admin'=>              'AdminUsersController@logout_admin',
    //editing

    'edit_admin' => 'AdminUsersController@edit_admin',
    'update_admin' => 'AdminUsersController@update_admin',

];

//Define acão por defeito/default

$acao='inicio';

//verifica se existe a acao na query string a!

if(isset($_GET['a'])){
    //verifica se existe a acao nas rotas...
    if(key_exists($_GET['a'],$rotas)){
        $acao=$_GET['a'];
    }else{
        $acao='inicio';
    }
}
//trata a definição de rotas 
$partes=explode('@',$rotas[$acao]);

$controlador='core\\controllers\\'.ucfirst($partes[0]);//ucfirst ele coloca a primeira letra maior.
$metodo= $partes[1];

$ctr= new $controlador();
$ctr->$metodo();