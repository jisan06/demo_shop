After setup project
For checking user profile api, endpoints are
    /users (GET Method)
    /users (POST Method) (Fields: name, email, date_of_birth)
    /users/{id} (GET Method)
    /users/{id} (PUT|PATCH Method)
    /users/{id} (DELETE Method)

For Payment submit go to root url, here will be a payment form, where stripe payment method implemented
in env file give STRIPE_KEY, STRIPE_SECRET for sand box test.
