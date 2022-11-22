<?php 
  use core\classes\Database;
use core\classes\Store;

  $bd = new Database();

  $adminRole=$_SESSION['role_type'];
  $adminId=$_SESSION['admin'];
  $adminNome=$_SESSION['nome_admin'];

?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Total Admin: 
              <?php
                if(Store::LoggedAdminUser()){
                  $res= $bd->select("select count(id_admin) from admin_users" );
                  // array_count_values($res);
                  // echo $res;
                  foreach($res as $i =>$res){
                    echo $i;
                  }
                }
              ?>
               </h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings</div>

              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
              if(Store::LoggedAdminUser()){
                if($adminRole=='admin'){
                $res=$bd->select("select wins from trip_values" );
                  foreach($res as $i =>$res){
                    echo  $res->wins . "MT";
                  }
                 
                }else{
                  echo 0;
                }
               }
               ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
<?php
  

$res =$bd->select("SELECT * FROM admin_users");

// $qtd=$res->num_rows;

if ($res >0) {
if ($adminRole=='admin') {
  echo  "<h1>Lista de Admins e manageres</h1>";
    // echo "<script>alert('you r admin')</script>";

    print "<table class='table table-striped table-bordered table-hover'";

    print "<tr>";
    print "<th>Nome</th>";
    print "<th>Email</th>";
    print "<th>criado em</th>";
    print "<th>roles</th>";
    print "<th>purl</th>";
    print "<th>activo</th>";
    print "<th>butoes</th>";
    print "</tr>";

    // o fetch_object vai disponibilizar-nos que inprimemos os dados da base de dados.
    foreach ($res as $i=>$res) {
        print "<tr>";
        print "<td>". $res->nome_admin;
        "</td>";
        print "<td>". $res->email;
        "</td>";
        print "<td>". $res->created_at;
        "</td>";
        print "<td>". $res->roles;
        print "<td>". $res->purl;
        print "<td>". $res->activo;
        "</td>";
        //aqui vem os botoes!
           print "<td>
                <a href='?a=edit_admin' class='btn btn-primary'>edit</a>

                <a class='btn btn-danger' href='?page=salvar&acao=excluir&id=$adminId'>Eliminar</a>
        
             </td>";
        print "<tr>";
    }

    print "<table>";
}
}else{
    print "<p class=alert alert-danger>não encontrou Resultado</p>";

}

?>
  <!-- Content Row -->
  <h1>Lista dos users de Clientes</h1>
  <?php
   $adminRole=$_SESSION['role_type'];
   $adminId=$_SESSION['admin'];
   $adminNome=$_SESSION['nome_admin'];

$res =$bd->select("SELECT * FROM users");

// $qtd=$res->num_rows;

if ($res >0){
print "<table class='table table-striped table-bordered table-hover'";

        print "<tr>";

        // print "<th>Codigo</th>";
        print "<th>Nome</th>";
        print "<th>Email</th>";
        print "<th>criado em</th>";
        print "<th>Activo</th>";
        print "<th>Ações</th>";
        print "</tr>";

      // o fetch_object vai disponibilizar-nos que inprimemos os dados da base de dados.
      foreach($res as $i=>$res){
    print "<tr>";
    print "<td>". $res->nome_comple;
    "</td>";
    print "<td>". $res->email;
    "</td>";
    print "<td>". $res->created_at;  "</td>";
    print "<td>". $res->activo;  "</td>";
    //aqui vem os botoes!
    print "<td>
                <button class='btn btn-primary' 
                onclick=\"

                location.href='?page=editar&id= ".$_SESSION['admin']." ' \"
                
                >Edidar</button>


                <a class='btn btn-danger' href='?page=salvar&acao=excluir&id=$adminId'>Eliminar</a>
        
             </td>";

    print "<tr>";
}
           
print "<table>";
}else{
    print "<p class=alert alert-danger>não encontrou Resultado</p>";
}
?>