// First validation and then send the request to the server

function test() {
    console.log("ok");
    const baseUrl = 'http://localhost:9000';
    const request = new XMLHttpRequest();

    // let userForm = document.getElementById('user-form');
    // let data = new FormData(userForm);
    // let value = Object.fromEntries(data.entries())
    // let JSON_OBJECT =  JSON.stringify(data);
    // console.log(value);
    //
    // request.open('POST', baseUrl + '/user/email', true);
    // request.setRequestHeader('Token', 'UGE8Bb8rwpnMgWWtYVTkbmoqJ2Ci5tg5OpkaD6N31yKN2cLEAonykflvBv3n')
    //
    // request.onreadystatechange = function(){
    //
    //     if (request.readyState == 4){
    //         console.log(request.responseText);
    //     }
    // }
    // request.send(data);
}
