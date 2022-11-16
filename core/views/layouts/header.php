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
               <i class="fas fa-user mx-2"></i><?= $_SESSION['usuario']  ?>

                <a href="?a=logout">LogOut</a>
    
            <?php  else:?>
                <a href="?a=login" >Login</a>
                <a href="?a=novo_cliente">Criar conta</a>
            <?php  endif;?>
</nav>

<div id="menu-btn" class="fas fa-bars"></div>
</section>


<!-- <section class="header">

    <a href="home.php" class="logo">Moz Tour.</a>

    <nav class="navBar">
    <a href="home.php" >home</a>
    <a href="about.php" >Sobre Nos</a>
    <a href="package.php" >Nossos Pacotes</a>
    <a href="book.php" >Marque Viajem</a>
 </nav>
 <div id="menu-btn" class="fas fa-bars"></div>
</section> -->