<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div class="container mt-5">
            <h2>Make Payment</h2>
            @if(session('status'))
                <div class="alert alert-success mt-3">{{ session('status') }}</div>
            @endif
            <form action="{{ route('transaction.store') }}" method="post" id="transaction-form">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="user_id">User ID:</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount" step="1" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="payment_method">Payment Gateway:</label>
                            <div id="payment-method"></div>
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            let stripePublicKey = "{{ config('cashier.key') }}";
        </script>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ asset('js/payment.js') }}"></script>
    </body>
</html>
