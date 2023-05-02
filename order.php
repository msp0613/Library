<?php
include('dbConnection.php');
if(!isset($_SESSION['id'])){
    header('Location: index.php');
  } ?>

<!DOCTYPE html>
<head>
<title><?php echo basename( $_SERVER['SCRIPT_NAME'],".php"); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</body>

<?php
include('navBar.php');
$udata = $db->readOne('books',['image','title','bookProducent','numberOfAvailableBooks','description','price'],[['id','=',$_SESSION['idBook']]]);
$data = json_decode(json_encode ( $udata ) , true);
$my_date = date("Y-m-d H:i:s");
     
    


echo"<div class='column'>";
    echo"<div class=;card; style='margin-left: 350px;'>";
  echo  "<img src='{$data['image']}' style='width: 500px;height: 450px;'>";

    echo"<h1>Tytuł {$data['title']}</h1>";
    echo"<p>Wydawca:{$data['bookProducent']}</p>";
    echo"<p>Liczba dostępnych egzemplarzy {$data['numberOfAvailableBooks']}</p>";
    echo"<p>Opis {$data['description']}</p>";
    echo"<p >Cena {$data['price']}</p>";
     echo"<form action='order.php' method='POST'>";?>
     <input type="number" name="number" class="form-control" placeholder="Wpisz Ilość"></div>
     <button class='btn btn-primary btn-lg' name='howMuch' type='submit' style="margin-block-end: 20px; margin-left: 350px; margin-top: 30px">Zamów</button>
     </form>
   </div>
 </div>
</div>
    </div>
</div>
<?php
$updateNumberOfAvailableBooks = $data['numberOfAvailableBooks'];
if(isset($_POST['number'])&& $_POST['number']>0  ){
   if($updateNumberOfAvailableBooks>=$_POST['number']){
    $updateNumberOfAvailableBooks=$updateNumberOfAvailableBooks - $_POST['number'];
  
  $summaryPrice = $_POST['number'] * $data['price'];
  $db->insert('orders',['date','userId','title','howMany','payment','summaryPrice'],[[$my_date,$_SESSION['id'],$data['title'],$_POST['number'],0,$summaryPrice]]);
  $arrayAll[0][0] = "id";
  $arrayAll[0][1] = "=";
  $arrayAll[0][2] = $_SESSION['idBook']; 

  $db->update('books',['numberOfAvailableBooks'],[$updateNumberOfAvailableBooks],$arrayAll);
  // header("Location: cart.php");
}
else{
  echo ("<div class='row'><div class='alert alert-danger col-md-4 col-md-offset-4' align='center'>Ilość niedostępna</div></div>");
}

}
?>



