<?php
  session_start();
  if(ISSET($_SESSION['login'])) Header("Location: ../master/");
  else session_destroy();
  
  if(ISSET($_GET['erro'])) {
    $erro = $_GET['erro'];
    if($erro == 1) {
     echo '<script>alert("Login ou senha incorretos!")</script>'; 
    }
  }
  
  include_once("lib/navbar.php");
  include_once("lib/head.php");
?>

<!DOCTYPE html>

<head>
  <?php ativarHead(); ?>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="container">
    <?php navbar("login",false); ?>
    
    <div class="row">
      <div class="loginmodal-container">
				<h1>Entre!</h1><br>
			  <form action="php/loginControl.php" method="POST">
				  <input type="text" name="login" placeholder="Login">
				  <input type="password" name="senha" placeholder="Senha">
  				<input type="submit" class="login loginmodal-submit" value="Login">
			  </form>
			</div>
    </div>
  </div>
</body>

</html>