<main>
    <form id="payment-form">
        <label for="payment-element">Payment details</label>
        <div id="payment-element">
            <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="payment-errors" role="alert"></div>

        <button id="submit" class="btn mt-3 blue-btn">Pay</button>
    </form>

    <div id="messages" role="alert" style="display: none;"></div>
</main>


<!--SCRIPTS STRIPE-->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Helper for displaying status messages.
        const addMessage = (message) => {
            const messagesDiv = document.querySelector('#messages');
            messagesDiv.style.display = 'block';
            const messageWithLinks = addDashboardLinks(message);
            messagesDiv.innerHTML += `> ${messageWithLinks}<br>`;
            console.log(`Debsubscription/payment/ug: ${message}`);
        };

        document.addEventListener('DOMContentLoaded', async () => {
            const stripe = Stripe('<?= env('STRIPE_TEST_PUBLIC_KEY') ?>', {
            });

            const elements = stripe.elements({
                clientSecret: '<?= $clientSecret ?>'
            });
            const paymentElement = elements.create('payment', {layout: "tabs"});
            paymentElement.mount('#payment-element');

            const paymentForm = document.querySelector('#payment-form');
            paymentForm.addEventListener('submit', async (e) => {
                // Avoid a full page POST request.
                e.preventDefault();

                // Disable the form from submitting twice.
                paymentForm.querySelector('button').disabled = true;

                // Confirm the card payment that was created server side:
                const {error} = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: '#'
                        //return_url: `${window.location.origin}/client/subscribe?subscription=` + <?php //= $subscription['idsubscription']?>//,
                    }
                    redirect: 'if_required'
                });
                if(error) {
                    addMessage(error.message);
                    // Re-enable the form so the customer can resubmit.
                   // paymentForm.querySelector('button').disabled = false;
                }
            });
        });
    </script>
