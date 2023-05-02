<?php
   include('dbConnection.php');

      if(!isset($_SESSION['id'])){
        header('Location: index.php');
      }
      else{
        $user =  $db->readOne('user',['login','password','nameAndSurname','address'],[['id','=',$_SESSION['id']]]);
        $user = json_decode(json_encode ( $user ) , true);

            if(isset($_POST['submit2'])){
                $arrayColumn = [];
                $arrayAll = [];
                $arrayValues = [];
                $counter = 0;

                if(isset($_POST['login'])){
                        array_push($arrayColumn,'login');
                            $arrayAll[$counter][0] = "login";
                            $arrayAll[$counter][1] = "=";
                            array_push($arrayValues,$_POST['login']);
                            $arrayAll[$counter][2] = $user['login'];
                            $counter++;
                        }

                if(isset($_POST['password'])){
                        array_push($arrayColumn,'password');
                        array_push($arrayValues,$_POST['password']);
                            $arrayAll[$counter][0] = "password";
                            $arrayAll[$counter][1] = "=";
                            $arrayAll[$counter][2] = $user['password'];
                            $counter++;
                        }

                if(isset($_POST['nameAndSurname'])){
                        array_push($arrayColumn,'nameAndSurname');
                        array_push($arrayValues,$_POST['nameAndSurname']);
                            $arrayAll[$counter][0] = "nameAndSurname";
                            $arrayAll[$counter][1] = "=";
                            $arrayAll[$counter][2] = $user['nameAndSurname'];
                            $counter++;
                        }

                if(isset($_POST['address'])){
                            array_push($arrayColumn,'address');
                            array_push($arrayValues,$_POST['address']);
                            $arrayAll[$counter][0] = "address";
                            $arrayAll[$counter][1] = "=";
                            $arrayAll[$counter][2] = $user['address'];
                            $counter++;
                        }

              $db->update('user',$arrayColumn,$arrayValues,$arrayAll);
              header('Location:userSide.php');
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
include('navBar.php');
?>
  
<fieldset <?php if(!isset($_POST['submit'])){
echo ("disabled"); } ?> >  
<div class="container">
  <h2>Dane o uzytkowniku</h2>
  <form action="userSide.php" method="POST">
    <div class="form-group">
      <label for="login">Login:</label>
      <input type="text" class="form-control" id="login" value="<?php echo($user['login']) ?>" name="login">
    </div>
    <div class="form-group">
      <label for="login">Hasło</label>
      <input type="text" class="form-control" id="password" value="<?php echo($user['password']) ?>" name="password">
    </div>
    <div class="form-group">
      <label for="nameAndSurname">Imie i nazwisko</label>
      <input type="text" class="form-control" id="nameAndSurname" value="<?php echo($user['nameAndSurname']) ?>" name="nameAndSurname">
    </div>
    <div class="form-group">
      <label for="address">Adres</label>
      <input type="text" class="form-control" id="address" value="<?php echo($user['address']) ?>" name="address">
    </div>
</div>
</fieldset>
<div class="container bcontent">
<button type="submit" name="submit" value="submit"  class="btn btn-primary ">Edytuj</button>
<button type="submit1" name="submit1"  class="btn btn-primary ">Zakończ Edycje</button>
<button type="submit2" name="submit2"  class="btn btn-primary ">Zatwierdż zamiany</button>
</div>
</form>
</body>
</html>