<?php  
     use core\classes\Store;

     //teste! se o cliente estiver logado  forçando a existeça do cliente $_SESSION['cliente']=1;
?>

<div class="container-fluid navStyle">
    <div class="row">
        <div class="col-6 p-3">
            <a href="?a=inicio"><h3><?= APP_NAME?></h3></a>
        </div>
        <div class="col-6 text-end p-3">
            <a href="?a=inicio "class="nav-intem">HOME</a>
            <a href="?a=book">Book</a>
            <a href="?a=package" class="nav-intem">Package</a>
            <a href="?a=about" class="nav-intem">about</a>

         <!-- Verifica se existe cliente logado /na sessao -->

         <!-- Note: O IF FAZ:
        se tiver cliente logado, mostre a conta e o logout, se ñao te ver mostre o login e o criar conta!
         -->
        <?php  if(Store::clienteLogado()):?>

            <!-- <a href="?a=minha_conta"class="nav-intem"> -->
           <i class="fas fa-user mx-2"></i><?= $_SESSION['usuario']  ?>
            <!-- </a> -->
            <a href="?a=logout"class="nav-intem">
                <i class="fas fa-sign-out-alt"></i>
            </a>

        <?php  else:?>

            <a href="?a=login"class="nav-intem">Login</a>
            <a href="?a=novo_cliente"class="nav-intem">Criar conta</a>

        <?php  endif;?>
         
            <span class="badge bg-warning"></span>
        </div>
    </div>
</div>