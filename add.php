<?php


    if( isset( $_POST['add'] ) ) {
        
        try{  
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author = $_POST['author'];
            $date_rec = time(); //date('d.m.Y h')
            $queryInsert = "INSERT INTO story (title, content, author, date_rec) VALUES (:title, :content, :author, :date_rec)";

            $stm = $pdo->prepare( $queryInsert );

            $stm->bindValue(':title', $title, PDO::PARAM_STR );
            $stm->bindValue(':content', $content, PDO::PARAM_STR );
            $stm->bindValue(':author', $author, PDO::PARAM_STR );
            $stm->bindValue(':date_rec', $date_rec, PDO::PARAM_INT );

            $stm->execute( );
        } catch ( Exception $e ) {  
            $error .= "Cannot insert data ! <br> " .  PHP_EOL; 
            $debug .= $e->getMessage( ) . "<br> " .  PHP_EOL; 
        }
    }