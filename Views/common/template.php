<!doctype html>
<html lang="en">

<head>
  <title><?= $page_title; ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= $page_description; ?>">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= URL ?>/Public/CSS/style.css">

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

    <?php if(!empty($page_javascript)) : ?>
      <?php foreach ($page_javascript as $fichier_javascript) : ?>
        <script src="<?= URL?>public/JavaScript/<?= $fichier_javascript ?>"></script>
      <?php endforeach; ?>
    <?php endif; ?>

    <script src="<?= URL ?>public/JavaScript/jquery-3.2.1.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/9bae5d6ed8.js" crossorigin="anonymous"></script>
  </body>
</html>