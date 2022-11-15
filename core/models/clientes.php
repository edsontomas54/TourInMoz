<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Clientes
{
   // ==================================================VERIFICAR SE O EMAIL JA EXISTE 
   public function verificar_email_existe($email)
   {

      //Verifica na base de dados se existe cliente com mesmo email
      $bd = new Database();
      $parametros = [
         ':e' => strtolower(trim($email)) //email nao pode conter letras menusculas! 'strtolower'
      ];

      $resultados = $bd->select("SELECT email FROM users WHERE email= :e", $parametros);

      // se o cliente ja existe...
      if (count($resultados) != 0) {
         return true;
      } else {
         return false;
      }
   }
   //=======================================REGISTAR users====================================
   public function registar_cliente()
   {
      //registao novo cliente na base de dados
      $bd = new Database();

      //cria uma hash para o registo do cliente
      $purl = Store::criarHash();

      //$parametros

      $parametros = [
         ':email' => strtolower(trim($_POST['text_email'])), //email nao pode conter letras menusculas! 'strtolower'
         ':senha' => password_hash(trim($_POST['text_senha_1']), PASSWORD_DEFAULT),
         ':nome_completo' => (trim($_POST['text_nome_completo'])),
         ':morada' => (trim($_POST['text_morada'])),
         ':cidade' => (trim($_POST['text_cidade'])),
         ':telefone' => (trim($_POST['text_telefone'])),
         ':purl' => $purl,
         ':activo' => 0,
      ];

      $bd->insert("
    INSERT INTO users VALUES(
    0,
    :email,
    :senha,
    :nome_completo,
    :morada,
    :cidade,
    :telefone,
    :purl,
    :activo,
    NOW(),
    NOW(),
    NULL
    )

 ", $parametros);
      //Retorna o purl criado
      return $purl;
   }
   //=======================================VALIDAÇÃO DO EMAIL COM PURL====================================
   public function validar_email($purl)
   {
      $bd = new Database();
      $parametros = [
         ':purl' => $purl,
      ];
      $resultados = $bd->select("SELECT* FROM users WHERE purl= :purl", $parametros);

      //Verifica se foi encontrado o cliente.
      if (count($resultados) !=1) {
         return false;
      }
      
      //foi encontrado o id do cliente......
      $id_cliente = $resultados[0]->id_cliente;

      // die(" id    " . $id_cliente);
      //Actualizar os dados do cliente......
      $parametros = [
         ':id_cliente' => $id_cliente
      ];
      $bd->update("UPDATE users SET purl=NULL, activo='1', updated_at=NOW() WHERE id_cliente=:id_cliente", $parametros);
      return true;
   }

   public function validar_login($usuario, $senha){
      //verifica se o login é valido!

      $parametros=[
         ":usuario" => $usuario,
      ];

      $bd = new Database();

      $resultados = $bd->select("
      SELECT * FROM users
       WHERE email = :usuario
        AND activo=1 
        AND deleted_at IS NULL
        ", $parametros);

        if(count($resultados)!=1){
         // não existe o usuario
        
         return false;
        }else{
         //Temos usuario. vamos verificar a sua password
         $usuario = $resultados[0];

         //vericar a password

         if(!password_verify($senha, $usuario->senha)){
            //password invalida
            return false;
         }else{
            // Login valido
            return $usuario;
         }
        }

    
   }
}
