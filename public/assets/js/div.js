//MAKE DIVS CLICKABLE
const div = document.querySelector("#clickable-div");

div.addEventListener("click", function() {
    let url = this.getAttribute("data-href");
    if (url) {
        window.location.href = url;
    }
});