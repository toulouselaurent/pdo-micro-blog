    <?php
/*
    Atelier Base de données
    PDO
    
    connection a sqlite avec pdo
    créer une table story avec sqlite
    (try et catch pour "capter les erreurs") voir la doc 
    insérer des articles (préparer un formulaire et utiliser pdo pour insérer de nouveaux articles )
    afficher des articles
    supprimer des articles

    A faire :
    --------------
    créer un formulaire pour updater les articles
    si je reçois un get avec update et un id
    alors je pré-rempli le formulaire d'update avec les données de l'article concerné récupérée en BD
    si l'utilisateur soumet le formulaire d'update, je met à jour (UPDATE) mes données dans la base de donnée.
    Faire un petit habillage avec bootstrap.

*/

    $debug = $error = "";

    /* 
        Pdo "connect" -> pas utile avec Sqlite -> juste besoin d'indiquer le nom du fichier qui doit accueillir notre base de donnée et son emplacement;
        Try { do something ...} catch (Exception $e) { si le bloc try génére une erreur ou une exception alors on stop et on passe au bloc catch 
        on retourne les exceptions "attarapées" et éventuellement une erreur pour nos utilisateurs }
    */
    try{
        $pdo = new PDO('sqlite:blog.sqlite3'); // nom et emplacement du fichier base de donnée en paramètre
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // SET Fetch mode (Assoc, both ...)
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set Error mode ici retourne les exceptions)
    } catch ( Exception $e ) { // class auto instanciée pas besoin de faire new Exception ... 
        echo "No access to database /  Info : possible cause bad path to database file !<br> " .  PHP_EOL . $e->getMessage();
        die(); // litterallement tuer le script -> accepte une chaine de caractère en paramètre exple die("Ce script ne fonctionne pas !");
    }

    // Création de la table
    $query = "CREATE TABLE IF NOT EXISTS story (
        id INTEGER PRIMARY KEY AUTOINCREMENT, 
        title TEXT NOT NULL UNIQUE,
        content TEXT,
        author TEXT,
        date_rec INT)";

    try{
        $st = $pdo->prepare($query);
        $st->execute();
    } catch ( Exception $e ) {
        echo "Database not created !<br> "  . $e->getMessage() . "<br> " .  PHP_EOL; 
        die();
    }

    require ('add.php');
    require ('delete.php');
    require ('viewStory.php');

    /*
        id > lien -> selectToUpdate.php -> selectionner la ligne qui correspond à l'id -> insertion des données dans un formulaire d'update 
        -> l'utilisateur envoi le formulaire -> update.php -> requete pour update
    */
?>

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
            <td>". $article['date_rec'] . '</td> 
            <td><a href="index.php?delete&amp;id=' . $article['id'] . '">Delete</a></td> 
            <td><a href="index.php?update&amp;id='. $article['id'] . '">Update</a></td>';
            "</tr>
            </tbody>" . PHP_EOL;
        }
        echo "</table>";

    