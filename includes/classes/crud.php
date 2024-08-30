<?php
class Crud
{
    // get data function
    public function getData($connection , $columns , $table_name , $condition = "" ,$values ="" , $fetchType ="" , $order = ""){
        $getAllData = $connection -> prepare("SELECT $columns FROM $table_name $condition $order");
        $getAllData->execute($values);
        if ($getAllData->rowCount() > 0){
            $user_data = $getAllData -> $fetchType();
            return $user_data;
        }
        else {
            return False;
        }
    }
    // insert data function
    public function insertData($connection , $table_name , $columnNames , $values){
        $columns = implode(', ', $columnNames);
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $insertData = $connection -> prepare("INSERT INTO $table_name($columns) VALUES($placeholders)");
        $insertData->execute($values);
        if ($insertData -> rowCount() > 0){
            return TRUE;
        }
        else {
            return False;
        }
    }
    // update data function
    public function updateData($connection , $table_name , $data ,  $condition , $condition_value){
        $setParts = [];
        $values = [];
        foreach ($data as $column => $value) {
            $setParts[] = "$column = ?";
            $values[] = $value;
        }
        $setString = implode(", ", $setParts);
        $query = "UPDATE $table_name SET $setString WHERE $condition";
        if (!is_array($condition_value)) {
            $condition_values = [$condition_value];
        }
        $values = array_merge($values, $condition_values);
        $updateData = $connection->prepare($query);
        if ($updateData->execute($values)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    // delete data function
    public function deleteData($connection , $table_name , $condition , $value){
        $deleteData = $connection -> prepare("DELETE FROM $table_name WHERE $condition");
        $deleteData -> execute(array($value));
        if ($deleteData -> rowCount() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    // get last inserted id
    public function getLastInsertId($connection){
        return $connection -> lastInsertId();
    }
}