<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>EDUSPHERE - Apprendre une nouvelle compétence, tous les jours, à tout moment et n'importe où</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
            <img class="logo" src="assets/img/logo.png" alt="..." width='70' />
            <a class="navbar-brand" href="#page-top">EDUSPHERE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <?php
                    $menu = [
                        'Accueil' => 'Accueil.php',
                        'Cours' => 'Cours.php',
                        'A propos' => 'Apropos.php',
                        'Se connecter' => 'Connexion.php',
                        'S\'inscrire' => 'Inscription.php'
                    ];
                    foreach ($menu as $label => $link) {
                        echo "<li class='nav-item'><a class='nav-link' href='$link'>$label</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container px-5">
                <h1 class="masthead-heading mb-0">EDUSPHERE</h1>
                <h2 class="masthead-subheading mb-0">Apprendre une nouvelle compétence,</h2>
                <h2 class="masthead-subheading mb-0">tous les jours, à tout moment et n'importe où</h2>
                <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">En apprendre plus</a>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>
    <!-- Content section 1-->
    <section id="scroll">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/img1.png" alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Étudiants ou professeurs, EDUSPHERE est fait pour vous !</h2>
                        <p>Que vous soyez un étudiant désireux de progresser à votre rythme, ou un professeur prêt à partager vos connaissances, notre plateforme s'adapte à vos besoins. Accédez facilement à vos cours, interagissez sur les forums, créez ou suivez des quiz, et rejoignez une communauté dynamique qui place l'apprentissage et l'entre aide au centre de tout.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content section 2-->
    <section>
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/img2.png" alt="..." /></div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4">Apprenez et collaborez en toute simplicité</h2>
                        <p>Sur EDUSPHERE, chaque cours est une opportunité d’échanger et de grandir. Les forums dédiés à chaque leçon vous permettent de poser des questions, de partager des idées et de collaborer avec vos pairs. Que vous ayez besoin d’aide ou d’inspiration, notre communauté est là pour vous soutenir tout au long de votre parcours.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content section 3-->
    <section>
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/img3.png" alt="..." /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Un espace où l'excellence rencontre la flexibilité</h2>
                        <p>Avec EDUSPHERE, la qualité de l’enseignement n’est jamais compromise. Nos outils intuitifs et flexibles vous permettent de suivre, créer ou gérer des cours à votre rythme, sans sacrifier la rigueur académique. De la gestion de vos contenus à l’évaluation des étudiants, tout est conçu pour simplifier vos tâches et vous permettre de vous concentrer sur l’essentiel : l’apprentissage.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-black">
        <div class="container px-5">
            <p class="m-0 text-center text-white small">Contact</p>
            <p class="m-0 text-center text-white small">FAQ</p>
            <p class="m-0 text-center text-white small">Politique de confidentialité</p>
            <p class="m-0 text-center text-white small">Conditions générales d'utilisation</p>
            <p></p>
            <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2024</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>