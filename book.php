<?php
  include('dbConnection.php');
var_dump($_SESSION['id']);

if(!isset($_SESSION['id'])||$_SESSION['role']!=0){
              header('Location: index.php');
            }
            $data =$db->readAll('books');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>index.php</title>
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

        <div style="margin-left: 585px">
    <a class="btn btn-primary" href="insertBook.php">Dodaj Książke</a>  
        </div>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Okładka

</th>
      <th class="th-sm">Id

      </th>
      <th class="th-sm">Tytuł

      </th>
      <th class="th-sm">Wydawca

      </th>
      <th class="th-sm">Ilość

      </th>
      <th class="th-sm">Opis
      </th>
      </th>
      <th class="th-sm">Cena
      </th>
    </tr>
  </thead>
  <?php
  foreach($data as $row){
  echo "<tbody>";
  echo  "<tr>";
  echo "<td>{$row->image}</td>";
   echo   "<td>{$row->id}</td>";
     echo "<td>{$row->title}</td>";
     echo "<td>{$row->bookProducent}</td>";
     echo "<td>{$row->numberOfAvailableBooks}</td>";
     echo "<td>{$row->description}</td>";
     echo "<td>{$row->price}</td>";
     echo "<form action='book.php' method='POST' name= 'updateUser'>";
    echo "<input type='hidden' name='id' value={$row->id} />";
    echo "<td><input type='submit' class='btn btn-primary' name='btn1U' value='Zaktualizuj' />";
    echo "<input type='submit' class='btn btn-primary'  name='btn2U' value='Usuń' /></td>";
    if(isset($_POST['btn1U'])) {
        header("Location: updateBook.php");
        $_SESSION['idBook'] = $_POST['id'];
      }
    if(isset($_POST['btn2U'])) {
        $db->delete('books',['id'],[$_POST['id'] ]);
        header("Refresh:2");
      }
    echo "</form>";
  echo " </tr>";
 echo "</tbody>";
  }
  ?>
  <tfoot>
    <tr>
    <th>Okładka
      </th>
      <th>Id
      </th>
      <th>Tytuł
      </th>
      <th>Wydawca
      </th>
      <th>Ilość
      </th>
      <th>Opis
      </th>
      <th>Cena
      </th>
    </tr>
  </tfoot>
</table>
</body>
</html>