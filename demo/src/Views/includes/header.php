<?php use App\Core\Session; ?>

<?php
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_username'])) {
        Session::put('user_id', $_COOKIE['user_id']);
        Session::put('user_username', $_COOKIE['user_username']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script src="/../demo/public/assets/js/jquery.js"></script>

    <style>
      .log_container {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        background-color: lightgreen;
        padding: 5px;
      }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/demo/">Demo <i class="fa-solid fa-bowl-rice"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/demo/') ? 'active' : '' ?>" href="/demo/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/demo/login') ? 'active' : '' ?>" href="/demo/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= urlIs('/demo/comments') ? 'active' : '' ?>" href="/demo/comments">Comments</a>
        </li>
        <?php if (Session::has("user_id")) : ?>
          <li class="nav-item">
            <a class="nav-link" href="/demo/logout">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php if (Session::has("user_id")) : ?>
        <div class="log_container">
          <div class="log">You are logged in as: <?= Session::get("user_username") ?></div>
          <div><a href="/demo/profile">Profile</a></div>
        </div>
<?php endif ?>