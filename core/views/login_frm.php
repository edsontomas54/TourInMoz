
<div class="row my-5">
    <div class="col-sm-4 offset-sm-4">
    
        <?php if(isset($_SESSION['erro'])):?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['erro']  ?>
                <?php unset($_SESSION['error']); ?>
                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close" ></button>
            </div>
            
        <?php   endif;?>    
        <div>
        <h3 class="text-center">Login</h3>

        <form action="?a=login_submit" method="post">

            <div class="my-3">
                <label>Usuário:</label>
                <input type="email" name="text_usuario" placeholder="Usuario" class="form-control" required>
            </div>

            <div class="my-3">
                <label>Senha:</label>
                <input type="password" name="text_senha" placeholder="Senha" class="form-control" required>
            </div>

            <div class="my-3 text-center">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>

        </form>
        </div>
    </div>
</div>
</div>
