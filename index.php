<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <!----------------------------BOOTSTRAP--------------------------------------------------
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <script src="https://kit.fontawesome.com/4af066ad9c.js" crossorigin="anonymous"></script>
   
    <title>WEB BOOK</title>
</head>
<body>
  <header class="home">
    <div id="anchor0" class="nav-container">
      <nav id="nav" class="navbar">
        <!--<h1 id="navbar-logo" class="header_navbar-logo-title"></h1>-->
        <a href="#" id="navbar-logo" class="header_navbar-logo-title">Philippe BAURENS</a>
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <ul class="nav-menu">
          <li><a href="#anchor0" class="nav-links">HOME</a></li>
          <li><a href="#anchor1" class="nav-links">A PROPOS</a></li>
          <li><a href="#anchor2" class="nav-links">PROJECTS</a></li>
          <li><a href="#anchor3" class="nav-links">CONTACT</a></li>
          <!--<li><a href="shop.html" class="nav-links nav-links-btn">SHOP</a></li>-->
        </ul>
      </nav>
    </div>
    
    <div id="prez" class="wrapper">
      <div class="name">
        <h1>Philippe Baurens</h1>
      </div>
      <div class="title">
        <h2>Je suis développeur web & web mobile</h2>
      </div>
      <div class="btn" dest="#anchor1">
        <button type="button" class="btn btn-link">
          <a href="#anchor1" class="link-profil">Voir mon profil <span class="material-icons">chevron_right</span></a>
        </button>
      </div>
    </div>
</header>
  <main>
    <section id="anchor1" class="about">
        <div class="container-title-section">
          <div class="title-section"><h2>A PROPOS</h2></div>
          <div class="title-bar"></div>
        </div>
        <div class="container-about">
          <div class="picture">
            <img src="assets/img/IMG_2461.jpg">
          </div>
          <div class="about-text">
            <p>Après 15 ans d’expérience dans la pub en tant qu’ingénieur du son, j’ai choisi de
              faire évoluer ma carrière professionnelle dans le web.<br>
              Passionné de nouvelles technologies, curieux et motivé, j’ai une grande expérience de la culture d’entreprise.
              <br>Mon appétence créative m’oriente naturellement vers les technologies Front-end, mais je reste captivé par
              le développement Back-end également.
            </p>
          </div>
        </div>
    </section>
    <section id="anchor2" class="projects">
      <div class="container-title-section">
        <div class="title-section"><h2>projects</h2></div>
        <div class="title-bar"></div>
      </div>
      <div class="container-projects">
        <div class="projects-text">
          <p>Voici plusieurs projects que j'ai créés et développés avec différents langages</p>
        </div>
        <!--------------------------------START PHP--------------------------------------------->
        <?php
        require 'admin/database.php';
        echo '<div class="nav-filter-container">
        <div class="nav-filter-container">';
        echo '<nav class="nav-projects">
        <ul id="fil" class="nav nav-filter-projects">';
        $db = Database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();
        foreach($categories as $category)
        {
          if($category['id'] == '1')
            echo'<li role="presentation" class="active"><a href="#' . $category['id'] . '" class="link-filter" data-toggle="tab">' . $category['name'] . '</a></li>';
          else
            echo'<li role="presentation"><a href="#' . $category['id'] . '" class="link-filter" data-toggle="tab">' . $category['name'] . '</a></li>';
        }
        echo'</ul>
        </nav>
        </div>';

        echo'<div id="filter" class="tab-content">';
        foreach($categories as $category)
        {
                if($category['id'] == '1')
                    echo '<div class="tab-pane active" id="' . $category['id'] . '">';
                else
                    echo '<div class="tab-pane" id="' . $category['id'] . '">';

                echo '<div class="projects-cards">';

                $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?'); // Select tous les articles qui ont une catégorie spécifique
                $statement->execute(array($category['id']));
                while($item = $statement->fetch())
                {
                  echo'<div class="cover">
                        <div class="flip-card">
                          <div class="flip-card-inner">
                            <div class="flip-card-front">
                              <img src="images/' . $item['image'] . '">';
                        echo'</div>';
                        echo'<div class="flip-card-back">
                              <h2>- ' . $item['title'] . ' -</h2>
                              <p>' . $item['description'] . '</p>
                              <button type="button" class="link"><a class="link-site" href="' . $item['link'] . '" target="_blank">Voir le site</a></button>
                            </div>
                          </div>
                        </div>
                      </div>';
                }
            echo'</div>
            </div>';
        }
        Database::disconnect();
        ?> 
    </section>
    <section id="anchor3" class="contact"> 
      <div class="container-title-section">
        <div class="title-section"><h2>CONTACT</h2></div>
        <div class="title-bar"></div>
      </div>
      <div class="form-style-8">
        <h2>Login to your account</h2>
        <form>
          <input type="text" name="field1" placeholder="Full Name" />
          <input type="email" name="field2" placeholder="Email" />
          <input type="url" name="field3" placeholder="Website" />
          <textarea placeholder="Message" onkeyup="adjust_textarea(this)"></textarea>
          <input type="button" value="Send Message" />
        </form>
      </div>

    </section>
    <!--
   -->

  </main>
  
    <script type="text/javascript" src="assets/js/nav-filter.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/navbar-close.js"></script>
    <script type="text/javascript" src="assets/js/nav-scroll.js"></script>
