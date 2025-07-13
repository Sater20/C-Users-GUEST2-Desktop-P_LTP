<?php
    if(!empty($_GET ["id_productos"])){
        $id_productos = $_GET ["id_productos"];
        $sql = $conn->query(query:"delete from productos where id_productos=$id_productos");

    }
?>