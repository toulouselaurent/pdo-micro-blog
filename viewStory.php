<?php

    try{
        $query = "SELECT * FROM story";
        $stm = $pdo->query($query);
        $articles = $stm->fetchall(PDO::FETCH_ASSOC);
    }  catch( Exception $e) {
        $error .= "No stories found !  <br> " .  PHP_EOL; 
        $debug .= $e->getMessage() . "<br> " .  PHP_EOL; 
    }
