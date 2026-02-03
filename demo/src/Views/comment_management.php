<?php include('includes/header.php'); ?>

<?php
    use App\Core\Session;
?>

<link rel="stylesheet" href="/../demo/public/assets/css/comment_management.css">
<script src="/../demo/public/assets/js/comment_management.js"></script>

<div class="dark-mode"></div>
<div class="edit_form_container"></div>

<div class="container mt-5">
    <div class="col-md-10 mx-auto">

        <a href="/demo/comments">Go back to comments page <i class="fa-solid fa-comments"></i></a>

        <form action="/demo/commentmanagement/search" method="post">
            <div class="wrapper mt-3 mb-3">
                <div class="inpWrapper">
                    <i class="fa-solid fa-magnifying-glass-arrow-right searchIcon"></i>
                    <input type="search"
                         name="search_inp" 
                         class="searchInp" 
                         placeholder="Author .." 
                         value="<?= old('search_inp') ?>"
                    >
                    <input type="date" name="date" id="date" value="<?= old('date') ?>">
                    <button class="btn" type="submit">Sort</button>
                    <button class="btn" type="button" onclick="location.href = '/demo/commentmanagement'">Reset</button>
                </div>
            </div>
        </form>

        <form action="/demo/commentmanagement/delete" method="post" id="comment_management">
            <small>&bull; Keep in mind if you delete a comment with replies, all the replies of this comment will be deleted too</small>
            <table>
                <th>Select</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Posted at</th>
                <th>Edit</th>

                <?php
                    foreach($comments as $cmt) :
                ?>
                        <tr>
                            <td>
                                <div class="checkbox-wrapper-31">
                                    <input type="checkbox" name="comment_id_<?= $cmt['id'] ?>" value="<?= $cmt['id']; ?>"/>
                                    <svg viewBox="0 0 35.6 35.6">
                                        <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                        <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                        <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                                    </svg>
                                </div>
                            </td>

                            <td><div class="author"><?= htmlspecialchars($cmt['username']); ?></div></td>

                            <td><div class="comment"><?= htmlspecialchars($cmt['comment']); ?></div></td>

                            <td><div class="posted_at"><?= $cmt['created_at']; ?></div></td>

                            <td><button type="button" value="<?= $cmt['id']; ?>" class="edit_cmt_link popup">Edit Comment</button></td>
                        </tr>
                <?php
                    endforeach;
                ?>
            </table>
        </form>

        <div class="buttons mt-3">
            <button class="selectAll_btn">Select All</button>
            <button form="comment_management" type="submit">Delete Selected</button>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php Session::clearFlash() ?>