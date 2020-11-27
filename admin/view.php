<?php
    require 'database.php';

if(!empty($_GET['id']))/* récupération id */
{
    $id = checkInput($_GET['id']);/* check la variable id */
}   

$db = Database::connect();
$statement = $db->prepare('SELECT items.id, items.title, items.description, items.link, items.image, categories.name AS category 
                            FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');
$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();
    



function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>ADMIN VIEW WEB BOOK</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..assets/css/style.css">
</head>
<body>
    <div class="title-admin">
        <h1 class="text-logo">WEB BOOK-VIEW</h1>
    </div>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="add"><strong>Voir un PROJET</strong></h2>
                <br>
                <form>
                    <div class="form-group">
                        <label>Titre :</label><?php echo '  ' . $item['title']; ?>
                    </div>
                    <div class="form-group">
                        <label>Description :</label><?php echo '  ' . $item['description']; ?>
                    </div>
                    <div class="form-group">
                        <label>Lien</label><?php echo '  ' . $item['link']; ?>
                    </div>
                    <div class="form-group">
                        <label>Catégorie :</label><?php echo '  ' . $item['category']; ?>
                    </div>
                    <div class="form-group">
                        <label>Image :</label><?php echo '  ' . $item['image']; ?>
                    </div>
                </form>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </div>
            <div class="col-sm-6 site">
                <div class="bg-grey white-logo">
                    <img src="<?php echo '../images/' . $item['image'] ; ?>">
                    <!--<div class="text-articles">  
                        <p><?php echo $item['category']; ?></p>                        
                        <p><?php echo $item['title']; ?></p>
                        <p><?php echo $item['name']; ?></p>
                        <p><?php echo $item['description']; ?></p>
                        <p><?php echo $item['link']; ?></p>                     
                    </div>-->
                </div>
            </div>
            
                
            
        </div>
    </div>
</body>
</html>