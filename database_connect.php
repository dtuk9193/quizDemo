<?php

    
    $con = mysqli_connect("localhost", "root", "root", "question");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    function getData($table, $query='', $offset=NULL, $limit=NULL, $isIndexing = false) {

        global $con;
        //return ['id'=>1, 'category_id'=> 1, 'question' => "aaaa?", 'answers' => '{"0":"11", "1":"22"}', 'correct_answer' =>1];
        
        $where = strlen($query) > 0 ? ' WHERE ' : ' ';
        $query = 'SELECT * FROM '. $table.  $where . $query;
        if($limit !== NULL) $query .= ' limit '. $limit;
        if($offset !== NULL) $query .= ' offset '. $offset;

        $result = $con->query($query);
       
        $return_data = array();
        while($row = $result->fetch_assoc()){
            if($isIndexing === false) {
                $return_data[] = $row;
            } else {
                $return_data[ $row['id'] ] = $row;
            }
        }

        return $return_data;
    }

    function insertData($table, $field_array=NULL, $data_array=NULL) {
        global $con;

        $sql = 'INSERT INTO '. $table . ' ( ' . $field_array . ' ) VALUES ( '. $data_array . ' )';
        $con->query($sql);
    }

    function deleteData($table, $query) {
        global $con;

        if(strlen($query) === 0) return;
        $sql = 'DELETE FROM '. $table. ' WHERE '. $query;
        $con->query($sql);

    }

?>