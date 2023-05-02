<?php
          include('dbConnection.php');

            if(!isset($_SESSION['id'])||$_SESSION['role']!=0){
                header('Location: index.php');
              }   
            $data =$db->readAll('user');

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
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Id

      </th>
      <th class="th-sm">Login

      </th>
      <th class="th-sm">Hasło

      </th>
      <th class="th-sm">Imie Nazwisko

      </th>
      <th class="th-sm">Adres
      </th>
    </tr>
  </thead>
  <?php
  foreach($data as $row){
  echo "<tbody>";
  echo  "<tr>";
   echo   "<td>{$row->id}</td>";
     echo "<td>{$row->login}</td>";
     echo "<td>{$row->nameAndSurname}</td>";
     echo "<td>{$row->address}</td>";
     echo "<form action='user.php' method='POST' name= 'updateUser'>";
    echo "<input type='hidden' name='id' value={$row->id} />";
    echo " <td><button class='btn btn-primary btn-lg' name='btn1U' type='submit'>Zaktualizuj</button>";
    echo " <button class='btn btn-primary btn-lg' name='btn2U' type='submit'>Usuń</button></td>";
    if(isset($_POST['btn1U'])) {
        header("Location: updateUser.php");
        $_SESSION['id'] = $_POST['id'];
      }
    if(isset($_POST['btn2U'])) {
        $db->delete('user',['id'],[$_POST['id'] ]);
        echo("<h1> Rekord Usunięty </h1>");
        header("Refresh:2");
      }
    echo "</form>";
  echo " </tr>";
 echo "</tbody>";
  }
  ?>
  <tfoot>
    <tr>
      <th>Id
      </th>
      <th>Login
      </th>
      <th>Hasło
      </th>
      <th>Imie Nazwisko
      </th>
      <th>Adres
      </th>
    </tr>
  </tfoot>
</table>
</body>
</html>