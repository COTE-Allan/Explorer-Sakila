<?php

// Appel de la DB Sakila
function call_to_db()
{
    try {
        $options = [
            // Permet à PDO de lever des exceptions en cas d'erreur SQL
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        // data source name
        $dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8";
        // instance de la base de données (pdo)
        $dbh = new PDO($dsn, USER, PWD, $options);
        // echo 'connecté !';
        return $dbh;
    } catch (PDOException $ex) {
        // message d'erreur
        printf("La connexion à la base de donnée à échouer avec le code %s", $ex->getCode());
        // arrêter l'exécution du script
        die();
    }
}

// Les magasins
function get_the_shops()
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
    SELECT DISTINCT `address`, `name`, `city` FROM `store`
    NATURAL JOIN `staff_list`
    WHERE `manager_staff_id` = `ID`
EOD;
    // Exécuter la requête
    $shopsStmt = $the_db->query($sql);
    // Récuperer les données :
    $shops = $shopsStmt->fetchAll();
    return $shops;
}

// Nb films par catégorie
function get_the_films_by_category()
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
    SELECT `category`, COUNT(*) 
    FROM film_list 
    GROUP BY `category`;
EOD;
    // Exécuter la requête
    $categoryStmt = $the_db->query($sql);
    // Récuperer les données :
    $f_b_category = $categoryStmt->fetchAll();
    return $f_b_category;
}

// Fonction liste des films avec pagination.
function get_the_films($from, $to)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT `title`, `description`, `category`,  `film_id` 
        FROM film 
        NATURAL JOIN film_list 
        WHERE `film_id` BETWEEN :from AND :to;
EOD;
    // Exécuter la requête
    $filmsStmt = $the_db->prepare($sql);
    $filmsStmt->bindValue(':from', $from);
    $filmsStmt->bindValue(':to', $to);
    $filmsStmt->execute();
    // Récuperer les données :
    $films = $filmsStmt->fetchAll();
    return $films;
}

// Fonction liste des acteurs avec pagination.
function get_the_actor($from, $to)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT `actor_id`, `first_name`, `last_name`
        FROM actor
        WHERE `actor_id` BETWEEN :from AND :to;
EOD;
    // Exécuter la requête
    $actorStmt = $the_db->prepare($sql);
    $actorStmt->bindValue(':from', $from);
    $actorStmt->bindValue(':to', $to);
    $actorStmt->execute();
    // Récuperer les données :
    $films = $actorStmt->fetchAll();
    return $films;
}


// Fonction liste des films d'un acteur ciblé
function get_the_film_actor($the_actor_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT `title` 
        FROM film_actor 
        INNER JOIN film WHERE `actor_id` 
        LIKE :actor_id AND film_actor.`film_id` = film.`film_id`;
EOD;
    // Exécuter la requête
    $film_actorStmt = $the_db->prepare($sql);
    $film_actorStmt->bindValue(':actor_id', $the_actor_id);
    $film_actorStmt->execute();
    // Récuperer les données :
    $films = $film_actorStmt->fetchAll();
    return $films;
}
// Fonction liste des films d'un acteur ciblé
function get_the_actor_name($the_actor_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT `last_name`, `first_name`
        FROM actor
        WHERE `actor_id` LIKE :actor_id;
EOD;
    // Exécuter la requête
    $name_actorStmt = $the_db->prepare($sql);
    $name_actorStmt->bindValue(':actor_id', $the_actor_id);
    $name_actorStmt->execute();
    // Récuperer les données :
    $films = $name_actorStmt->fetchAll();
    return $films;
}

// Fonction liste ventes et stocks d'un magasin
function get_the_shop_details()
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT `store`, `total_sales`
        FROM sales_by_store; 
EOD;
    // Exécuter la requête
    $shop_detailStmt = $the_db->query($sql);
    // Récuperer les données :
    $shop_detail = $shop_detailStmt->fetchAll();
    return $shop_detail;
}
function get_the_inventory()
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT count(case when store_id=1 THEN 1 else null end) AS store1, count(case when store_id=2 THEN 1 else null end) AS store2 FROM inventory;
EOD;
    // Exécuter la requête
    $inventoryStmt = $the_db->query($sql);
    // Récuperer les données :
    $inventory = $inventoryStmt->fetchAll();
    return $inventory;
}
