<?php
abstract class Model {
    protected static string $table;
    protected static string $primaryKey = 'id';

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("SELECT * FROM %s WHERE %s =?",static::$table,static::$primaryKey);
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $data =$stmt->get_result()->fetch_assoc();
        return $data  ? new static($data):null;
    }
     public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s", static::$table);
        
        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row);
           }

        return $objects; 

    }

       public function delete(mysqli $mysqli){
        $sql = sprintf("DELETE FROM %s WHERE %s = ?", static::$table, static::$primaryKey);
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $this->{static::$primaryKey});
        return $stmt->execute();
    }

    public function update(mysqli $mysqli,array $feilds){
        $set=[];
        $types = '';
        $values = [];
        foreach($feilds as $key => $value){
            $set[] = "$key=?";
            $types .= is_int($value) ? 'i' : 's';
            $values[] = $value;
        }
        $types .= 'i';
        $values[] = $this->{static::$primaryKey};
        $sql = sprintf("UPDATE %s SET %s WHERE %s = ?", static::$table, implode(', ', $set), static::$primaryKey
    );
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();

    }
     public function create(mysqli $mysqli,array $feilds){

    $columns = implode(', ', array_keys($feilds)); 
    $placeholders = implode(', ', array_fill(0, count($feilds), '?')); 
    $types = '';
    foreach ($feilds as $value) {
        $types .= is_int($value) ? 'i' : 's';
    }
    $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", static::$table, $columns, $placeholders);
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...array_values($feilds));
    if ($stmt->execute()) {
        $flds[static::$primaryKey] = $mysqli->insert_id;
        return new static($feilds);
    }
    return null;
    }





}