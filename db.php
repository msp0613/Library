<?php
class UniversalResolution{
    protected $conn;

    public function __construct ($dbhost, $dbname, $dbuser, $dbpassword){
        try{
            $this->conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $this->conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME utf8");
        }
        catch(PDOException $e){
            var_dump('Connection to DB failed');
        }    
    }

    public function readAll($table, $columns = [], $where = []){
        $sql = "SELECT ";
        if(count($columns) > 0){
            $sql .= implode(', ', $columns);
        }
        else{
            $sql .= "*";
        }

        $sql .= " FROM $table";

        if(count($where) > 0){
            $sql .= " WHERE ";
            for($i = 0; $i < count($where); $i++){
                if($i > 0){
                    $sql .= "AND ";
                }                
                $sql .= "{$where[$i][0]} {$where[$i][1]} ?";
        
                $sql .= " ";
            }
        }
        $stmt = $this->conn->prepare($sql);
        $array = [];
        if(count($where) > 0){
            for($i = 0; $i < count($where); $i++){
                array_push($array, $where[$i][2]);
            }
        }
        $stmt->execute($array);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function readOne($table, $howColumn = [], $where = []){
        $data = $this->readAll($table, $howColumn, $where);

        if(count($data)){
            return $data[0];
        }
        return null;

    }
        
    public function insert($table, $columns = [], $values= []){
        $sql = "INSERT INTO ".$table.' (';
        $columnsString = implode(', ', $columns);
        $sql .= $columnsString;

        $sql .= ") VALUES ";
    
        for($i = 0;$i < count($values); $i++){
            $sql .= "(";
            
            for($j = 0; $j < count($columns); $j++){
                if($j + 1 === count($columns)){
                    
                    $sql .= "?)";
                }
                else{
                    
                    $sql .= "?,";
                }
            }
            if($i + 1 < count($values)){
                $sql .= ",";
            }
        }
        $stmt = $this->conn->prepare($sql);
        $array = [];
        $counter=0;
        foreach($values[0] as $val){
            $counter++;
        }
        for($i = 0; $i < $counter; $i++){
            
            array_push($array, $values[0][$i]);
            
        }
      var_dump(  $stmt->execute($array));

    
        // $stmt->execute($values);
    }
//     $sql = "UPDATE cars SET engine = 10 WHERE engine > ?";
// // $stmt = $conn->prepare($sql);
// // $stmt->execute([10]);
    public function update ($table, $column = [], $values = [] ,$where = []){
        $sql = "UPDATE ".$table." SET ";
        $counter = 0;
        foreach ($column as $col){
            if($counter < count($column)-1){
                $sql.= $col." = ? , ";
                $counter++;
            }
            else{
                $sql.= $col." = ? ";
                $counter++;
            }
        }
            if(count($where ) > 0){
                $sql .= "WHERE ";
                for($i = 0; $i < count($where); $i++){
                    if($i > 0){
                        $sql .= " AND ";
                    }
                    $sql .= "{$where[$i][0]} {$where[$i][1]} ?" ;
                }
            }
            $stmt = $this->conn->prepare($sql);
            $array = [];
            if(count($values) > 0){
                for($i = 0; $i < count($values); $i++){
                    array_push( $array,$values[$i]);
                }
            }
            if(count($where) > 0){
                for($i = 0; $i < count($where); $i++){
                    array_push($array,$where[$i][2]);
                    var_dump($where[$i][2]);
                }
            }
            echo($sql);
            $stmt->execute($array);

    }
    //$sql = "DELETE FROM cars WHERE id > ?";
// $stmt = $conn->prepare($sql);
// $stmt->execute([10]);
    public function delete ($table, $columns = [], $values= []){
        if(count($columns) == 0){
            $sql ="DELETE FROM ".$table;
        }
        else{
        $sql = "DELETE FROM ".$table;
        $sql .= " WHERE ";
        $counter = 0;
        foreach ($columns as $col){
            if($counter<count($columns)-1){
            $sql.= $col." = ? AND ";
            $counter++;
            }
            else{
                $sql.= $col." = ? " ;
            }
        }
        $array = [];
        $stmt = $this->conn->prepare($sql);
        foreach ($values as $val){
            array_push($array, $val);
        }
        echo($sql);
       
        $stmt->execute($array);
    }
    }
    
}
//   $db = new UniversalResolution('localhost', 'biblioteka', 'root', '');
//    $login =  $db->readOne('user',['login'],[['id','=',27]]);
//    var_dump($login->login);

//   $db->delete('orders',['title'],['Folwark Zwierzęcy']);
//   $arrayAll[0][0] = "title";     $arrayAll[0][1] = "=";
//     $arrayAll[0][2] = 'Folwark Zwierzęcy'; 
//   $db->update('books',['numberOfAvailableBooks'],[[20]],$arrayAll);

//  $updateNumberOfAvailableBooks = $db->readOne('books',['numberOfAvailableBooks'],[['title','=','Folwark Zwierzęcy' ]]);
//  $updateNumberOfAvailableBooks = json_decode(json_encode ( $updateNumberOfAvailableBooks ) , true);
//     $updateNumberOfAvailableBooks['numberOfAvailableBooks']-=10;
//     $arrayAll[0][0] = "title";
//     $arrayAll[0][1] = "=";
//     $arrayAll[0][2] = 'Folwark Zwierzęcy'; 
//    var_dump( $db->update('books',['numberOfAvailableBooks'],[$updateNumberOfAvailableBooks['numberOfAvailableBooks']],$arrayAll));
 //var_dump ($db->readOne('books',['image','title','bookProducent','numberOfAvailableBooks','description'],[['title','=','Folwark Zwierzęcy']]));
 //  var_dump($db->readAll('cars', ['name', 'engine'], [['engine', '>', 1], ['id', '<', 100]]));
// var_dump($db->readOne('cars',['name', 'engine']));
 // $db->insert('cars',['name', 'engine'],[['m3','bmw']]);
//$db->update('cars', ['name', 'engine'],['opel',23] ,[['engine', '=', 10]]);
//$db->delete('cars',['name', 'engine'], ['opel',23]);
//$db->insert('bookreader',['role','login','password','nameAndSurname','address'],[[1,'jas','fasola','na','jasl']]);
