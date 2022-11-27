<?php

namespace  core\controllers;

use core\classes\Database;
use core\classes\Store;
use core\models\Clientes;
use core\classes\enviarEmail;
use core\classes\Trip;
use core\models\produtos;

class Main
{
    //==============================================================
    public  function index()
    {
        //chamando as paginas! como usamos o static podemos acessar directamente
        Store::Layout([
           'layouts/html_header',
           'layouts/header',
           'inicio',
           'layouts/footer',
           'layouts/html_footer'
        ]);
        /*
1. carregar e tratar dados (cálculos) (bases de dados)
2. Apresentar o layout (views)
*/
    }

    //==============================================================
    public function book()
    {
        Store::Layout([
                  'layouts/html_header',
                  'layouts/header',
                  'book',
                  'layouts/footer',
                  'layouts/html_footer',
               ]);
    }

     //==============================================================
     public function not_login_message()
     {
         Store::Layout([
                   'layouts/html_header',
                   'layouts/header',
                   'not_login_message',
                   'layouts/footer',
                   'layouts/html_footer',
                ]);
     }

      //==============================================================
      public function perfil()
      {
          Store::Layout([
                    'layouts/html_header',
                    'layouts/header',
                    'perfil',
                    'layouts/footer',
                    'layouts/html_footer',
                 ]);
      }

     //==============================================================
     public function regist_trip()
     {
         //Verifica se houve submisaão de um formulario
         if ($_SERVER['REQUEST_METHOD'] != 'POST') {
             $this->book();
             return;
         }

         if (Store::clienteLogado()) {
             $regist = new Trip();
             $regist->regist_trip_client()==1;
             return $this->book();
         } else {
             return $this->not_login_message();
         }
     }

      //==============================================================
      public function package()
      {
          Store::Layout([
             'layouts/html_header',
             'layouts/header',
             'package',
             'layouts/footer',
             'layouts/html_footer'
          ]);
      }

       //==============================================================
       public function about()
       {
           Store::Layout([
              'layouts/html_header',
              'layouts/header',
              'about',
              'layouts/footer',
              'layouts/html_footer'
           ]);
       }


    //===========================NOVO CLIENTE===================================
    public function novo_cliente()
    {
        //Verifica se ja existe sessao aberta!

        if (Store::clienteLogado()) {
            $this->index();
            return;
        }
        //Apresenta o layout para criar um novo utilizador

        Store::Layout([
           'layouts/html_header',
           'layouts/header',
           'criar_cliente',
           'layouts/footer',
           'layouts/html_footer'
        ]);
    }

