<?php

//abrir a sessao



use core\classes\Database;
use core\classes\Store;

session_start();// a sessao estara aberta para todas as pages! 

/*
carregar o config
carregar as classes
carregar o sistema de rotas/ rotas que sao encaregados em mostrar esses: 
 -mostrar loja
 -mostrar carrinho
 -mostrar o backoffice, etc
*/
//carregar o config

//carrega todas as classes do projecto
require_once('../vendor/autoload.php');

require_once('../core/rotas.php');





