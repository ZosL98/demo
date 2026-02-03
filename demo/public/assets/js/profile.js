document.addEventListener("DOMContentLoaded", function() {
    var fileInput = document.querySelector("#file");
    var img = document.querySelector("#img");

    img.addEventListener("click", function() {
        fileInput.click();
    })

    fileInput.addEventListener("change", function() {
        const file = this.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(e) {
            img.src = e.target.result;
        };

        reader.readAsDataURL(file);
    })

})