    //===========================NOVO CLIENTE===================================
    public function criar_cliente()
    {
        //Verifica se ja existe sessao
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        //Verifica se houve submisaão de um formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        //CRIAÇÃO DO NOVO CLIENTE

        //verifica se senha 1 =senha 2
        if ($_POST['text_senha_1'] !== $_POST['text_senha_2']) {
            //as passwords sao diferentes
            $_SESSION['erro'] = 'As senhas são diferentes';
            $this->novo_cliente();
            return;
        }

        //Verifica na base de dados se existe cliente com mesmo email
        $cliente= new Clientes();

        if ($cliente->verificar_email_existe($_POST['text_email'])) {
            $_SESSION['erro'] = 'O email ja foi registado';
            $this->novo_cliente();
            return;
        }

        // pronto para criar um cliente

        //inserir novo cliente na base de dados e devolver o purl


        // envio do email para o cliente
        $email_cliente= strtolower(trim($_POST['text_email']));

        $purl=$cliente->registar_cliente();//Esta função retorna o purl que esta associado ao cliente
        $email = new enviarEmail();

        $resultado = $email-> enviar_email_confirmacao_novo_cliente($email_cliente, $purl);
        // $resultado = "";

        //   if($purl != null){
      //    $email = new enviarEmail();

      //    $resultado = $email-> enviar_email_confirmacao_novo_cliente($email_cliente, $purl);
        //   }

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

        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        //Verifica se existe na query uma Stgring de um purl,//USAMOS O GET PORQUE O PURL É UMA STRING.

        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

      //verifica se que o purl é valido
        if (strlen($purl) !=12) {// STRLEN PERMITE NOS ACEDERMOS UM TAMANHO.
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado= $cliente->validar_email($purl);

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

    public function login()
    {
        //Verificar se ja existe um utilizador logado! se não tiver vai para a pagina inicial.
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }
        //==========================Apresenta o layout de formulario login.
        Store::Layout([
          'layouts/html_header',
          'layouts/header',
          'login_frm',
          'layouts/footer',
          'layouts/html_footer'
        ]);
        return;
    }
       //==============================================================Login...

    public function login_submit()
    {
        //Verificar se ja existe um utilizador logado! se não tiver vai para a pagina inicial.
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }
        //verifica se foi efetuado o post do formulario do login

        if ($_SERVER['REQUEST_METHOD'] !="POST") {
            Store::redirect();
            return;
        }

        //Validar se os campos vieram corretamente preenchidos

        if (!isset($_POST['text_usuario']) ||
        !isset($_POST['text_senha'])   ||
        !filter_var(trim($_POST["text_usuario"]), FILTER_VALIDATE_EMAIL)) {
            //ERRO de prenchimento do formulario!
            $_SESSION['erro'] = 'login invalido tente novamente';
            Store::redirect("login");
            return;
        }

        //prepara os dados para o model, clientes.

        $usuario= trim(strtolower($_POST["text_usuario"]));
        $senha = trim($_POST['text_senha']);

        //carrega o model cliente e verifica se o login é valido.

        $cliente = new Clientes();
        $resultado = $cliente->validar_login($usuario, $senha);

        //analizar o resuldad

        if (is_bool($resultado)) {
            // login invalido
            $_SESSION['erro']= "Login invalido";

            Store::redirect('login');
            return;
        } else {
            //login valido
            $_SESSION['cliente'] = $resultado->id_cliente;
            $_SESSION['email']=$resultado->email;
            $_SESSION['nome_cliente'] = $resultado->nome_comple;
            $_SESSION['cidade'] = $resultado->cidade;
            $_SESSION['morada'] = $resultado->morada;
            $_SESSION['telefone'] = $resultado->telefone;
            $_SESSION['image'] = $resultado->image;
            $_SESSION['old_password']=$resultado->senha;

            //redicionamento
            Store::redirect();
        }
    }
       //==============================================================Logout
    public function logout()
    {
        //remove as variaveis da sessão
        unset($_SESSION['cliente']);
        unset($_SESSION['email']);
        unset($_SESSION['nome_cliente']);
        unset($_SESSION['cidade']);
        unset($_SESSION['morada']);
        unset($_SESSION['telefone']);
        unset($_SESSION['image']);
        unset($_SESSION['old_password']);

        //redicionamento
        Store::redirect();
    }

    //========================================================
    public function perfil_user()
    {
        $bd = new Database();
        $id_cliente= $_SESSION['cliente'];
       
             $image = $_FILES['image']['name'];
             $image_size = $_FILES['image']['size'];
             $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '/public/assets/uploded_img/'.$image;

            $paramets=[
                ':image' =>$image,
                ':id_cliente' => $id_cliente
            ];

    if (!empty($image)) {
    if ($image_size > 2000000) {
        $_SESSION['erro'] = 'image size is too large!';
    } elseif($image !=null) {
                    $update = $bd->update("UPDATE users SET image = :image,
                         created_at=NOW() 
                         where id_cliente=:id_cliente
                       ",$paramets);
                      
        if ($update) {
            // die("worked");
            move_uploaded_file($image_tmp_name, $image_folder);
           $_SESSION['success'] = 'registered successfully!';
            Store::redirect('perfil');
        } else {
            $_SESSION['erro'] = 'registeration failed!';

        }
    }
    
}

        $cliente = new Clientes();  //perfil_user

        $cliente->perfir_user_update();
       
       
     
    }

        public function adventure(){
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'adventure',
                'layouts/footer',
                'layouts/html_footer'
             ]);
        }
    //==============================================================Carinho
    public function carrinho()
    {
        //Pagina dya loja

        Store::Layout([
           'layouts/html_header',
           'layouts/header',
           'carrinho',
           'layouts/footer',
           'layouts/html_footer'
        ]);
    }
}