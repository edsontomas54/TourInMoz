<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\admin;
use core\models\Clientes;

class AdminUsersController
{


    public function admin()
    {
      if(Store::clienteLogado()){
        Store::redirect('inicio');
      }      

      if(!Store::LoggedAdminUser()){
        Store::redirect('login_admin');
      }
      $roleAdmin = $_SESSION['role_type'];

    //   if($roleAdmin !='/^admin/i'){
    //      Store::redirect('admin_regist');
    //   }
        Store::Layout([
         
           'layouts/header_admin',
           'layouts/navbar_admin',
           'adminIndex',
           'layouts/scripts_admin',
           'layouts/footer_admin',

        ]);
    }

    public function registAdminUser(){

          if(Store::LoggedAdminUser()){
        Store::redirect('admin_painel');
      }  

        Store::Layout([
            
            'layouts/header_admin',
            'layouts/navbar_admin',
            'admin/register',
            'layouts/scripts_admin',
            'layouts/footer_admin',
        ]);
    }

    public function create_admin_user(){

    if($_SERVER["REQUEST_METHOD"]!="POST"){
        return Store::redirect('admin_regist');
        return;
    }

    if(Store::LoggedAdminUser()){
        echo "<script>alert('pls logout first')</script>";
        Store::redirect('admin_regist');
        return;
    }

   
    $senha =password_hash(trim($_POST['senha_admin']), PASSWORD_DEFAULT);
    // $nome =trim($_POST['nome_admin']);
    // $role_type = trim($_POST['role_type']);

    if($_POST['senha_admin']!==$_POST['senha_admin2']){
        $_SESSION['erro']="As senhas são diferentes!";
        Store::redirect('admin_regist');
        return;
    }

    $admin_user = new admin;

   
    if ($admin_user->verificar_email_existe($_POST['email_admin'])) {
        $_SESSION['erro'] = 'O email ja foi registado';
        $this->registAdminUser();
        return;
    }
        $email_admin= strtolower(trim($_POST['email_admin']));

        $purl=$admin_user->registar_cliente();//Esta função retorna o purl que esta associado ao cliente
        $email = new EnviarEmail();

        $resultado = $email-> enviar_email_confirmacao_novo_cliente($email_admin, $purl);


        if ($resultado) {
            //==========================Apresenta o layout da mensagem de confirmação
            Store::Layout([
             'layouts/html_header',
             'layouts/header',
             'criar_cliente_sucesso',
             'layouts/footer',
             'layouts/html_footer'
            ]);
            return;
        } else {
            echo "error!";
        }

    }

     // ========================================CONFIRMAR EMAIL =================================
     public function confirmar_email()
     {
         //Verifica se ja existe um cliente logado/
 
         if (Store::LoggedAdminUser()) {
             Main::index();
             return;
         }
 
         //Verifica se existe na query uma Stgring de um purl,//USAMOS O GET PORQUE O PURL É UMA STRING.
 
         if (!isset($_GET['purl'])) {
             Main::index();
             return;
         }
 
         $purl = $_GET['purl'];
 
       //verifica se que o purl é valido
         if (strlen($purl) !=12) {// STRLEN PERMITE NOS ACEDERMOS UM TAMANHO.
             Main::index();
             return;
         }
 
         $admin_user = new admin();
         $resultado= $admin_user->validar_email($purl);
 
         if ($resultado) {
             //==========================Apresenta o layout para informar a conta foi confirmada com sucessa.
             Store::Layout([
              'layouts/html_header',
              'layouts/header',
              'conta_confirmada_sucesso',
              'layouts/footer',
              'layouts/html_footer'
       ]);
             return;
         } else {
             //Redicionar para a pagina inicial
             Store::redirect();
         }
     }
     public function LoginAdmin(){
          //Verificar se ja existe um utilizador logado! se não tiver vai para a pagina inicial.
        //   if (Store::LoggedAdminUser()) {
        //     Store::redirect();
        //     return;
        // }
        //==========================Apresenta o layout de formulario login.
        Store::Layout([
          'layouts/html_header',
          'layouts/header',
          'login_admin',
          'layouts/footer',
          'layouts/html_footer'
        ]);
        return;
     }

     public function login_admin(){
        Store::Layout([
           
            'layouts/header_admin',
           'layouts/navbar_admin',
           'admin/login_admin',
           'layouts/scripts_admin',
           'layouts/footer_admin',
        ]);
     }

           //==============================================================Login...

