<?php

// include 'config.php';
// session_start();
// $user_id = $_SESSION['user_id'];

// if(isset($_POST['update_profile'])){

//    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
//    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

//    mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

//    $old_pass = $_POST['old_pass'];
//    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
//    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
//    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

//    if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
//       if($update_pass != $old_pass){
//          $message[] = 'old password not matched!';
//       }elseif($new_pass != $confirm_pass){
//          $message[] = 'confirm password not matched!';
//       }else{
//          mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
//          $message[] = 'password updated successfully!';
//       }
//    }

//    $update_image = $_FILES['update_image']['name'];
//    $update_image_size = $_FILES['update_image']['size'];
//    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
//    $update_image_folder = 'uploaded_img/'.$update_image;

//    if(!empty($update_image)){
//       if($update_image_size > 2000000){
//          $message[] = 'image is too large';
//       }else{
//          $image_update_query = mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
//          if($image_update_query){
//             move_uploaded_file($update_image_tmp_name, $update_image_folder);
//          }
//          $message[] = 'image updated succssfully!';
//       }
//    }

 //}

use core\classes\Database;
use core\classes\Store;
use core\models\Clientes;

if(!Store::clienteLogado()){

   Store::redirect("inicio");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="update-profile">
           
   <form action="?a=perfil_user" method="post" enctype="multipart/form-data">
   <?php if(isset($_SESSION['erro'])):?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['erro']  ?>
                <?php unset($_SESSION['erro']); ?>
                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close" ></button>
            </div>
        <?php   endif;?>

        <?php if(isset($_SESSION['sucess'])):?>
            <div class="alert alert-sucess text-center">
                <?= $_SESSION['sucess']  ?>
                <?php unset($_SESSION['sucess']); ?>
                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close" ></button>
            </div>
        <?php   endif;?>
      <div class="flex">
         <div class="inputBox">


         <?php  if(Store::clienteLogado()):?>
               
            <img src="assets/images/<?= base64_encode( $_SESSION['image']) ==null ? "avatar.png" : $_SESSION['image']  ?>" >
            <?php  endif;?>

            <span>Nome :</span>

            <input type="text" name="update_name" value="" class="box">

            <span>your email :</span>
            <input type="email" name="update_email" value="" class="box">
           
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">

            <span>update your pic :</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
            
         </div>
         <div class="inputBox">
            <!-- -->
           
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>

            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">

            <span>Cidade :</span>
            <input type="text" name="update_cidade" placeholder="Cidade" class="box" value="">

            <span>Morada :</span>
            <input type="text" name="update_morada" placeholder="morada" class="box" value="">

            <span>Telefone :</span>
            <input type="text" name="update_telefone" placeholder="Telefone" class="box" value="">
         
         </div>
      </div>
      <input type="submit" value="update profile" name="submit" class="btn">
      <a href="home.php" class="delete-btn btn">go back</a>
   </form>

   <section class="booking-container">
   <form  class="book-form">
               <div class="flex-inputs">
                  <div class="inputBox">
                      <span>nome :</span>
                      <input type="text"  value="<?= $_SESSION['nome_cliente']; ?>" disabled>
                  </div>
                  <div class="inputBox">
                      <span>email :</span>
                      <input type="text"  value="<?= $_SESSION['email']; ?>" disabled>
                  </div>
                  <div class="inputBox">
                      <span>Cidade :</span>
                      <input type="text" value="<?= $_SESSION['cidade']; ?>" disabled>
                  </div>
                  <div class="inputBox">
                      <span>Morada :</span>
                      <input type="text" value="<?= $_SESSION['morada']; ?>" disabled>
                  </div>

                  <div class="inputBox">
                      <span>Telefone :</span>
                      <input type="text" value="<?= $_SESSION['telefone']; ?>" disabled>
                  </div>
   
               </div>
        </form>
</section>
  

</div>

</body>
</html>

