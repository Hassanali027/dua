<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Dua Mehrama</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }
        .checkout-container {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
        }
        .left-col {
            flex: 60%;
            padding: 40px 5% 40px 10%;
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            min-width: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: flex-end;
        }
        .left-col-inner {
            width: 100%;
            max-width: 650px;
        }
        .right-col {
            flex: 40%;
            padding: 40px 10% 40px 5%;
            background-color: #fafafa;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            box-sizing: border-box;
        }
        .right-col-inner {
            width: 100%;
            max-width: 450px;
        }
        @media(max-width: 800px) {
            .checkout-container {
                flex-direction: column-reverse;
            }
            .left-col, .right-col {
                flex: none;
                width: 100%;
                position: static;
                height: auto;
                max-height: none;
                padding: 30px;
                display: block;
            }
            .left-col-inner, .right-col-inner {
                max-width: 100%;
                margin: 0 auto;
            }
        }

        .header-logo {
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            color: #000;
            margin-bottom: 30px;
            display: block;
        }

        .form-section {
            margin-bottom: 30px;
        }
        .form-section h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
            background-color: #fff;
        }
        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23131313%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 15px top 50%;
            background-size: 10px auto;
            padding-right: 40px;
        }
        input:focus, select:focus {
            border-color: #000;
            box-shadow: 0 0 0 1px #000;
        }

        .payment-box {
            border: 1px solid #d1d5db;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .payment-option {
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            background: #fff;
        }
        .payment-option:not(:last-child) {
            border-bottom: 1px solid #d1d5db;
        }
        .payment-option.active {
            background: #f8f9fa;
            border: 1px solid #0058a3;
            margin: -1px;
            position: relative;
            z-index: 1;
        }
        .payment-option label {
            flex: 1;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            color: #333;
        }
        .payment-details {
            display: none;
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #d1d5db;
        }
        .payment-option.active + .payment-details {
            display: block;
        }

        .submit-btn {
            width: 100%;
            background-color: #000;
            color: #fff;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .submit-btn:hover {
            opacity: 0.9;
        }
        .submit-btn:disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
        }

        /* Right Col Styles */
        .cart-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        .item-img-wrap {
            position: relative;
            width: 65px;
            height: 65px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .item-img-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }
        .item-qty {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #727272;
            color: #fff;
            font-size: 12px;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .item-info {
            flex: 1;
        }
        .item-title {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin: 0 0 5px 0;
        }
        .item-variant {
            font-size: 12px;
            color: #6b7280;
        }
        .item-price {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #4b5563;
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            align-items: center;
        }
        .summary-total span small {
            font-size: 12px;
            font-weight: 400;
            color: #6b7280;
            margin-right: 5px;
        }

        .error-msg {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="checkout-container">
    <!-- Left Column (Form) -->
    <div class="left-col">
        <div class="left-col-inner">
            <a href="{{ route('home') }}" class="header-logo">DUA MEHRAMA</a>

            @if(session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 4px; margin-bottom: 20px; font-size: 14px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
            @csrf
            
            <div class="form-section">
                <h2>Contact Information</h2>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                    @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-section">
                <h2>Delivery Address</h2>
                <div class="form-group">
                    <select name="country">
                        <option value="Pakistan">Pakistan</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First name" required value="{{ old('first_name') }}">
                        @error('first_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last name" required value="{{ old('last_name') }}">
                        @error('last_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="address" placeholder="Address" required value="{{ old('address') }}">
                    @error('address') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <select name="city" required>
                            <option value="" disabled selected>Select Delivery City</option>
                            <option value="Karachi" {{ old('city') == 'Karachi' ? 'selected' : '' }}>Karachi</option>
                            <option value="Lahore" {{ old('city') == 'Lahore' ? 'selected' : '' }}>Lahore</option>
                            <option value="Islamabad" {{ old('city') == 'Islamabad' ? 'selected' : '' }}>Islamabad</option>
                            <option value="Rawalpindi" {{ old('city') == 'Rawalpindi' ? 'selected' : '' }}>Rawalpindi</option>
                            <option value="Faisalabad" {{ old('city') == 'Faisalabad' ? 'selected' : '' }}>Faisalabad</option>
                            <option value="Multan" {{ old('city') == 'Multan' ? 'selected' : '' }}>Multan</option>
                            <option value="Peshawar" {{ old('city') == 'Peshawar' ? 'selected' : '' }}>Peshawar</option>
                            <option value="Quetta" {{ old('city') == 'Quetta' ? 'selected' : '' }}>Quetta</option>
                            <option value="Sialkot" {{ old('city') == 'Sialkot' ? 'selected' : '' }}>Sialkot</option>
                            <option value="Gujranwala" {{ old('city') == 'Gujranwala' ? 'selected' : '' }}>Gujranwala</option>
                            <option value="Other" {{ old('city') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('city') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="postal_code" placeholder="Postal code (optional)" value="{{ old('postal_code') }}">
                    </div>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" placeholder="Phone" required value="{{ old('phone') }}">
                    @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-section">
                <h2>Payment</h2>
                <p style="font-size: 13px; color: #6b7280; margin-top: -10px; margin-bottom: 15px;">All transactions are secure and encrypted.</p>
                
                <div class="payment-box">
                    <label class="payment-option active" id="opt-cod">
                        <input type="radio" name="payment_method" value="COD" checked onchange="togglePayment('COD')">
                        <span>Cash on Delivery (COD)</span>
                    </label>

                    <label class="payment-option" id="opt-card">
                        <input type="radio" name="payment_method" value="CARD" onchange="togglePayment('CARD')">
                        <span>Credit / Debit Card</span>
                        <div style="display: flex; gap: 5px;">
                            <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa" height="24" style="background:#fff; border: 1px solid #e5e7eb; border-radius: 4px; padding: 2px;">
                            <img src="https://cdn.shopify.com/s/assets/payment_icons/master-173035bc8124581983d4efa50cf8626e8553c2b311353fbf67485f9c1a2b88d1.svg" alt="Mastercard" height="24">
                        </div>
                    </label>
                    <!-- Card Details Drawer -->
                    <div class="payment-details" id="card-details">
                        <div style="background: #fff; padding: 15px; border: 1px solid #e5e7eb; border-radius: 4px; text-align: center;">
                            <svg style="margin-bottom: 10px; color: #9ca3af;" width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            <p style="font-size: 13px; color: #4b5563; margin: 0;">Card payments are currently disabled. Please select Cash on Delivery.</p>
                        </div>
                    </div>
                </div>
            <div class="form-section">
                <h2>Billing address</h2>
                <div class="payment-box">
                    <label class="payment-option active" id="opt-billing-same">
                        <input type="radio" name="billing_address_type" value="same" checked onchange="toggleBilling('same')">
                        <span>Same as shipping address</span>
                    </label>

                    <label class="payment-option" id="opt-billing-diff">
                        <input type="radio" name="billing_address_type" value="different" onchange="toggleBilling('different')">
                        <span>Use a different billing address</span>
                    </label>
                    
                    <div class="payment-details" id="billing-details" style="padding: 15px;">
                        <div class="form-row" style="margin-bottom: 10px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <input type="text" name="billing_first_name" placeholder="First name" value="{{ old('billing_first_name') }}">
                                @error('billing_first_name') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <input type="text" name="billing_last_name" placeholder="Last name" value="{{ old('billing_last_name') }}">
                                @error('billing_last_name') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <input type="text" name="billing_address" placeholder="Address" value="{{ old('billing_address') }}">
                            @error('billing_address') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-row" style="margin-bottom: 10px;">
                            <div class="form-group" style="margin-bottom:0;">
                                <input type="text" name="billing_city" placeholder="City" value="{{ old('billing_city') }}">
                                @error('billing_city') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <input type="text" name="billing_postal_code" placeholder="Postal code (optional)" value="{{ old('billing_postal_code') }}">
                                @error('billing_postal_code') <div class="error-msg">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <input type="tel" name="billing_phone" placeholder="Phone" value="{{ old('billing_phone') }}">
                            @error('billing_phone') <div class="error-msg">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">Complete order</button>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('cart') }}" style="color: #000; text-decoration: none; font-size: 14px;">Return to cart</a>
            </div>
        </form>
        </div> <!-- End left-col-inner -->
    </div>

    <!-- Right Column (Summary) -->
    <div class="right-col">
        <div class="right-col-inner">
            <div style="margin-bottom: 30px;">
                @foreach($cart as $item)
            <div class="cart-item">
                <div class="item-img-wrap">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                    <span class="item-qty">{{ $item['quantity'] }}</span>
                </div>
                <div class="item-info">
                    <p class="item-title">{{ $item['name'] }}</p>
                    <p class="item-variant">Size: {{ $item['size'] }}</p>
                </div>
                <div class="item-price">
                    Rs {{ number_format($item['price'] * $item['quantity']) }}
                </div>
            </div>
            @endforeach
        </div>

        <div style="border-top: 1px solid #e5e7eb; padding-top: 20px;">
            <div class="summary-row">
                <span>Subtotal</span>
                <span style="font-weight: 500; color: #111827;">Rs {{ number_format($subtotal) }}</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span style="font-size: 12px; color: #6b7280;">Enter shipping address</span>
            </div>
            
            <div class="summary-total">
                <span>Total</span>
                <span><small>PKR</small> Rs {{ number_format($total) }}</span>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePayment(method) {
        const btn = document.getElementById('submitBtn');
        const optCod = document.getElementById('opt-cod');
        const optCard = document.getElementById('opt-card');
        const cardDetails = document.getElementById('card-details');

        if (method === 'CARD') {
            optCard.classList.add('active');
            optCod.classList.remove('active');
            btn.disabled = true;
            btn.innerText = 'Card Payments Disabled';
        } else {
            optCod.classList.add('active');
            optCard.classList.remove('active');
            btn.disabled = false;
            btn.innerText = 'Complete order';
        }
    }

    function toggleBilling(type) {
        const optSame = document.getElementById('opt-billing-same');
        const optDiff = document.getElementById('opt-billing-diff');
        
        if (type === 'different') {
            optDiff.classList.add('active');
            optSame.classList.remove('active');
        } else {
            optSame.classList.add('active');
            optDiff.classList.remove('active');
        }
    }
</script>

</body>
</html>
