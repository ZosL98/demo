<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="/../demo/src/Views/assets/css/user.css">

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <a href="/demo/comments">Go back</a>

        <div class="userContainer">
            
            <img src="/../demo/public/assets/uploads/<?= $userData['image'] ?>" alt="">

            <div class="user_info">
                <ul>
                    <li><?= htmlspecialchars($userData['username']) ?></li>
                    <li><?= htmlspecialchars($userData['email']); ?></li>
                </ul>
            </div>
            
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>