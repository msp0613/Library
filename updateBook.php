<?php
           include('dbConnection.php');
            if(!isset($_SESSION['idBook'])||$_SESSION['role']!=0){
                header('Location: index.php');
              } 
            $data =$db->readOne('books',['image','title','bookProducent','numberOfAvailableBooks','description'],[['id','=',$_SESSION['idBook']]]);
            $data = json_decode(json_encode ( $data ) , true);
  
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

            if(isset($_POST['submit'])){
                $arrayColumn = [];
                $arrayAll = [];
                $arrayValues = [];
                $counter = 0;

                if(isset($_POST['image'])){
                        array_push($arrayColumn,'image');
                            $arrayAll[$counter][0] = "image";
                            $arrayAll[$counter][1] = "=";
                            array_push($arrayValues,$_POST['image']);
                            $arrayAll[$counter][2] = $data['image'];
                            $counter++;
                    }
                if(isset($_POST['title'])){
                        array_push($arrayColumn,'title');
                        array_push($arrayValues,$_POST['title']);
                            $arrayAll[$counter][0] = "title";
                            $arrayAll[$counter][1] = "=";
                            $arrayAll[$counter][2] = $data['title'];
                            $counter++;
                }
                if(isset($_POST['bookProducent'])){
                        array_push($arrayColumn,'bookProducent');
                        array_push($arrayValues,$_POST['bookProducent']);
                            $arrayAll[$counter][0] = "bookProducent";
                            $arrayAll[$counter][1] = "=";
                            $arrayAll[$counter][2] = $data['bookProducent'];
                            $counter++;
                }
                if(isset($_POST['numberOfAvailableBooks'])){
                            array_push($arrayColumn,'numberOfAvailableBooks');
                            array_push($arrayValues,$_POST['numberOfAvailableBooks']);
                            $arrayAll[$counter][0] = "numberOfAvailableBooks";
                            $arrayAll[$counter][1] = "=";
                            $arrayAll[$counter][2] = $data['numberOfAvailableBooks'];
                            $counter++;
                }
                if(isset($_POST['description'])){
                        array_push($arrayColumn,'description');
                        array_push($arrayValues,$_POST['description']);
                        $arrayAll[$counter][0] = "description";
                        $arrayAll[$counter][1] = "=";
                        $arrayAll[$counter][2] = $data['description'];
                        $counter++;
                }
              $db->update('books',$arrayColumn,$arrayValues,$arrayAll);
              header('Location:book.php');
            
          }
  ?>
<form action="updateBook.php" method="POST">
        <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 100px">
            <label for="exampleInputimage">Okładka</label>
            <input type="text" class="form-control" name="image" value="<?php echo $data['image']?>" id="exampleInputimage" placeholder="Wpisz Ścieżke do zdj"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputTitle">Tytuł</label>
            <input type="text" class="form-control" name="title" value="<?php echo $data['title']?>" id="exampleInputTitle" placeholder="Wpisz Tytuł"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputbookProducent">Wydawca</label>
            <input type="text" class="form-control" name="bookProducent" value="<?php echo $data['bookProducent']?>" id="exampleInputbookProducent" placeholder="Wpiszwydawce"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
            <label for="exampleInputnumberOfAvailableBooks">Liczba książek</label>
            <input type="text" class="form-control" name="numberOfAvailableBooks" value="<?php echo $data['numberOfAvailableBooks']?>" id="exampleInputnumberOfAvailableBooks" placeholder="Wpisz Liczbe książęk"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
         <label for="exampleInputdescription">Opis</label>
            <input type="text" class="form-control" name="description" id="exampleInputdescription" value="<?php echo $data['description']?>"  placeholder="Wpisz Opis"></div>
            <div style= " width :50% ;
         margin-left: auto;
        margin-right: auto;
        margin-top: 50px">
<button type="submit" name="submit"  class="btn btn-primary ">Zatwierdż zamiany</button>
        </form>
        </div>

</body>
</html>

