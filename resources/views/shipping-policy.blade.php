@include('includes.header')
<style>
/* ── Policy Page ── */
.policy-container { width:100%; overflow-x:hidden; background-color: #faf9f7; padding: 60px 20px; }
.policy-page { max-width: 900px; margin: 0 auto; background: #fff; padding: 40px 50px; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.04); color: #000; }
.policy-title { font-size: 32px; font-weight: 800; color: #000; margin-bottom: 30px; text-align: center; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; }
.policy-content h2 { font-size: 22px; font-weight: 700; color: #000; margin-top: 30px; margin-bottom: 15px; }
.policy-content h3 { font-size: 18px; font-weight: 600; color: #000; margin-top: 20px; margin-bottom: 10px; }
.policy-content p { font-size: 15px; color: #000; line-height: 1.7; margin-bottom: 15px; }
.policy-content ul, .policy-content ol { margin-left: 20px; margin-bottom: 15px; color: #000; font-size: 15px; line-height: 1.7; }
.policy-content li { margin-bottom: 8px; }
.policy-content strong { color: #000; font-weight: 700; }
.policy-alert { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px 20px; margin-bottom: 20px; border-radius: 4px; }
.policy-alert p { margin: 0; color: #000; font-weight: 600; }

@media (max-width: 768px) {
    .policy-page { padding: 30px 20px; }
    .policy-title { font-size: 26px; }
}
</style>

<div class="policy-container">
    <div class="policy-page">
        <h1 class="policy-title">Shipping Policy – Dua Mehrama</h1>
        
        <div class="policy-content">
            <p>At <strong>Dua Mehrama</strong>, we strive to deliver your orders safely and efficiently. Please review our shipping policy before placing an order.</p>

            <h2>Shipment & Delivery</h2>
            <p>The delivery timeframe may vary depending on the product, order volume, and delivery location.</p>
            <p>For estimated delivery times, please refer to the specific product page on our website. If you have any questions regarding the status or expected delivery of your order, you may contact our customer support team through the available contact methods on our website.</p>

            <h3>Estimated Delivery Time</h3>
            <ul>
                <li><strong>Pakistan:</strong> 3–7 business days</li>
                <li><strong>International Orders:</strong> 7–15 business days (may vary by destination)</li>
            </ul>
            <p>Please note that delivery times are estimates and may be affected by public holidays, weather conditions, customs clearance procedures, courier delays, or other circumstances beyond our control.</p>

            <h2>Shipping Charges</h2>
            <p>Shipping charges are calculated based on:</p>
            <ul>
                <li>Delivery location</li>
                <li>Order weight and size</li>
                <li>Shipping method selected</li>
            </ul>
            <p>Applicable shipping charges will be displayed at checkout before order confirmation.</p>
            <p>Please note that shipping charges are non-refundable once an order has been dispatched.</p>

            <h2>International Orders</h2>
            <p>For international shipments:</p>
            <ul>
                <li>Customers are responsible for any customs duties, import taxes, VAT, clearance fees, or other charges imposed by their local authorities.</li>
                <li>Such charges are not included in the product price or shipping fee unless explicitly stated.</li>
                <li>Dua Mehrama is not responsible for delays caused by customs inspections or clearance procedures.</li>
                <li>If a shipment is refused or abandoned due to unpaid customs duties or taxes, any additional costs incurred may be deducted from any eligible refund.</li>
            </ul>

            <h2>Order Tracking</h2>
            <p>Once your order has been dispatched, you may receive a tracking number via email, SMS, or WhatsApp (where applicable) to monitor the progress of your shipment.</p>

            <h2>Incorrect Shipping Information</h2>
            <p>Customers are responsible for providing accurate shipping details at the time of purchase.</p>
            <p>Dua Mehrama shall not be liable for delays, failed deliveries, or additional charges resulting from incorrect or incomplete shipping information provided by the customer.</p>

            <h2>Delivery Delays</h2>
            <p>While we make every effort to deliver orders within the estimated timeframe, Dua Mehrama shall not be held responsible for delays caused by:</p>
            <ul>
                <li>Courier service disruptions</li>
                <li>Weather conditions</li>
                <li>Public holidays</li>
                <li>Customs clearance procedures</li>
                <li>Government restrictions</li>
                <li>Other events beyond our reasonable control</li>
            </ul>

            <h2>Policy Updates</h2>
            <p>Dua Mehrama reserves the right to modify or update this Shipping Policy at any time without prior notice. Any changes will become effective immediately upon publication on the website.</p>
        </div>
    </div>
</div>
@include('includes.footer')
