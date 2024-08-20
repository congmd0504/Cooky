<?php 
    include_once ("pdo.php");

    function loadall_size(){
        $sql = "SELECT * FROM size";
      return pdo_query($sql);
    }
?>