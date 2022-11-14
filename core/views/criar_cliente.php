<div class="container"></div>
<div class="row my-5">
    <div class="col-sm-6 offset-sm-3">
        <h3 class="text-center">Registo de Novo Cliente</h3>

        <form action="?a=criar_cliente" method="post">

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
                <input type="email" name="text_email" placeholder="Email" class="form-control" required>
            </div>

            <!-- Senha_1 -->
            <div class="my-3">
                <label>Senha</label>
                <input type="password" name="text_senha_1" placeholder="Senha" class="form-control" required>
            </div>

            <!-- Senha_1 -->
            <div class="my-3">
                <label>Repetir a Senha</label>
                <input type="password" name="text_senha_2" placeholder="Repetir a Senha" class="form-control" required>
            </div>

            <!-- Nome completo -->
            <div class="my-3">
                <label>Nome Completo</label>
                <input type="text" name="text_nome_completo" placeholder="Nome completo" class="form-control" required>
            </div>

            <!-- Morada -->
            <div class="my-3">
                <label>Morada</label>
                <input type="text" name="text_morada" placeholder="Morada" class="form-control" required>
            </div>

            <!-- Cidade -->
            <div class="my-3">
                <label>Cidade</label>
                <input type="text" name="text_cidade" placeholder="Cidade" class="form-control" required>
            </div>

            <!-- Telefone -->
            <div class="my-3">
                <label>Telefone</label>
                <input type="text" name="text_telefone" placeholder="Telefone" class="form-control">
            </div>

            <!-- Submit -->
            <div class="my-3">
                <input type="submit" value="Criar conta" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>
</div>
