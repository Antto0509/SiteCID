<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Cercle des Informaticiens Dispersés</title>
</head>
<body>
    <header>
        <img class="logo" src="assets/imgs/logo.png" alt="">

        <?php
        $menuVisible = isset($_GET['menu']) && $_GET['menu'] == 'open';
        ?>
        
        <div class="sidenav <?php echo $menuVisible ? 'active' : ''; ?>">
        <a id="closeBtn" href="?menu=close" class="close">×</a>
            <ul>
                <li><a href="#">A propos</a></li>
                <li><a href="#">Nos services</a></li>
                <li><a href="#">Témoignages</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <a href="?menu=open" id="openBtn">
            <span class="burger-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <form action="" class="search-bar">
            <input type="search" name="search" required autocomplete="off">
            <button class="searsh-button" type="submit">
                <span>Search</span>
            </button>
        </form>

        <button class="btn-mail"><img class="mail" src="assets/imgs/mail.png" alt=""></button>
        <button class="btn-compte"><img class="compte" src="assets/imgs/compte.png" alt=""></button>
    </header>

    <h1>Présentation</h1>
    <div class="box-prez">
        <div class="col1">
            <h2>Mot du président :</h2>
            <p>Loremp ipsum</p>
            <p>Je suis [Nom et Prénom], le/la Président.e de l'association du Cercle des Informaticiens Dispersés (CID). Lorem ipsum dolor sit amet, 
                consectetur adipiscing elit. Sed sed arcu neque. Vestibulum id luctus dui, ut pharetra mi. Fusce tincidunt dolor nec pulvinar 
                condimentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam mollis, turpis eget 
                pharetra eleifend, libero ipsum commodo leo, in placerat leo enim.</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
        </div>
        <div class="col2">
            <img src="" alt="">
            <p>Président</p>
            <img src="" alt="">
            <p>Secrétaire</p>
        </div>
    </div>
</body>
</html>

