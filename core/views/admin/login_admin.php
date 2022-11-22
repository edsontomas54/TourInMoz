<div class="row my-5">
    <div class="col-sm-4 offset-sm-4">
    
        <?php if(isset($_SESSION['erro'])):?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['erro']  ?>
                <?php unset($_SESSION['erro']); ?>
                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close" ></button>
            </div>
            
        <?php   endif;?>    
        <div>
        <h3 class="text-center">Login</h3>

        <form action="?a=login_submit_admin" method="post">

            <div class="my-3">
                <label>User:</label>
                <input type="email" name="email_admin" placeholder="User Admin" class="form-control" required>
            </div>

            <div class="my-3">
                <label>Senha:</label>
                <input type="password" name="senha_admin" placeholder="Senha" class="form-control" required>
            </div>

            <div class="my-3 text-center">
                You not registered?   <a href="?a=admin_regist">Regist</a>
            </div>

            <div class="my-3 text-center">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>

        </form>
        </div>
    </div>
</div>
</div>
