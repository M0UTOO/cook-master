//MAKE DIVS CLICKABLE
const div = document.querySelector("#clickable-div");

div7.addEventListener("click", function() {
    let url = this.getAttribute("data-href");
    if (url) {
        window.location.href = url;
    }
});

const div8 = document.querySelector("#clickable-div8");
