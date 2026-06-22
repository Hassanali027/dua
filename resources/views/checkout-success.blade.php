<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Dua Mehrama</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .success-box {
            background: #fff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .success-box svg {
            width: 80px;
            height: 80px;
            color: #10b981;
            margin-bottom: 20px;
        }
        .success-box h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 10px 0;
            color: #111827;
        }
        .success-box p {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn-home {
            display: inline-block;
            background: #000;
            color: #fff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        .btn-home:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="success-box">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for shopping with Dua Mehrama. Your order has been placed via Cash on Delivery and is currently being processed. We will contact you soon for confirmation.</p>
        
        <a href="{{ route('allcategories') }}" class="btn-home">Continue Shopping</a>
    </div>

</body>
</html>
