<?php include('includes/header.php'); ?>
<?php
    use App\Core\Session;
    $errors = Session::getFlash('errors');
    
    function renderComments($parent_id, $comments)
    {
        if (!isset($comments[$parent_id])) return;

        foreach($comments[$parent_id] as $cmt) {
?>
        <details open class="comment" id="comment-1">
            <a href="javascript:void(0)" class="comment-border-link">
                <span class="sr-only">Jump to comment-1</span>
            </a>
            <summary>
                <div class="comment-heading">
                    <div class="comment-voting">
                        <button type="button">
                            <span aria-hidden="true">&#9650;</span>
                            <span class="sr-only">Vote up</span>
                        </button>
                        <button type="button">
                            <span aria-hidden="true">&#9660;</span>
                            <span class="sr-only">Vote down</span>
                        </button>
                    </div>
                    <div class="comment-info">
                        <img class="profile_image" src="/demo/public/assets/uploads/<?= $cmt['image'] ?>" alt=""> &nbsp;
                        <a href="/demo/user?id=<?= $cmt['user_id'] ?>" class="comment-author"><?= htmlspecialchars($cmt['username']); ?></a>
                        <p class="m-0">
                           Posted &bull; <?= $cmt['created_at'] ?>
                        </p>
                    </div>
                </div>
            </summary>

            <div class="comment-body">
                <p>
                    <?= htmlspecialchars($cmt['comment']); ?>
                </p>
                <button type="button" data-toggle="reply-form" data-target="reply-form-<?= $cmt['id'] ?>">Reply</button>
                <?php
                    if (Session::get('user_username') === htmlspecialchars($cmt['username'])) :
                ?>
                        <form action="/demo/comments/delete" method="post" style="display: inline-block;">
                            <input type="hidden" name="delete" value="<?= $cmt['id'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                <?php endif ?>

                <!-- Reply form start -->
                <form method="POST" action="/demo/comments/store" class="reply-form d-none" id="reply-form-<?= $cmt['id'] ?>">
                    <textarea placeholder="Reply..." rows="3" name="comment" required></textarea>
                    <input type="hidden" name="parent_id" value="<?= $cmt['id'] ?>">
                    <button type="submit">Submit</button>
                    <button type="button" data-toggle="reply-form" data-target="reply-form-<?= $cmt['id'] ?>">Cancel</button>
                </form>
                <!-- Reply form end -->
            </div>
            <!-- Replies -->
            <div class="replies">
                <?php renderComments($cmt['id'], $comments) ?>
            </div>
        </details>
<?php
        }
    }
?>

<link rel="stylesheet" href="/../demo/public/assets/css/comments.css">
<script src="/../demo/public/assets/js/comments.js"></script>

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <h1>Comments <i class="fa-solid fa-comments"></i></h1>
        <form action="/demo/comments/store" method="post">
            <textarea 
                class="form-control"
                id="exampleFormControlTextarea1" 
                rows="3"
                placeholder="Add a comment .."
                name="comment"
            ></textarea>
            <br>
            <button type="submit" class="btn btn-success">Add comment</button>
        </form>

        <br>

        <ul>
            <?php
                if (Session::flashHas('errors')) :
                    foreach($errors as $err) :
            ?>
                        <li style="color: red;"><?= $err; ?></li>
            <?php 
                    endforeach;
                endif;
            ?>
        </ul>
        
        <div class="mb-2">
            <a href="/demo/commentmanagement">Comment management <i class="fa-solid fa-gears"></i></a>
        </div>
        <div class="comment-thread">
                <?php renderComments(null, $comments) ?>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php Session::clearFlash(); ?>