//MAKE TABLE ROWS CLICKABLE
window.onload = function() {
    let rows = document.getElementsByTagName("tr");
    for (let i = 0; i < rows.length; i++) {
        rows[i].addEventListener("click", function() {
            let url = this.getAttribute("data-href");
            if (url) {
                window.location.href = url;
            }
        });
    }
};