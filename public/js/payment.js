const stripe = Stripe(stripePublicKey);
const elements = stripe.elements();

const card = elements.create('card', {
    hidePostalCode: true,
});

card.mount('#payment-method');


card.addEventListener('change', function(event) {
    const displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
const form = document.getElementById('transaction-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe
        .createPaymentMethod({
            type: 'card',
            card: card,
        })
        .then(result => {
            if (result.error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                const paymentMethodInput = document.createElement('input');
                paymentMethodInput.setAttribute('type', 'hidden');
                paymentMethodInput.setAttribute('name', 'payment_method');
                paymentMethodInput.setAttribute('value', result.paymentMethod.id);
                form.appendChild(paymentMethodInput);

                const amountInput = document.createElement('input');
                amountInput.setAttribute('type', 'hidden');
                amountInput.setAttribute('name', 'amount');
                amountInput.setAttribute('value', form.querySelector('input[name="amount"]').value);
                form.appendChild(amountInput);

                form.submit();
            }
        });
});
