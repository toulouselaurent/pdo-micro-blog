<?php

    if( isset( $_GET['delete'] ) 
        && isset($_GET['id'])
    )
    {
        $id = $_GET['id'];
        try{ 
            $query_delete = "DELETE FROM story WHERE id=:id";
            $stm = $pdo->prepare($query_delete);
            $stm -> bindValue(':id', $id, PDO::PARAM_INT);
            $stm -> execute();

        } catch ( Exception $e ) {
            $error .= "Cannot delete data ! <br> " .  PHP_EOL; 
            $debug .= $e->getMessage() . "<br> " .  PHP_EOL;  
        }
    }