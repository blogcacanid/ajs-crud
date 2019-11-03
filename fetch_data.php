<?php
    include('database_connection.php');
    $query = "SELECT * FROM pegawai ORDER BY nip";
    $statement = $connect->prepare($query);
    if($statement->execute()){
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        echo json_encode($data);
    }
?>