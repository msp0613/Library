<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Biblioteka</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <?php
      if(isset($_SESSION['role'])){
       if($_SESSION['role']==0){
      echo "<li><a href='user.php'>Użytkownicy</a></li>";
       echo "<li><a href='book.php'>Książki</a></li>";
       echo "<li><a href='allOrder.php'>Zamówienia</a></li>";
      }
      if(isset($_SESSION['id'])){
        echo "<li><a href='cart.php'>Koszyk</a></li>";
      }
    }
      ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php
        if(isset ($_SESSION['id'])){
          $login =  $db->readOne('user',['login'],[['id','=',$_SESSION['id']]]);
          echo  "<li><a href=userSide.php ><span class='glyphicon glyphicon-user' disabled></span>Witaj {$login->login}</a></li>";
           echo "<li><a href= logout.php  ><span class='glyphicon glyphicon-user'></span>Wyloguj się</a></li>"; 
        }
        else{  
          echo "<li><a href='login.php' ><span class='glyphicon glyphicon-user'></span> Zaloguj się</a></li>";
      echo "<li><a href='register.php' ><span class='glyphicon glyphicon-user'></span> Zarejestruj się</a></li>";
        }
      ?>
    </ul>
  </div>
</nav>