
<div class="row my-5">
    <div class="col-sm-6 offset-sm-3">
        <h3 class="text-center">Registo de Novo Cliente</h3>

        <form action="?a=create_admin_user" method="post">

            <!-- error -->
            <?php if (isset($_SESSION['erro'])) : ?>
                <div class="alert alert-danger alert-dismissible text-center p-2">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                    <?= $_SESSION['erro'] ?>
                   <?php unset($_SESSION['erro']);?> 
                </div>
            <?php endif; ?>
            <!-- Email -->
            <div class="my-3">
                <label>Email</label>
                <input type="email" name="email_admin" placeholder="Email" class="form-control" required>
            </div>

            <!-- Senha_1 -->
            <div class="my-3">
                <label>Senha</label>
                <input type="password" name="senha_admin" placeholder="Senha" class="form-control" required>
            </div>

            <!-- Senha_1 -->
            <div class="my-3">
                <label>Repetir a Senha</label>
                <input type="password" name="senha_admin2" placeholder="Repetir a Senha" class="form-control" required>
            </div>

            <!-- Nome completo -->
            <div class="my-3">
                <label>Nome Completo</label>
                <input type="text" name="nome_admin" placeholder="Nome completo" class="form-control" required>
            </div>

            <div class="my-3">
            <select name="role_type" class="form-control" >
             <option value="Manager">Manager</option>
            <option value="admin">admin</option>
            </select>
            </div>

            <div class="my-3 text-center">
                Having an Admin account   <a href="?a=login_admin">Login</a>
            </div>
            <!-- Submit -->
            <div class="my-3">
                <input type="submit" value="Criar conta" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>
</div>
