<?php
   include('dbConnection.php');

            if(!isset($_SESSION['id'])||$_SESSION['role']!=0){
                header('Location: index.php');
              } 
            $data =$db->readAll('books');
        

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
if (isset($_POST['image']) && isset($_POST['title'])&& isset($_POST['bookProducent'])&& isset($_POST['numberOfAvailableBooks'])&& isset($_POST['description'])) {
        $isExist = ( $db->readOne('books',['title'],[['title','=',$_POST['title']]]));
        $array = json_decode(json_encode ( $isExist ) , true);
        if($array==null){
          if(strlen( $_POST['image'])>5 && strlen($_POST['title'])>3 && strlen($_POST['bookProducent'])>3 && strlen($_POST['description'])>10){
            echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Książka dodana</div></div>");
            $db->insert('books',['image','title','bookProducent','numberOfAvailableBooks','description'],[[$_POST['image'],$_POST['title'],$_POST['bookProducent'],$_POST['numberOfAvailableBooks'],$_POST['description']]]);
          }
          else{
            echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Za mało znaków</div></div>");
                 
             }
      }
      else{
         echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Istnieje tytuł</div></div>");
              
          }

  }
  ?>
<form action="insertBook.php" method="POST">
        <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 100px">
            <label for="exampleInputimage">Okładka</label>
            <input type="text" class="form-control" name="image" id="exampleInputimage" placeholder="Wpisz Ścieżke do zdj"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputTitle">Tytuł</label>
            <input type="text" class="form-control" name="title" id="exampleInputTitle" placeholder="Wpisz Tytuł"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputbookProducent">Wydawca</label>
            <input type="text" class="form-control" name="bookProducent" id="exampleInputbookProducent" placeholder="Wpiszwydawce"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputnumberOfAvailableBooks">Liczba książek</label>
            <input type="text" class="form-control" name="numberOfAvailableBooks" id="exampleInputnumberOfAvailableBooks" placeholder="Wpisz Liczbe książęk"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
         <label for="exampleInputdescription">Opis</label>
            <input type="text" class="form-control" name="description" id="exampleInputdescription" placeholder="Wpisz Opis"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <button class="btn btn-primary btn-lg" type="submit">Zarejestruj</button>
        </form>
        </div>

</body>
</html>
