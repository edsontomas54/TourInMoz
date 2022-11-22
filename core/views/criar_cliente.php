<main>
    <h1>Criar Conta!</h1>

     <form method="post" class="form_create_client" action="?a=criar_cliente" method="post">

        <!-- error -->
        <?php if (isset($_SESSION['erro'])) : ?>
            <div class="alert alert-danger alert-dismissible text-center p-2">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                <?= $_SESSION['erro'] ?>
                <?php unset($_SESSION['erro']);?> 

            </div>
        <?php endif; ?>
        <!-- EMAIL -->
        <div class="inputBox">
          <label> E-mail </label>
          <input type="email" name="text_email" placeholder="email@provedor.com" >
        </div>

         <!-- SENHA -->
        <div class="inputBox">
          <label> Senha </label>
          <input type="password" name="text_senha_1" placeholder="Digite uma senha" >
        </div>

        <!-- REPETE SENHA -->
        <div class="inputBox">
          <label> Repete Senha </label>
          <input type="password" name="text_senha_2" placeholder="Repita a senha">
        </div>

        <!-- NOME COMPLETO -->
        <div class="inputBox">
          <label> Nome Completo </label>
          <input type="text" name="text_nome_completo" placeholder="Digite seu nome">
        </div>
    
        <!-- MORADA-->
        <div class="inputBox">
          <label> Morada </label>
          <input type="text" name="text_morada" placeholder="Digite a sua morada">
        </div>

        <!-- Cidade  -->
        <div class="inputBox">
          <label> Cidade</label>
          <input type="text" name="text_cidade" placeholder="Digite seu nome">
        </div>

         <!--Cidade  -->
         <div class="inputBox">
           <label> Telefone </label>
            <input type="text" name="text_telefone" placeholder="Digite seu telefone">
         </div>
      
        <!-- Submit -->
        <button type="submit" class="btn">Criar conta</button>

      </form>
    </main>