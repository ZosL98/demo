<?php include('includes/header.php'); ?>

<?php
    use App\Core\Session;

    $errors = Session::getFlash('errors');
?>

<link rel="stylesheet" href="/../demo/public/assets/css/password_change.css">

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <?php if (Session::flashHas('success')) : ?>
            <div class="success"><?= Session::getFlash('success') ?? '' ?></div>
        <?php endif ?>

        <a href="/demo/profile">Go back</a>

        <h1>Password Change</h1>

        <form action="/demo/passwordchange" method="post">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label required">Current password <i class="fa-solid fa-key"></i></label>
                <input type="password" 
                    name="current_password"
                    placeholder="Your current password .."
                    class="form-control <?= isset($errors['current_password']) ? 'border-red' : '' ?>"
                    id="exampleInputPassword1"
                >
                <small><?= $errors['current_password'] ?? '' ?></small>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label required">New password <i class="fa-solid fa-key"></i></label>
                <input type="password" 
                    name="new_password"
                    placeholder="Your new password .."
                    class="form-control <?= isset($errors['new_password']) ? 'border-red' : '' ?>"
                    id="exampleInputPassword1"
                >
                <small><?= $errors['new_password'] ?? '' ?></small>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label required">Confirm password <i class="fa-solid fa-key"></i></label>
                <input type="password" 
                    name="confirm_password"
                    placeholder="Confirm with your new password .."
                    class="form-control <?= isset($errors['confirm_password']) ? 'border-red' : '' ?>"
                    id="exampleInputPassword1"
                >
                <small><?= $errors['confirm_password'] ?? '' ?></small>
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>

    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php Session::clearFlash(); ?>