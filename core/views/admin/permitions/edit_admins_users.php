<?php   

use core\classes\Database;

$db= new Database();

?>
<div class="row my-5">
    <div class="col-sm-6 offset-sm-3">
        <h3 class="text-center">Update user Admin</h3>

        <form action="?a=update_admin" method="post">

            <!-- error -->
            <?php
                if (isset($_SESSION['erro'])) : ?>
                <div class="alert alert-danger alert-dismissible text-center p-2">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                    <?= $_SESSION['erro'] ?>
                   <?php unset($_SESSION['erro']);?> 
                </div>
            <?php endif; ?>
            <input type="hidden" name="id" value="<?php print $_SESSION['admin']; ?>" />
            <!-- Email -->
            <div class="my-3">
                <label>Nome</label>
                <input type="text" name="update_nomeAdmin"  class="form-control"  value="<?= $_SESSION['nome_admin']; ?>">
            </div>

            <!-- Senha_1 -->
            <div class="my-3">
                <label>Purl</label>
                <input type="text" name="purl" class="form-control" value="<?= $_SESSION['purl']; ?>">
            </div>

            <!-- Nome completo -->
            <div class="my-3">
                <label>activo</label>
                <input type="number" name="activo"  class="form-control"  min='0' max='1' value="<?php
                
                $_SESSION['activo']; 
               
                ?>">
            </div>

            <div class="my-3">
            <label>Role Type</label>
            <select name="update_role_type" class="form-control" >
             <option value="Manager">Manager</option>
            <option value="admin">admin</option>
            </select>
            </div>
            <!-- Submit -->
            <div class="my-3">
                <input type="submit" value="Criar conta" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>
</div>


<p>

</p>