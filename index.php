
<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="assets/css/main.css">
      <link rel="stylesheet" href="assets/css/mediaqueries.css">
      <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
      <script src="https://kit.fontawesome.com/4af066ad9c.js" crossorigin="anonymous"></script>
      <!-----------------------------------BOOTSTRAP-------------------------------------------------->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <!------------------------------------ICONS-------------------------------------------------->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
      <title>P.BAURENS WEB-BOOK</title>
  </head>
  <body>
    <header class="home">
      <div id="home" class="nav-container">
        <nav id="nav" class="navbar nav-fixed">
          <a href="https://www.philippebaurens.com/" id="navbar-logo" class="header_navbar-logo-title"><img class="brandlogo" src="assets/img/brand-logo/LogoSnapshotPB.png" alt="logo de Philippe Baurens"></a>
          <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </div>
          <ul class="nav-menu">
            <li><a href="#home" class="nav-links">HOME</a></li>
            <li><a href="#apropos" class="nav-links">A PROPOS</a></li>
            <li><a href="#projets" class="nav-links">PROJETS</a></li>
            <li><a href="#contact" class="nav-links">CONTACT</a></li>
          </ul>
        </nav>
      </div>
      <div id="prez" class="wrapper">
        <div class="name">
          <h1>Philippe BAURENS</h1>
        </div>
        <div class="title">
          <h2>Développeur Web Full Stack JS</h2>
        </div>
        <div class="profile">
          <h3>VOIR MON PROFIL</h3>
        </div>
        <div class="btn" dest="">
            <a href="#apropos" class="link-profil"><span id="arrow" class="material-icons">keyboard_arrow_down</span></a>
        </div>
      </div>
    </header>
    <main>
      <!----------------------------------------------A PROPOS--------------------------------------------->
      <section id="apropos" class="about">
          <div class="container-title-section">
            <div class="title-section">
              <h2>A PROPOS</h2>
            </div>
            <div class="title-bar"></div>
          </div>
          <div class="container-about">
            <div class="picture">
              <img src="assets/img/IMG_2461.jpg" alt="photo de Philippe Baurens">
            </div>
            <div class="about-text">
                <p>
                Après 15 ans d’expérience dans la pub en tant qu’ingénieur du son, j’ai choisi de
                faire évoluer ma carrière professionnelle dans le web.<br>
                <br>
                Fort d’une expérience de onze ans dans le secteur de la publicité pour le groupe <strong>HAVAS</strong>, 
                j’ai travaillé pour de nombreux clients et marques différentes. J’ai acquis dans ce contexte une vraie capacité d’adaptation, 
                de gestion projet et de travail en équipe ainsi qu’une expertise de la qualité des livrables.</p>
                <br>
                <p>Passionné de nouvelles technologies, <strong>curieux</strong> et <strong>motivé</strong>, j’ai une forte appétence pour le domaine <strong>audiovisuel</strong>, la <strong>video</strong> et le <strong>sound-design</strong>.
                <br>Mon appétence créative m’oriente naturellement vers les technologies Front-end, mais je reste captivé par
                le développement Back-end également.
                </p>
                <br>
                <p>Après une formation de développeur Web & Web Mobile, je poursuis actuellement mon apprentissage par un cursus en alternance de <strong>Concepteur Développeur D'Applications</strong>
                au centre de formation Simplon.co.
                </p>
            </div>
          </div>
      </section>
      <!---------------------------------------------------Download----------------------------------------------->
      <section class="download">
        <div class="btn-download">
          <a href="assets/cv/PhilippeBAURENS-CV-2021.pdf" class="link-download" target="_blank" 
            download="PhilippeBAURENS-CV-2021.pdf">Télécharger mon CV 
            <span id="download" class="material-icons">
              get_app
            </span>
          </a>
        </div>
      </section>
      <!----------------------------------------------------PROJET--------------------------------------------------->
      <section id="projets" class="projects">
        <div class="container-title-section">
          <div class="title-section">
            <h2>projets</h2>
          </div>
          <div class="title-bar"></div>
        </div>
        <div class="container-projects">
          <div class="projects-text">
            <p>Voici les principaux projets que j'ai créés et développés.</p>
          </div>
          <!--------------------------------START PHP--------------------------------->
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
      <!------------------------------------------CONTACT---------------------------------------------------->
      <section id="contact" class="contact"> 
        <div class="container-title-section">
          <div class="title-section">
            <h2>CONTACT</h2>
          </div>
          <div class="title-bar"></div>
        </div>
        <div class="contact-me">
          <p>N'hésitez pas à me contacter</p>
        </div>
      <div class="form-container">
        <form id="contact-form" method="post" action="" role="form">
        <div class="row">
          <div class="col-25">
            <label for="firstname">Prénom</label>
          </div>
          <div class="col-75">
            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Prénom">
            <p class="comments"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
          <label for="name">Nom</label>
          </div>
          <div class="col-75">
          <input type="text" id="name" name="name" class="form-control" placeholder="Nom">
            <p class="comments"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
          <label for="email">Email</label>
          </div>
          <div class="col-75">
          <input type="text" id="email" name="email" class="form-control" placeholder="Email">
            <p class="comments"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
          <label for="message">Message</label>
          </div>
          <div class="col-75">
            <textarea id="message" name="message" class="form-control" placeholder="Message" style="height:200px"></textarea>
            <p class="comments"></p>
          </div>
        </div>
        <div class="row">
          <input type="submit" class="button-form" value="Envoyer">
        </div>
        </form>
      </div>
      </section>
      <!------------------------------------------FOOTER---------------------------------------------------->
      <footer>
        <section id="footer">
          <div class="social">
            <ul class="flex-row footer-social">
              <li>
                  <a href="https://www.linkedin.com/in/philippe-baurens/" target="_blank">
                  <span style="color:Grey;"><i class="fab fa-linkedin-in"></i></span>
                  </a>
              </li>
              <li>
                  <a href="https://github.com/Phildevfront" target="_blank">
                  <span style="color:Grey;"><i class="fab fa-github"></i></span>
                  </a>
              </li>
              <li>
                  <a href="mailto:pbaurens.dev@gmail.com" target="_blank">
                  <span style="color:Grey;"><i class="fas fa-envelope"></i></span>
                  </a>
              </li>
            </ul>
          </div>
          <div class="copyright">
              <p>© Copyright 2020 | Philippe BAURENS</p>
          </div>
        </section>
      </footer>    
    </main>
    <script type="text/javascript" src="assets/js/form-script.js"></script>
    <script type="text/javascript" src="assets/js/nav-filter.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/navbar-close.js"></script>
    <script type="text/javascript" src="assets/js/nav-scroll.js"></script>
    <script type="text/javascript" src="assets/js/nav-add-color.js"></script>
  </body>
</html>





