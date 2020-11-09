<!DOCTYPE html>
<html lang="en">
<head>
    <title>ADMIN WEB BOOK</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="title-admin">
        <h1 class="text-logo">WEB BOOK ADMIN</h1>
    </div>
    <div class="container admin">
        <div class="row">
            <h2 class="add"><strong>Liste des projets</strong>  <a href="insert.php"class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h2>    
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Lien</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    require 'database.php';/* requiere database.php pour utiliser son contenu */
                    $db = Database::connect();/* accès a la classe Database retourne la connexion vers la DataBase ds la variable db */
                    $statement = $db->query('SELECT items.id, items.title, items.description, items.link, categories.name AS category 
                                            FROM items LEFT JOIN categories ON items.category = categories.id');/* Selection des informations de la base *//* ORDER BY articles.id DESC */
                    while($item = $statement->fetch()) /* affichage des informations */
                    {
                        echo '<tr>';
                        echo '<td>' . $item['title'] . '</td>';
                        echo '<td>' . $item['description'] . '</td>';
                        echo '<td>' . $item['link'] . '</td>';
                        echo '<td>' . $item['category'] . '</td>';
                        echo '<td width=400>';
                        echo '<a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-eye-open"></span>  Voir</a>';
                        echo ' ';
                        echo '<a class="btn btn-primary" href="update.php?id=' .$item['id'] . '"><span class="glyphicon glyphicon-pencil"></span>   Modifier</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="delete.php?id=' .$item['id'] . '"><span class="glyphicon glyphicon-remove"></span>  Supprimer</a>';
                        echo '</td>';
                    echo '</tr>';
                    }
                    Database::disconnect();
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>