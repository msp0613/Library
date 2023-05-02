<?php
include('dbConnection.php');
if( isset($_POST['btn1U'])&& isset($_SESSION['id'])) {
  $_SESSION['idBook'] = $_POST['id'];
  header("Location: order.php");
}
if(!isset($_SESSION['id'])&& isset($_POST['btn1U'])){
  echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Musisz być zalogowany</div></div>");
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

<?php
require_once("db.php");   
$data =$db->readAll('books');
echo "<div class='row'>";

 foreach($data as $row){



  echo"<div class='column'>";
    echo"<div class='card'>";
    echo "<img src={$row->image}  style=' width='200px'; height='300px'>";
echo  "<h1>Tytuł: {$row->title}</h1>";
echo  "<p>Wydawca: {$row->bookProducent}</p>";
if($row->numberOfAvailableBooks>0){
  echo "<p> Dostępne </p>";
}
else{
  echo "<p> Niedostępne </p>";

}
 echo "<p>   {$row->description}</p>";
 echo "<form action='index.php' method='POST' name= 'updateUser'>";
 echo "<input type='hidden' name='id' value={$row->id } />";
echo "<button class='btn btn-primary btn-lg' name='btn1U' type='submit'>Wybierz</button>";
  echo("</form>");
   echo"</div>";
 echo "</div>";
 }
    echo "</div>";
?>

</body>
</html>
<style>

body {
  font-family: Arial, Helvetica, sans-serif;
}

.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

.row {margin: 0 -5px;}


.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); 
  padding: 16px;
  height: 700px;
  width: 300px;
  text-align: center;
  float: left;
  background-color: #f1f1f1;
}

</style>