document.addEventListener("DOMContentLoaded", function () {
    const selectAllBtn = document.querySelector(".selectAll_btn");
    const checkboxes = document.querySelectorAll("input[type='checkbox']");

    checkboxes.forEach(box => {
        box.addEventListener("change", e => {
            const row = e.target.closest("tr");
            row.classList.toggle("is-selected", e.target.checked);
        });
    });

    selectAllBtn.addEventListener("click", () => {
        checkboxes.forEach(box => {
            box.checked = true;
            box.closest("tr").classList.add("is-selected");
        });
    });

    const editButtons = document.querySelectorAll('.edit_cmt_link');
    const darkMode = document.querySelector(".dark-mode");
    var edit_form_container = document.querySelector(".edit_form_container");

    window.addEventListener("click", (e) => {
        if (!e.target.classList.contains("popup")) {
            $(edit_form_container).empty();
            $(darkMode).css({'display' : 'none'});
            $(edit_form_container).css({'display' : 'none'});
        }
    })

    editButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            darkMode.style.display = "block";

            var html = `
            <form class="edit_form_from popup" action="/demo/public/commentmanagement/update" method="post">
                <input type="hidden" name="comment_id" value="${btn.value}" />
                <textarea class="popup" name='updated_comment'>${btn.closest("tr").querySelector(".comment").innerHTML}</textarea>
                <button type="submit" class="popup">Update Comment</button>
            </form>
            `

            $(edit_form_container).append(html);
            $(edit_form_container).css({'display' : 'block'});
        })
    })
});