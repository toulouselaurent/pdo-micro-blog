<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <title>My Little Blog With PDO</title>
    <style>
        .error{
            padding:20px;
            border-radius:4px;
            border:1px solid red;
            background:tomato;
        }
    </style>
</head>
<body>
    <?php
        //Afficher les erreurs captées par try et catch
        //echo $debug; // only in dev mode for dev
        if($error != ''){
            echo "<div class=\"error\">" . $error . "</div>"; // for user
        } 
    ?>
<div class="container">
    <div class="row mt-40">
        <div class="col"></div>
            <div class="col-5">
                <h1 class="center"><strong>FORMULAIRE</strong> </h1>
                <form action="index.php"  method="post">
                    <div class="form-group ">
                        <label for="title">Titre :</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author :</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Message :</label>
                        <textarea  id="content" class="form-control" name="content" required></textarea>
                    </div>
                    <div class="form-group center mt-25 ">
                        <button type="submit" class="btn btn-primary w50" id="submit" name="add">Submit</button>
                    </div>
                </form>
            </div>
        <div class="col"></div>
    </div>    
</div>

    <?php
        //  affichage des articles (voir viewArticle.php)
        $date_format = 
        echo 
        '<table class="table mt-40">
            <thead>
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Author</th>
                <th scope="col">Message</th>
                <th scope="col">Date</th>
                <th scope="col">Delete</th>
                <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>';
        foreach( $articles as $article)
        {
            echo '<tr>
            <th scope="row">' . $article['title'] . "</th>
            <td>". $article['content'] . "</td>
            <td>". $article['author'] . "</td>
            <td>". date_format($article['date_rec',"d/m/Y"]); . '</td> 
            <td><a href="index.php?delete&amp;id=' . $article['id'] . '">Delete</a></td> 
            <td><a href="index.php?update&amp;id='. $article['id'] . '">Update</a></td>';
            "</tr>
            </tbody>" . PHP_EOL;
        }
        echo "</table>";
