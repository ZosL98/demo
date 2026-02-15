<?php include('includes/header.php'); ?>

<?php
    use App\Core\Session;
    $errors = Session::getFlash('errors');
?>

<style>
    small {
        color: red;
    }

    form .border-red {
        border-color: red !important;
    }

    .required::before {
        content: '* ';
        color: red;
    }

    .success {
        color: limegreen;
    }

    .required::before {
        content: '* ';
        color: red;
    }
</style>

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <h1>Contact</h1>

        <div class="success">
            <u><?= Session::flashHas('success') ? Session::getFlash('success') : '' ?></u>
        </div>

        <form method="post" action="/demo/contact">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label required">Email address <i class="fa-solid fa-at"></i></label>
                <input type="email" value="<?= old('email') ?>" name="email" class="form-control <?= isset($errors['email']) ? 'border-red' : '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email ..">
                <small><?= $errors['email'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleInputSubject" class="form-label required">Subject <i class="fa-solid fa-envelope"></i></label>
                <input type="text" name="subject" value="<?= old('subject') ?>" class="form-control <?= isset($errors['subject']) ? 'border-red' : '' ?>" id="exampleInputSubject" aria-describedby="emailHelp" placeholder="Subject ..">
                <small><?= $errors['subject'] ?? '' ?></small>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label required">Your message <i class="fa-solid fa-comment"></i></label>
                <textarea class="form-control <?= isset($errors['message']) ? 'border-red' : '' ?>" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Your message .."><?= old('message') ?></textarea>
                <small><?= $errors['message'] ?? '' ?></small>
            </div>
            <button type="submit" class="btn btn-primary">Send message</button>
        </form>

    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php Session::clearFlash() ?>
