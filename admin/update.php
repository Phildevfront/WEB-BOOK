<?php

    require 'database.php';

    if(!empty($_GET['id'])) /* envoie id à récupérer ds la variable id */
    {
        $id = checkInput($_GET['id']); /* nettoyage id avc checkInput*/
    }

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
            $isImageUpdated = false;
        }
        else
        {
            $isImageUpdated = true;
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
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) /* prend l'image pour la passer a la variable $imagePath  */
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }

        if(($isSuccess && $isImageUpdated && isUploadSuccess) || ($isSuccess && !$isImageUpdated))
        {
            $db = Database::connect();
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE items set title = ?, description = ?, link = ?, category = ?, image = ? WHERE id= ?");
                $statement->execute(array($title,$description,$link,$category,$image,$id));
            }
            else
            {
                $statement = $db->prepare("UPDATE items set title = ?, description = ?, link = ?, category = ? WHERE id= ?");
                $statement->execute(array($title,$description,$link,$category,$id));

            }
            
            Database::disconnect();
            header("Location: index.php");// CHANGER LE NOM-----------------------------------------------------------------------------
        }
        else if($isImageUpdated && !$isUploadSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT image FROM items WHERE id = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image = $item['image'];
            Database::disconnect();
        }

       

    }
    else
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM items WHERE id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $title                  = $item['title'];
        $description            = $item['description'];
        $link                   = $item['link'];
        $category               = $item['category'];
        $image                  = $item['image'];
        Database::disconnect();

    }

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
    <title>ADMIN UPDATE WEB BOOK</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="title-admin">
        <h1 class="text-logo">WEB BOOK-UPDATE</h1>
    </div>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="add"><strong>Modifier un projet</strong></h2>
                <br>
                <form class="form" role="form" action="<?php echo 'update.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Titre :</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="<?php echo $title; ?>">
                        <span class="help-inline"><?php echo $titleError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="link">Lien</label>
                        <input type="text"  class="form-control" id="link" name="link" placeholder="Lien" value="<?php echo $link; ?>">  
                        <span class="help-inline"><?php echo $linkError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégories:</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                                $db = Database::connect();
                                foreach($db->query('SELECT *  FROM categories') as $row)
                                {
                                    if($row['id'] == $category)
                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                else
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                                Database::disconnect();
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <p><?php echo $image; ?></p>
                        <label for="image">Sélectionner une image:</label>
                        <input type="file" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>  Modifier</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 site">
                <div class="bg-grey white-logo">
                    <img src="<?php echo '../images/' . $image ; ?>">
                    <div class="text-articles">  
                        <p><?php echo $category; ?></p>                        
                        <p><?php echo $title; ?></p>
                        <p><?php echo $description; ?></p>
                        <p><?php echo $link; ?></p>                    
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>