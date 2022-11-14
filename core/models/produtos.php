<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produto
{

//==============================================================
public function lista_produtos_disponiveis()
{
    //buscar todas as informações dos produtos na base de dados.

    $bd=new Database();
    $produtos = $bd->select("
    
    SELECT * FROM produtos
    WHERE vesivel =1
    ");
    return $produtos;
}



}