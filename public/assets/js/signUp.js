function selectSubscription(id, price){

    if (price === 0) {
        //SUBSCRIPTION IS FREE : NO NEED TO CHECKOUT
        document.getElementById('sign-up-subscription-input').value = id;
        console.log("free");
    } else {
        if (id > 0) {
            window.location.href = '/checkout?subscription=' + id;
       }
    }

}
