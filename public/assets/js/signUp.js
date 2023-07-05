let submitButton = document.getElementById('submit_btn');
let form = document.getElementById('signUp-form');
submitButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission
    console.log('submit button clicked');
    checkInputs()
    setCookies()
    form.submit()

});


function setCookies() {
    let expirationDate = new Date();
    expirationDate.setTime(expirationDate.getTime() + (15 * 60 * 1000)); // Set expiration to 15 minutes in milliseconds

    let email = document.getElementById('sign-up-email-input').value;
    document.cookie = "email=" + encodeURIComponent(email) + "; expires=" + expirationDate.toUTCString();

    let firstName = document.getElementById('sign-up-firstname').value;
    document.cookie = "firstName=" + encodeURIComponent(firstName) + "; expires=" + expirationDate.toUTCString();

    let lastName = document.getElementById('sign-up-lastname').value;
    document.cookie = "lastName=" + encodeURIComponent(lastName) + "; expires=" + expirationDate.toUTCString();

    let country = document.getElementById('sign-up-country').value;
    document.cookie = "country=" + encodeURIComponent(country) + "; expires=" + expirationDate.toUTCString();

}
function checkInputs() {
    let password = document.getElementById('sign-up-password-input').value;

    if (password.length < 8) {
        //TODO: MAKE INPUT BORDER RED
        document.getElementById('sign-up-password-input').style.borderColor = "red";
        console.log('password too short');
    }

}