<?php
include('dbConnection.php');

  if(isset($_SESSION['id'])){
    header('Location: index.php');
  }
  else{
    if(isset($_POST['login']) && isset($_POST['password'])){
       $isExist =  $db->readOne('user',['role','id','login','password'],[['login','=',$_POST['login']]]);
       if($isExist && password_verify($_POST['password'], $isExist->password)){
        $_SESSION['id'] = $isExist->id;
        $_SESSION['role'] = $isExist->role;
        header('Location: index.php ');
       }
        else{ 
          echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Logowanie nie udane</div></div>");
        }
    }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo basename( $_SERVER['SCRIPT_NAME'],".php"); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Biblioteka</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Zarejestruj się</a></li>
    </ul>
  </div>
</nav>
<form action="login.php" method="POST">
        <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 100px">
            <label for="exampleInputLogin">Login</label>
            <input type="text" class="form-control" autocomplete="off" name="login" id="exampleInputEmail1" placeholder="Wpisz Login"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputPassword">Hasło</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Wpisz Hasło"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 100px">
            <button class="btn btn-primary btn-lg" type="submit">Loguj</button>
        </form>
        </div>

</body>
</html>


