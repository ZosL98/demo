<?php include('includes/header.php'); ?>

<?php
    use App\Core\Session;

    $errors = Session::getFlash('errors');
?>

<link rel="stylesheet" href="/../demo/public/assets/css/profile.css">

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <h1>Profile <i class="fa-regular fa-address-card"></i></h1>
        
        <?php if (Session::flashHas('success')) : ?>
                <b class="success"><?= Session::getFlash('success') ?></b>
        <?php endif ?>

        <ul>
            <?php if (!empty($errors['file'])) { ?>
                <?php foreach($errors['file'] as $e) { ?>
                    <li style="color: red;"><u><small><?= $e ?></small></u></li>
                <?php } ?>
            <?php } ?>
        </ul>

        <div class="image-wrapper">
            <img src="/demo/public/assets/uploads/<?= $userData['image'] ?>" alt="Profile image" id="img">
            <div class="overlay-text">Change your profile image</div>
        </div>

        <br>

        <form action="/demo/profile" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file">

            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label">Username <i class="fa-solid fa-user"></i></label>
                <input type="text"
                    name="username"
                    class="form-control <?= isset($errors['username']) ? 'border-red' : '' ?>"
                    id="exampleInputUsername1"
                    placeholder="Change your username here .."
                    value="<?= old('username') ?>"
                >
                <small><?= $errors['username'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">Email <i class="fa-solid fa-at"></i></label>
                <input type="Email" 
                    name="email"
                    placeholder="Change your email here .."
                    class="form-control <?= isset($errors['email']) ? 'border-red' : '' ?>"
                    id="exampleInputEmail"
                    value="<?= old('email') ?>"
                >
                <small><?= $errors['email'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label required">Confirm changes with password <i class="fa-solid fa-key"></i></label>
                <input type="password" 
                    name="password"
                    placeholder="Your password .."
                    class="form-control <?= isset($errors['password']) ? 'border-red' : '' ?>"
                    id="exampleInputPassword1"
                >
                <small><?= $errors['password'] ?? '' ?></small>
            </div>

            <div><a href="/demo/passwordchange">Change your password here</a></div>
            
            <br>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>

    </div>
</div>

<script src="/../demo/public/assets/js/profile.js"></script>

<?php include('includes/footer.php'); ?>
<?php Session::clearFlash() ?>