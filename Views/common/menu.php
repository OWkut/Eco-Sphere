<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container px-5">
        <img class="logo" src="public/Assets/images/logo.png" alt="..." width='70'/>
            <a class="navbar-brand" href="#page-top">EDUSPHERE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= URL; ?>accueil">Accueil</a></li>
                <?php if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') : ?>
                    <li class="nav-item"><a href="<?= URL; ?>droits" class="nav-link">Gestion des comptes</a></li>
                    <li class="nav-item"><a href="<?= URL; ?>themes" class="nav-link">Gestion des thèmes</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') : ?>
                    <li class="nav-item"><a href="<?= URL; ?>cours" class="nav-link">Gestion des cours</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Eleves') : ?>
                    <li class="nav-item"><a href="<?= URL; ?>cours_eleves" class="nav-link">Cours</a></li>
                <?php endif; ?>
                <?php if (empty($_SESSION['profil'])) : ?>
                    <li class="nav-item"><a href="<?= URL; ?>connexion" class="nav-link">Identification</a></li>
                    <li class="nav-item"><a href="<?= URL; ?>inscription" class="nav-link ">Créer compte</a></li>
                <?php endif; ?>
                <?php if (!empty($_SESSION['profil'])) : ?>
                    <li class="nav-item"><a href="<?= URL; ?>deconnexion" class="nav-link">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>