<?php
include('dbConnection.php');

if(!isset($_SESSION['id'])){
    header('Location: index.php');

  } ?>

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

 $data =$db->readAll('orders',['id','date','title','howMany','payment','summaryPrice'],[['userId','=',$_SESSION['id'],['payment','=',0]]]);
?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
<tr>
<th class="th-sm">Data

</th>
  <th class="th-sm">Tytuł

  </th>
  <th class="th-sm">Ilość

  </th>
  <th class="th-sm">Cena

  </th>
  <th class="th-sm">

</th>
</thead> 
<?php
$allSummaryPrice = 0;
foreach($data as $row){
  echo "<tbody>";
  echo  "<tr>";
  echo "<td>{$row->date}</td>";
  echo "<td>{$row->title}</td>";
  echo "<td>{$row->howMany}</td>";
  echo "<td>{$row->summaryPrice}</td>";
  echo "<form action='cart.php' method='POST'>";
  echo "<input type='hidden' name='id' value={$row->id} />";
  echo " <td><button class='btn btn-primary btn-lg' name='deleteOrder' type='submit'>Usuń</button></td>";
    if(isset($_POST['deleteOrder'])){
         $db->delete('orders',['id'],[$_POST['id']]);
         header("Location: cart.php");
      }
    echo "</form>";
  echo " </tr>";
 echo "</tbody>";
 $allSummaryPrice+=$row->summaryPrice;
  }
   
  ?>
  <tfoot>
    <tr>
      <th>
      </th>
      <th>
      </th>
      <th>
      </th>
      <th>Łączna cen
      </th>
      <th><?php echo($allSummaryPrice) ?>
      </th>
    </tr>
  </tfoot>
</table>
<form method="POST" name="pay">
<div style= " width :50% ;
         margin-left: 550px;
        margin-right: auto;
        margin-top: 50px">
<button class='btn btn-primary btn-lg' name='pay' type='submit'>Zapłać</button>
<?php
  if(isset($_POST['pay'])){
    $arrayAll[0][0] = "login";
    $arrayAll[0][1] = "=";
    $arrayAll[0][2] = $_SESSION['login']; 
  
    $db->update('orders',['payment'],[1],$arrayAll);
    header("Location: cart.php");
  }
?>
</div>
</form>
</body>
</html>