    public function login_submit_admin()
    {
        //Verificar se ja existe um utilizador logado! se não tiver vai para a pagina inicial.
        if (Store::LoggedAdminUser()) {
            Store::redirect('login_admin');
            return;
        }
        //verifica se foi efetuado o post do formulario do login

        if ($_SERVER['REQUEST_METHOD'] !="POST") {
            Store::redirect();
            return;
        }

        //Validar se os campos vieram corretamente preenchidos

        if (!isset($_POST['email_admin']) ||
        !isset($_POST['senha_admin'])   ||
        !filter_var(trim($_POST["email_admin"]), FILTER_VALIDATE_EMAIL)) {
            //ERRO de prenchimento do formulario!
            $_SESSION['erro'] = 'login invalido tente novamente';
            Store::redirect("login_admin");
            return;
        }

        //prepara os dados para o model, clientes.

        $email_admin= trim(strtolower($_POST["email_admin"]));
        $senha_admin = trim($_POST['senha_admin']);

        //carrega o model cliente e verifica se o login é valido.

        $admin = new admin();
        $resultado = $admin->validar_login($email_admin, $senha_admin);

        //analizar o resuldado

        if (is_bool($resultado)) {
            // login invalido
            $_SESSION['erro']= "Login invalido senha ou email invaliido";

            Store::redirect('login_admin');
            return;
        } else {
            //login valido
            $_SESSION['admin'] = $resultado->id_admin;
            $_SESSION['email_admin']=$resultado->email;
            $_SESSION['nome_admin'] = $resultado->nome_admin;
            $_SESSION['role_type'] = $resultado->roles;
            $_SESSION['purl'] = $resultado->purl;
            $_SESSION['activo'] = $resultado->purl;
            //redicionamento
            
            Store::redirect('admin_painel');
        }
    }
       //==============================================================Logout
    public function logout_admin()
    {
        //remove as variaveis da sessão
        unset($_SESSION['admin']);
        unset($_SESSION['email_admin']);
        unset($_SESSION['nome_admin']);
        unset($_SESSION['role_type']);
        unset($_SESSION['purl']);
        unset($_SESSION['activo']);
      
        //redicionamento
        Store::redirect("login_admin");
    }

    public function edit_admin(){
        if(Store::LoggedAdminUser()){
            $roleAdmin = $_SESSION['role_type'];
            if($roleAdmin !='admin'){
                echo "You are not allowed to edit!";

                return Store::redirect('admin_painel');
            }
        }

        Store::Layout([
           
            'layouts/header_admin',
            'layouts/navbar_admin',
            'admin/permitions/edit_admins_users',
            'layouts/scripts_admin',
            'layouts/footer_admin',
        ]);
     

    }

    public function update_admin(){

        $db = new Database();
        $id_admin = $_SESSION['admin'];
        // $id_admin = $_GET['id_admin'];

        $paramets=[
            ':nome_admin'=> trim($_POST['update_nomeAdmin']),
            ':purl'=> trim($_POST['purl']), 
            ':activo'=> trim($_POST['activo']), 
            ':role_type'=> trim($_POST['update_role_type']), 
            ':id_admin' => $id_admin,
        ];
       
        // $db->update("UPDATE users SET purl=NULL, activo='1', updated_at=NOW() WHERE id_cliente=:id_cliente", $parametros);
       $admin_updated= $db->update("

            UPDATE
            admin_users
            SET
            nome_admin=:nome_admin,
            purl =:purl,
            activo=:activo,
            roles =:role_type,
            updated_at =NOW()
            where
            id_admin=:id_admin

        ", $paramets);
        
        if($admin_updated){
            $_SESSION['sucess']="updated";
          return  Store::redirect("edit_admin");

        }else {
            $_SESSION['erro']="error";
            return Store::redirect("edit_admin");
        } 
    }

    public function delete_admin_user(){
        $db = new Database();
        $id_admin = $_GET['id_admin'];

        $paramets=[
            ':nome_admin'=> trim($_POST['update_nomeAdmin']),
            ':purl'=> trim($_POST['purl']), 
            ':activo'=> trim($_POST['activo']), 
            ':role_type'=> trim($_POST['update_role_type']), 
            ':id_admin' => $id_admin,
        ];
        // $db->update("UPDATE users SET purl=NULL, activo='1', updated_at=NOW() WHERE id_cliente=:id_cliente", $parametros);
        $db->delete("

            UPDATE
            admin_users
            SET
            nome_admin=:nome_admin,
            purl =:purl,
            activo=:activo,
            roles =:role_type,
            updated_at =NOW()
            where
            id_admin=:id_admin

        ", $paramets);

        Store::redirect("edit_admin");

    }
}

