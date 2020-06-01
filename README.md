# SQLITE MICRO BLOG PRECISIONS

## PREREQUIS

* extension=php_pdo_sqlite.dll
* extension=php_pdo.dll


### BIND VALUE
```
    PDO::PARAM_NULL : 	la valeur est NULL
    PDO::PARAM_BOOL : 	la valeur est un booléen (true ou false)
    PDO::PARAM_INT : 	la valeur est un entier
    PDO::PARAM_STR : 	la valeur est une chaîne de caractères
	[...]
    
	-> DEFAUT -> PDO::PARAM_STR

    $st->bindValue('count', 5, PDO::PARAM_INT);
    $st->execute([':count'=>5]); // ATTENTION ->  traiter comme une chaîne par defaut !!! si on a un limite ou > la requête ne fonctionnera pas !!!
    $st->execute([ ':title' => $title, ':content' => $content, ':author' => $author, ':date_rec' => $date,]);
```
### PDO + SQLITE

```
    // "connection" -> création du fichier qui va contenir tables
    $pdo = new PDO ( 'sqlite:mybase.sqlite3');
    // Set fetch mode
    $pdo->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
    // Set error mode
    $pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
```

```
    try {
            $pdo = new PDO ( 'sqlite:mybase.sqlite3');
            $pdo->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
            $pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
        } catch ( Exception $e ) {
            echo "No access to database / Info : possible cause bad path to database file : " . $e->getMessage( );
        }
```

### Alternative foreach dans du html
```
    <?php foreach ($articles as $article) : ?>
        <li>
            <a href="article.php?id=<?= $article['id'] ?>"><?= htmlentities($article['title']) . ' - By ' . $article['author'] ?></a>
        </li>
    <?php endforeach; ?>
```