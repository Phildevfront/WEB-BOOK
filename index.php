
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/4af066ad9c.js" crossorigin="anonymous"></script>
    <!----------------------------BOOTSTRAP-------------------------------------------------->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!--<script type="text/javascript" src="assets/js/form-script.js"></script>-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    
   
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
        <h1>Philippe BAURENS</h1>
      </div>
      <div class="title">
        <h2>Je suis développeur web & web mobile</h2>
      </div>
      <div class="btn" dest="">
        <button type="button" class="btn btn-link">
          <a href="#anchor1" class="link-profil">Voir mon profil <span class="material-icons">chevron_right</span></a>
        </button>
      </div>
    </div>
  </header>
  <main>
    <!----------------------------------------------A PROPOS--------------------------------------------->
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
    </section>
    <!---------------------------------------------------Download----------------------------------------------->
    <section class="download">
      <div class="btn-download">
        <button type="button" class="btn btn-link download">
          <a href="assets/cv/PhilippeBAURENS-CV.pdf" class="link-download" target="_blank" download="PhilippeBAURENS-CV.pdf">Télécharger mon CV <span class="material-icons">get_app</span></a>
        </button>
      </div>
    </section>
    <!----------------------------------------------------PROJET--------------------------------------------------->
    <section id="anchor2" class="projects">
      <div class="container-title-section">
        <div class="title-section"><h2>projects</h2></div>
        <div class="title-bar"></div>
      </div>
      <div class="container-projects">
        <div class="projects-text">
          <p>Voici les projects que j'ai créés et développés.</p>
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
    <section id="anchor3" class="contact"> 
      <div class="container-title-section">
        <div class="title-section"><h2>CONTACT</h2></div>
        <div class="title-bar"></div>
      </div>
      <div class="contact-me">
        <p>N'hésitez pas à me laisser un message</p>
      </div>
    <div class="form-container">
      <form id="contact-form" method="post" action="" role="form">
        <div class="row">
          <div class="col-25">
            <label for="firstname">Prénom<!--<span class="blue-star"> *</span>--></label>
          </div>
          <div class="col-75">
            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Prénom">
            <p class="comments"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
          <label for="name">Nom<!--<span class="blue-star"> *</span>--></label>
          </div>
          <div class="col-75">
          <input type="text" id="name" name="name" class="form-control" placeholder="Nom">
            <p class="comments"></p>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
          <label for="email">Email<!--<span class="blue-star"> *</span>--></label>
          </div>
          <div class="col-75">
          <input type="text" id="email" name="email" class="form-control" placeholder="Email">
            <p class="comments"></p>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
          <label for="message">Message<!--<span class="blue-star"> *</span>--></label>
          </div>
          <div class="col-75">
            <textarea id="message" name="message" class="form-control" placeholder="Message" style="height:200px"></textarea>
            <p class="comments"></p>
          </div>
        </div>

        <!--<div class="row">
          <div class="col-75">
          <p class="blue-star">* Ces informations sont requises</p>
          </div>
        </div>-->

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
              <p>© Copyright 2020 - Philippe BAURENS</p>
          </div>
      </section>
    </footer>    
  </main>

    <script type="text/javascript" src="assets/js/form-script.js"></script>
    <script type="text/javascript" src="assets/js/nav-filter.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/navbar-close.js"></script>
    <script type="text/javascript" src="assets/js/nav-scroll.js"></script>
    <script type="text/javascript" src="assets/js/form.js"></script>

</body>
</html>





