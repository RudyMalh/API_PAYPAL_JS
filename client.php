<!DOCTYPE html>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div id="paypal-button"></div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>
  paypal.Button.render({
    env: 'sandbox', // sandbox | production
    client: {
      sandbox:    '',//Client ID Sandbox
      production: ''//client ID Live
    },

    // Show the buyer a 'Pay Now' button in the checkout flow
    commit: true,

    payment: function(data, actions) {
      // Make a call to the REST api to create the payment
      return actions.payment.create({
          payment: {
              transactions: [
                  {
                      amount: { total: '0.50', currency: 'EUR' }
                  }
              ]
          }
      });
    },

    // onAuthorize() is called when the buyer approves the payment
    onAuthorize: function(data, actions) {

        // Make a call to the REST api to execute the payment
        return actions.payment.execute().then(function() {
            window.alert('Payment Complete!');
        });
    }
  }, '#paypal-button');
</script>
</body>