<!-- header.php -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style.css">

<header class="entete">
    <a href="/SiteCID/SiteCID/src/index.php"><img class="logo" src="/SiteCID/SiteCID/src/assets/imgs/logo.png" alt=""></a>

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
        <a href="" class="btn-mail"><img class="mail" src="/SiteCID/SiteCID/src/assets/imgs/mail.png" alt=""></a> 
        <a href="/SiteCID/SiteCID/src/pages/login.php" class="btn-compte"><img class="compte" src="/SiteCID/SiteCID/src/assets/imgs/compte.png" alt=""></a>
    </div>
</header>
