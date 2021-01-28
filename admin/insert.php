<?php

    require 'database.php';

    $titleError = $descriptionError = $linkError = $categoryError = $imageError = $title = $description = $link = $category = $image = "";

    if(!empty($_POST))
    {
        $title                  = checkInput($_POST['title']);
        $description            = checkInput($_POST['description']);
        $link                   = checkInput($_POST['link']);
        $category               = checkInput($_POST['category']);
        $image                  = checkInput($_FILES['image']['name']);
        $imagePath              = '../images/' . basename($image);
        $imageExtension         = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess              = true;
        $isUploadSuccess        = false;

        if(empty($title))
        {
            $titleError = 'Ce champ doit être remplie';
            $isSuccess = false;
        }

        if(empty($description))
        {
            $descriptionError = 'Ce champ doit être remplie';
            $isSuccess = false;
        }

        if(empty($link))
        {
            $linkError = 'Ce champ doit être remplie';
            $isSuccess = false;
        }
        if(empty($category))
        {
            $categoryError = 'Ce champ doit être remplie';
            $isSuccess = false;
        }

        if(empty($image))
        {
            $imageError = 'Ce champ doit être remplie';
            $isSuccess = false;
        }
        else
        {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
            {
                $imageError = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath))
            {
                $imageError = "Le fichier existe déja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000)
            {
                $imageError = "Le fichier ne doit pas dépasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess)
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }

        if($isSuccess && $isUploadSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items (title,description,link,category,image) values(?, ?, ?, ?, ?)");
            $statement->execute(array($title,$description,$link,$category,$image));
            Database::disconnect();
            header("Location: index.php");

        }

       

    }

    function checkInput($data)
    {
        $data = trim($data); // supprime les espaces les retour a la ligne
        $data = stripslashes($data); //supprime les antislash
        $data = htmlspecialchars($data); // previent de la faille XSS (INJECTION DE SCRIPT DS L'URL)
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>ADMIN INSERT WEB BOOK</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="title-admin">
        <h1 class="text-logo" style="text-align:center">WEB BOOK-INSERT</h1>
    </div>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="add"><strong>Ajouter un projet</strong></h2>
                <br>
                <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Titre :</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="<?php echo $title; ?>">
                        <span class="help-inline"><?php echo $titleError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Description" style="height:200px" value="<?php echo $description; ?>"></textarea>
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="link">Lien</label>
                        <input type="text" class="form-control" id="link" name="link" placeholder="Lien" value="<?php echo $link; ?>">
                        <span class="help-inline"><?php echo $linkError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégories:</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                                $db = Database::connect();
                                foreach($db->query('SELECT * FROM categories') as $row)
                                {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                                Database::disconnect();
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                    <div class="form-group">
                    <label for="image">Sélectionner une image:</label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php echo $imageError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>  Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>