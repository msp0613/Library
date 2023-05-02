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


 $data = $db->readAll('orders');
 ?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
<tr>
<th class="th-sm">Login
</th>
  <th class="th-sm">Data
</th>
  <th class="th-sm">Tytuł

  </th>
  <th class="th-sm">Ilość

  </th>
  <th class="th-sm">Cena
  </th>
  <th class="th-sm">Opłacone

  </th>
  <th class="th-sm">

</th>
</thead>
<?php
$allSummaryPrice = 0;
foreach($data as $row){
  echo "<tbody>";
  echo  "<tr>";
    $login =  $db->readOne('user',['login'],[['id','=',$row->userId]]);
    echo "<td> {$login->login}</td>";
  echo "<td>{$row->date}</td>";
  echo "<td>{$row->title}</td>";
  echo "<td>{$row->howMany}</td>";
  echo "<td>{$row->summaryPrice}</td>";
  echo "<td>";
    if($row->payment == 0){
        echo("Nieopłacone");
    }
    else{
        echo("Opłacone");
    }

  "</td>";
  echo "<form action='allOrder.php' method='POST'>";
  echo "<input type='hidden' name='id' value={$row->id} />";
  echo " <td><button class='btn btn-primary btn-lg' name='deleteOrder' type='submit'>Usuń</button></td>";
    if(isset($_POST['deleteOrder'])){
        $orderData = $db->readOne('orders',['title','howMany'],[['id','=',$_POST['id']]]);
         $orderData = json_decode(json_encode ( $orderData ) , true);
         $dataBook = $db->readOne('books',['id','numberOfAvailableBooks'],[['title','=',$orderData['title']]]);  
         $dataBook = json_decode(json_encode ( $dataBook ) , true);   
        $arrayColumn = [];
        $arrayAll = [];
        $arrayValues = [];
         array_push($arrayColumn,'numberOfAvailableBooks');
         array_push($arrayValues,$dataBook['numberOfAvailableBooks']+$orderData['howMany']);
         $arrayAll[0][0] = "id";
         $arrayAll[0][1] = "=";
         $arrayAll[0][2] = $dataBook['id'];
    $db->update('books',$arrayColumn,$arrayValues,$arrayAll);
    $db->delete('orders',['id'],[$_POST['id']]);
         header("Location: allOrder.php");
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
</body>
</html>