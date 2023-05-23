//BURGER MENU TOGGLE
document.getElementById('menu-icon').addEventListener('click', toggleMenu);

function toggleMenu() {
    //get body and add class overflow-y-hidden when on mobile ?
    // to check if mobile or not add a special class to elements when on mobile !
    document.getElementById('burger-menu').classList.toggle('d-none');
}