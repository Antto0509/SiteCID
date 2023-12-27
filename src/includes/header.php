<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo URLSITEWEB; ?>/css/style.css">

<header class="entete">
    <a href="<?php echo URLSITEWEB; ?>/index.php"><img class="logo" src="<?php echo IMGS_PATH; ?>/logo.png" alt=""></a>

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

    <a href="?menu=open" class="openBtn">
        <span class="burger-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <form class="search__container">
        <input class="search__input" type="text" placeholder="Rechercher un évènement, une personne...">
    </form>

    <div class="header-right">
        <a href="" class="btn-mail"><img class="mail" src="<?php echo IMGS_PATH; ?>/mail.png" alt=""></a>
        <a href="<?php echo PAGES_PATH; ?>/login.php" class="btn-compte"><img class="compte" src="<?php echo IMGS_PATH; ?>/compte.png" alt=""></a>
    </div>
</header>