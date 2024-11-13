<!doctype html>
<html lang="en">

<head>
  <title><?= $page_title; ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= $page_description; ?>">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
  <link rel="stylesheet" href="<?= URL ?>/public/CSS/styles.css">  


</head>

  <body id="page-top">
      <?php require_once("./Views/common/menu.php"); ?>
      <?= $page_content; ?>

    <?php
        if (!empty($_SESSION['alert'])) {
          foreach ($_SESSION['alert'] as $alert) {
            echo "<div class='alert " . $alert['type'] . "' role='alert'>".$alert['id']."</div>";
          }
          unset($_SESSION['alert']);
        }
        ?>
        
    <footer>
      <?php require_once("./Views/common/footer.php"); ?>
    </footer>

    <?php if(!empty($page_javascript)) : ?>
      <?php foreach ($page_javascript as $fichier_javascript) : ?>
        <script src="<?= URL?>public/JavaScript/<?= $fichier_javascript ?>"></script>
      <?php endforeach; ?>
    <?php endif; ?>

    <script src="<?= URL ?>public/JavaScript/jquery-3.2.1.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/9bae5d6ed8.js" crossorigin="anonymous"></script>
  </body>
</html>