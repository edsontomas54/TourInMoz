<?php

namespace core\classes;

use Exception;

class Store{

    //=======================PAPEAMENTO DE LAYOUT E DE DADOS!==============
    public static function Layout($estruturas, $dados=null){

        // Verifica se a estrutura é um array
        if(!is_array($estruturas)){
            throw new Exception("estruções inválidas!");
        }

        //variaveis!
        if(!empty($dados) && is_array($dados)){
            extract($dados);
        }

        // Apresentar as views da aplição.
        foreach($estruturas as $estrutura)
        {
            include("../core/views/$estrutura.php");
        }

    }

     //=======================VERIFICÇÃES DE CLIENTES!==============
    public static function clienteLogado(){
        
        //verifica se existe um cliente com sessao/Logado
        return (isset($_SESSION['cliente']));
 
    }

    public static function LoggedAdminUser(){
        
        //verifica se existe um cliente com sessao/Logado
        return (isset($_SESSION['admin']));

 
    }

    //====================Hash=========================================================

    public static function criarHash($num_caracteres=12){
        //criar hashes

        $chars=' 0123456789123456789abcdefghijklmnopqrstuvwxzyabcdefghijklmnopqrstuvwxzyABCDEFGHIJKLMNOPQRSTUVWXZYABCDEFGHIJKLMNOPQRSTUVWXZY987654321';
        
       return substr(str_shuffle($chars),0, ($num_caracteres));
    }
    //====================redicionamento========================================================
    public static function redirect($rota=" "){
        header("Location: " . BASE_URL . "?a=$rota");
       
    }

    //==============================Printa data produts===================================

    public static function printData($data){

        if(is_array($data) || is_object($data)){
        echo '<pre>';
        print_r($data);

        }else{
            echo '<pre>';
            echo $data;
        }
        die( "<br>veja!"  );
    }
}

