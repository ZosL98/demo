<?php include('includes/header.php'); ?>

<?php
    use App\Core\Session;
    $errors = Session::getFlash('errors');
?>

<link rel="stylesheet" href="/../demo/public/assets/css/register.css">

<div class="container mt-5">
    <div class="col-md-8 mx-auto">
        
        <?php if (Session::flashHas('success')) : ?>
            <div class="success"><?= Session::getFlash('success') ?? '' ?></div>
        <?php endif ?>

        <h1>Registration page</h1>

        <div class="mb-3">
            <a href="/demo/login">Go back</a>
        </div>

        <form action="/demo/register" method="post">
            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label required">Username <i class="fa-solid fa-user"></i></label>
                <input type="text"
                    class="form-control <?= isset($errors['username']) ? 'border-red' : '' ?>"
                    name="username"
                    id="exampleInputUsername1"
                    placeholder="Your username .."
                    value="<?= old('username') ?>"
                >
                <small><?= $errors['username'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label required">Email address <i class="fa-solid fa-at"></i></label>
                <input type="email"
                    class="form-control <?= isset($errors['email']) ? 'border-red' : '' ?>"
                    name="email"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    placeholder="Your email address .."
                    value="<?= old('email') ?>"
                >
                <small><?= $errors['email'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label required">Password <i class="fa-solid fa-key"></i></label>
                <input
                    type="password"
                    name="password"
                    class="form-control <?= isset($errors['password']) ? 'border-red' : '' ?>"
                    placeholder="Your password .."
                    id="exampleInputPassword1">
                <small><?= $errors['password'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputPasswordConfirm" class="form-label required">Confirm password <i class="fa-solid fa-key"></i></label>
                <input
                    type="password"
                    name="password_confirm"
                    class="form-control <?= isset($errors['password_confirm']) ? 'border-red' : '' ?>"
                    placeholder="Confirm your password .."
                    id="exampleInputPasswordConfirm">
                <small><?= $errors['password_confirm'] ?? '' ?></small>
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php Session::clearFlash(); ?>