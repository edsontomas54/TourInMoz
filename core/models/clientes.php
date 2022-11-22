<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;
use core\classes\EnviarEmail;
use Exception;

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
      // try {
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

   $saved = $bd->insert("
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
    NULL,
    NULL
    )

   ", $parametros);

      // if($saved == "" && $saved != null){
      //    //Retorna o purl criado

      //    // var_dump($saved);
      //    return null;
      // }else{
      //    $email = new enviarEmail();
         
      //    $email->reportBug("Teste", $parametros);

      //    return null;
      // }
      
      // } catch (Exception $e) {
         
      //    $email = new enviarEmail();
         
      //    $email->reportBug($e, $parametros);
         
      //    return null;
      // }
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
      //Actualizar os dados do cliente......
      $parametros = [
         ':id_cliente' => $id_cliente
      ];
      $bd->update("UPDATE users SET purl=NULL, activo='1', updated_at=NOW() WHERE id_cliente=:id_cliente", $parametros);
      return true;
   }

   //=======================================Perfir update====================================
   public function perfir_user_update()
   {
      $bd= new Database();

      

      // $parametros = [
      //    ':nome_comple' => (trim($_POST['update_name'])),
      //    ':morada' => (trim($_POST['update_morada'])),
      //    ':cidade' => (trim($_POST['update_cidade'])),
      //    ':telefone' => (trim($_POST['update_telefone'])),
      //    // ':image' => (trim($_POST['update_profile'])),
      //    ':id_cliente' => $id_cliente,
      // ];
         
         $nome_comple=(trim($_POST['update_name']));
         $morada=(trim($_POST['update_morada']));
         $cidade=(trim($_POST['update_cidade']));
         $telefone=(trim($_POST['update_telefone']));
         $id_cliente = $_SESSION['cliente'];

      if(!empty($_POST['update_name'])){

         $saved= $bd->update("UPDATE users SET 
         nome_comple=$nome_comple,
         updated_at=NOW()
         WHERE id_cliente=:id_cliente"
          );
      }elseif(!empty($morada)){
         $saved= $bd->update("UPDATE users SET 
         morada=$morada,
         updated_at=NOW()
         WHERE id_cliente=:id_cliente"
          );
      }elseif(!empty($cidade)){
         $saved= $bd->update("UPDATE users SET 
         cidade=$cidade,
         updated_at=NOW()
         WHERE id_cliente=:id_cliente"
          );
      }elseif(!empty($telefone)){
         $saved= $bd->update("UPDATE users SET 
         telefone=$telefone,
         updated_at=NOW()
         WHERE id_cliente=:id_cliente"
          );
      }else{
         $_SESSION['erro'] = "error updating";
      }

   

      $old_pass=$_SESSION['old_password'];
      $update_pass=trim($_POST['update_pass']);
  
      
      if($update_pass != null){
         $verified= password_verify($update_pass, $old_pass);
         if(!$verified){
            $_SESSION['erro']="Old password does not march";
            Store::redirect('perfil');
         }else{
            Store::redirect('perfil');
         }
      }

      
      $new_password = password_hash(trim($_POST['new_pass']), PASSWORD_DEFAULT);
      $confirm_password =trim($_POST['confirm_pass']);

      $parametros=[
         ':new_password'=> $new_password,
      ];

      

      if(!empty($new_password) && $new_password!=null){
         $verified_newPassword = password_verify($confirm_password, $new_password);
         if(!$verified_newPassword){
            $_SESSION['erro']= "new password does not match";
            Store::redirect('perfil');
         }else{
            $bd->update("
               UPDATE
               users
               SET
               senha =:new_password,
               updated_at =NOW() WHERE id_cliente=:id_cliente

            ",$parametros);
         } 
      }
      
      Store::redirect("perfil");


   }
   //=======================================VALIDAÇÃO DO Login====================================
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
