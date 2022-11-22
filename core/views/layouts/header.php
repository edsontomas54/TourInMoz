<?php
use core\classes\Store;

//teste! se o cliente estiver logado  forçando a existeça do cliente $_SESSION['cliente']=1;
?>
<section class="header">
           
                <a href="?a=inicio" class="logo"><h3><?= APP_NAME?></h3></a>
               
            
                <nav class="navBar">
                <a href="?a=inicio "class="nav-intem">HOME</a>
                <a href="?a=book">Book</a>
                <a href="?a=package" class="nav-intem">Package</a>
                <a href="?a=about" class="nav-intem">about</a>
    
             <!-- Verifica se existe cliente logado /na sessao -->
             <!-- Note: O IF FAZ:
            se tiver cliente logado, mostre a conta e o logout, se ñao te ver mostre o login e o criar conta!
             -->
            <?php  if(Store::clienteLogado()):?>
                <a href="?a=logout">LogOut</a>
                <a href="?a=perfil">
                    <img src="assets/images/<?= $_SESSION['image'] ==null ? "avatar.png" : $_SESSION['image']  ?>" width="5%" height="5%" style="border-radius:50%;">
                </a>
            <?php  else:?>
                <a href="?a=login" >Login</a>
                <a href="?a=novo_cliente">Criar conta</a>
            <?php  endif;?>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>
    </section>