</body>
</html>





<!--
<div class="nav-filter-container">
          <nav class="nav-projects">
            <ul class="nav nav-filter-projects">
                <li role="presentation" class="active"><a href="#1" class="link-filter" data-toggle="tab">PROFESSIONNEL</a></li>
                <li role="presentation"><a href="#2" class="link-filter" data-toggle="tab">PERSONNEL</a>
            </ul>
          </nav>
        </div>
        <div class="projects-cards">
          <div class="cover">
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                <img src="assets/img/projets/leninacrowne.png"> 
              </div>
              <div class="flip-card-back">
              <h2>- LENINA CROWNE -</h2> 
              <p>Site Web vitrine de Lenina Crowne<br><br>Réalisé & développé en<br><br>HTML5 CSS3 & JAVASCRIPT</p>
              <button type="button" class="link"><a class="link-site" href="http://www.leninacrowne.org" target="_blank">Voir le site</a></button>
              </div>
            </div>
          </div>
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
              <img src="assets//img/projets/jessienottola.png">
              </div>
              <div class="flip-card-back">
              <h2>- JESSIE NOTTOLA -</h2> 
              <p>Site Web vitrine<br>du réalisateur & photographe <br>indépandant Jessie Nottola<br><br>
                Réalisé & développé avec<br>
                le CMS WORDPRESS</p> 
              <button class="link"><a class="link-site" href="https://www.jessienottola.com" target="_blank">Voir le site</a></button>
              </div>
            </div>
          </div>
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
              <img src="assets/img/projets/portfolio.png">
              </div>
              <div class="flip-card-back">
              <h2>- PORTFOLIO -</h2> 
              <p>CV portfolio personnel<br><br>
                Réalisé & développé lors de ma formation</p>
              <button class="link"><a class="link-site" href="http://www.philippebaurens.com" target="_blank">Voir le site</a></button>
              </div>
            </div>
          </div>
          <div class="flip-card">
            <div class="flip-card-inner">
              <div class="flip-card-front">
              <img src="assets/img/projets/orsc.png">
              </div>
              <div class="flip-card-back">
              <h2>- ORSC -</h2> 
              <p>Site Web vitrine</p> 
              <button class="link"><a class="link-site" href="https://orscprogram.com" target="_blank">Voir le site</a></button>
              </div>
            </div>
          </div>
        </div>
      </div>-->


      <!--<div class="row-form">
                       
        <form action="traitement.php" method="post" name="form">
            <div>
              <label for="contactName"></label>
              <input type="text" value="" placeholder="Name" size="35" name="nom">
            </div>
            <div>
              <label for="contactEmail"></label>
              <input type="text" value="" placeholder="Email"size="35" name="email">
            </div>
            <div>
              <label for="contactMessage"></label>
              <textarea cols="50" placeholder="Your Message" rows="15" name="message"></textarea>
            </div>
            <div>
               <button class="submit">Soumettre</button>
            </div>
            <p class="thanks" style="display:<?php if($isSuccess) echo 'block'; else echo 'none';?>">Votre message a bien été envoyé.Merci de m'avoir contacté.</p>
        </form> 
      </div>-->  