<?php include('includes/header.php'); ?>

<?php
    use App\Core\Session;
    $errors = Session::getFlash('errors');
?>

<link rel="stylesheet" href="/../demo/public/assets/css/login.css">

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <?php if (Session::flashHas('success')) : ?>
            <div class="success"><?= Session::getFlash('success') ?? '' ?></div>
        <?php endif ?>

        <h1>Login page</h1>

        <div class="mb-3">
            <a href="/demo/register">Don't have an account yet? register here</a>
        </div>

        <form action="/demo/login" method="post">
            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label required">Username <i class="fa-solid fa-user"></i></label>
                <input type="text"
                    name="username"
                    class="form-control <?= isset($errors['username']) ? 'border-red' : '' ?>"
                    id="exampleInputUsername1"
                    placeholder="Your username .."
                    value="<?= old('username') ?>"
                >
                <small><?= $errors['username'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label required">Password <i class="fa-solid fa-key"></i></label>
                <input type="password" 
                    name="password"
                    placeholder="Your password .."
                    class="form-control <?= isset($errors['password']) ? 'border-red' : '' ?>"
                    id="exampleInputPassword1"
                >
                <small><?= $errors['password'] ?? '' ?></small>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="rememberme" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php Session::clearFlash() ?>