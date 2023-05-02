<?php 

include('dbConnection.php');

  if(isset($_SESSION['id'])){
    header('Location: index.php');
  }
  if (isset($_POST['login']) && isset($_POST['password'])&& isset($_POST['nameAndSurname'])&& isset($_POST['address'])) {
        $isExist = ( $db->readOne('user',['login'],[['login','=',$_POST['login']]]));
        $array = json_decode(json_encode ( $isExist ) , true);
        if($array==null){
          if(strlen( $_POST['login'])>5 && strlen($_POST['password'])>6 && strlen($_POST['nameAndSurname'])>5 && strlen($_POST['address'])>3){
            echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Rejestracja udana</div></div>");
            $options = [
              'cost' => 12,
          ];
           $db->insert('user',['role','login','password','nameAndSurname','address'],[['1',$_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT, $options), $_POST['nameAndSurname'], $_POST['address']]]);
          }
          else{
            echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Za mało znaków</div></div>");
                 
             }
      }
      else{
         echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Istnieje login</div></div>");
              
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
<?php
include('navBar.php');
?>

<form action="register.php" method="POST">
        <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 100px">
            <label for="exampleInputLogin">Login</label>
            <input type="text" class="form-control" name="login" autocomplete="off" id="exampleInputEmail1" placeholder="Wpisz Login"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputPassword">Hasło</label>
            <input type="password" class="form-control" name="password" autocomplete="off" id="exampleInputPassword" placeholder="Wpisz Hasło"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputNS">Imie i Nazwisko</label>
            <input type="text" class="form-control" name="nameAndSurname" autocomplete="off" id="exampleInputNS" placeholder="Wpisz Imie i nazwisko"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputAddress">Adres</label>
            <input type="text" class="form-control" autocomplete="off" name="address" id="exampleInputAddress" placeholder="Wpisz Adres"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <button class="btn btn-primary btn-lg" type="submit">Zarejestruj</button>
        </form>
        </div>

</body>
</html>
