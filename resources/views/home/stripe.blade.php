<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Payment</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #f1f5f9;
            font-family: 'Poppins', sans-serif;
        }
        .payment-card {
            background: #fff;
            border-radius: 14px;
            padding: 30px;
            max-width: 480px;
            margin: 40px auto;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }
        .stripe-element {
            background: white;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        .btn-pay {
            background: #007a12;
            border: none;
            padding: 12px;
            font-size: 17px;
            border-radius: 10px;
            width: 100%;
            color: white;
            font-weight: 600;
        }
        .btn-pay:hover {
            background: #00610e;
        }
    </style>
</head>

<body>

<div class="payment-card">

    <h3 class="text-center fw-bold mb-3">Payment</h3>

    <p class="text-center">
        You need to pay:
        <strong class="text-success">RM {{ $booking_approval->quoted_price }}</strong>
    </p>

    <hr>

    <form id="payment-form" action="{{ route('stripe.post', $booking->id) }}" method="POST">
        @csrf

        <input type="hidden" name="amount" value="{{ $booking_approval->quoted_price }}">

        <label class="fw-semibold mb-2">Card Details</label>
        <div id="card-element" class="stripe-element"></div>

        <div id="card-errors" class="text-danger mt-2"></div>

        <button class="btn-pay mt-4" id="submit-button">
            Pay RM {{ $booking_approval->quoted_price }}
        </button>

    </form>

</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");

    const elements = stripe.elements();
    const cardElement = elements.create("card", {
        hidePostalCode: true
    });

    cardElement.mount("#card-element");

    const form = document.getElementById("payment-form");
    const submitButton = document.getElementById("submit-button");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        submitButton.disabled = true;
        submitButton.textContent = "Processing...";

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: "card",
            card: cardElement,
        });

        if (error) {
            document.getElementById("card-errors").textContent = error.message;
            submitButton.disabled = false;
            submitButton.textContent = "Pay Now";
        } else {
            const hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "payment_method_id");
            hiddenField.setAttribute("value", paymentMethod.id);

            form.appendChild(hiddenField);

            form.submit();
        }
    });
</script>

</body>
</html>
