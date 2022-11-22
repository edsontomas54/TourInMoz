<?php
namespace core\models;

use core\classes\Database;
use core\classes\Store;

class admin
{
      // ==================================================VERIFICAR SE O EMAIL JA EXISTE 
   public function verificar_email_existe($email)
   {

      //Verifica na base de dados se existe cliente com mesmo email
      $bd = new Database();
      $parametros = [
         ':e' => strtolower(trim($email)) //email nao pode conter letras menusculas! 'strtolower'
      ];

      $resultados = $bd->select("SELECT email FROM admin_users WHERE email= :e", $parametros);

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
        // try {
               //registao novo cliente na base de dados
        $bd = new Database();
  
        //cria uma hash para o registo do cliente
        $purl = Store::criarHash();
  
        //$parametros
  
        $parametros = [
           ':email' => strtolower(trim($_POST['email_admin'])), //email nao pode conter letras menusculas! 'strtolower'
           ':senha' => password_hash(trim($_POST['senha_admin']), PASSWORD_DEFAULT),
           ':nome_admin' => (trim($_POST['nome_admin'])),
           ':roles' => (trim($_POST['role_type'])),
           ':purl' => $purl,
           ':activo' => 0,
        ];
  
     $saved = $bd->insert("
      INSERT INTO admin_users VALUES(
      0,
      :email,
      :senha,
      :roles,
      :nome_admin,
      :purl,
      :activo,
      NOW(),
      NOW(),
      NULL
      )
     ", $parametros);

        return $purl;
     }

     public function validar_email($purl)
     {
        $bd = new Database();
        $parametros = [
           ':purl' => $purl,
        ];
        $resultados = $bd->select("SELECT* FROM admin_users WHERE purl= :purl", $parametros);
  
        //Verifica se foi encontrado o cliente.
        if (count($resultados) !=1) {
           return false;
        }
        
        //foi encontrado o id do cliente......
        $id_admin = $resultados[0]->id_admin;
        //Actualizar os dados do cliente......
        $parametros = [
           ':id_cliente' => $id_admin,
        ];
        $bd->update("UPDATE admin_users SET purl=NULL, activo='1', updated_at=NOW() WHERE id_admin=:id_admin", $parametros);
        return true;
     }

        //=======================================VALIDAÇÃO DO Login====================================
   public function validar_login($email_admin, $senha_admin){
      //verifica se o login é valido!

      $parametros=[
         ":ed" => $email_admin,
      ];

      $bd = new Database();

      $resultados = $bd->select("
      SELECT * FROM admin_users
       WHERE email = :ed
        AND activo=1 
        AND deleted_at IS NULL
        ", $parametros);

        if(count($resultados)!=1){
         // não existe o usuario
         return false;
        }else{
         //Temos usuario. vamos verificar a sua password
         $user_admin = $resultados[0];

         //vericar a password

         if(!password_verify($senha_admin, $user_admin->senha)){
            //password invalida
            $_SESSION['erro']="as senhas estao incorrectas";
            return false;
         }else{
            // Login valido
            return $user_admin;
         }
        }

    
   }
}