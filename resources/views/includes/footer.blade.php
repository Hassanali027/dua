<style>
    /* Newsletter CTA */
    .newsletter-wrapper {
        background-color: #fff;
        padding: 40px 20px 0 20px;
        display: flex;
        justify-content: center;
    }
    .newsletter-box {
        background-color: #F7F7F7;
        width: 100%;
        max-width: 1200px;
        padding: 30px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        box-sizing: border-box;
    }
    .newsletter-text h3 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 5px 0;
        color: #000;
    }
    .newsletter-text p {
        font-size: 14px;
        color: #555;
        margin: 0;
    }
    .newsletter-form {
        display: flex;
        gap: 10px;
        flex: 1;
        max-width: 500px;
        justify-content: flex-end;
    }
    .newsletter-form input {
        padding: 12px 15px;
        border: 1px solid #ddd;
        flex: 1;
        outline: none;
        font-size: 14px;
    }
    .newsletter-form button {
        padding: 12px 30px;
        background-color: #e6d7c8;
        border: none;
        font-weight: 700;
        color: #000;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .newsletter-form button:hover {
        background-color: #d4c3b3;
    }

    /* Footer */
    .site-footer {
        background-color: #F5EDE2;
        padding: 60px 40px 20px 40px;
        color: #333;
        font-size: 14px;
    }
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
    }
    .footer-logo {
        font-size: 32px;
        font-weight: 900;
        color: #000;
        margin-bottom: 20px;
        display: inline-block;
        text-decoration: none;
    }
    .footer-col p {
        line-height: 1.6;
        margin-bottom: 20px;
        color: #000;
    }
    .footer-socials {
        display: flex;
        gap: 10px;
    }
    .social-icon {
        width: 36px;
        height: 36px;
        background-color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .social-icon:hover {
        background-color: #eee;
    }
    .footer-col h4 {
        font-size: 16px;
        font-weight: 800;
        color: #000;
        margin-bottom: 25px;
    }
    .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-col ul li {
        margin-bottom: 15px;
    }
    .footer-col ul li a {
        text-decoration: none;
        color: #000;
        transition: color 0.3s;
    }
    .footer-col ul li a:hover {
        color: #000;
    }
    
    .footer-contact-info {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .footer-bottom {
        max-width: 1200px;
        margin: 0 auto;
        border-top: 1px solid #e6dcc6;
        padding-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .footer-copyright {
        color: #555;
    }
    .footer-payments {
        display: flex;
        gap: 10px;
    }
    .payment-icon {
        height: 24px;
        background-color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 992px) {
        .footer-container {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (max-width: 576px) {
        .footer-container {
            grid-template-columns: 1fr;
        }
        .newsletter-box {
            padding: 20px;
        }
        .newsletter-form {
            width: 100%;
            max-width: 100%;
            justify-content: flex-start;
            flex-direction: column;
        }
        .newsletter-form input {
            box-sizing: border-box;
            width: 100%;
        }
        .newsletter-form button {
            width: 100%;
        }
        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<!-- Newsletter CTA -->
<div class="newsletter-wrapper">
    <div class="newsletter-box">
        <div class="newsletter-text">
            <h3>Join our newsletter</h3>
            <p>We'll send you updates once per week.</p>
        </div>
        <div class="newsletter-form">
            <input type="email" placeholder="Enter your email">
            <button type="button">Subscribe</button>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-col">
            <a href="#" class="footer-logo"><img src="{{ asset('images/dua-mehrama-logo.png') }}" alt="Dua Mehrama" style="max-width: 200px; height: auto; display: block;"></a>
            <p>{!! nl2br(e(\App\Models\Setting::get('footer_text', "We have clothes that suits your\nstyle and which you're proud to\nwear. From girl to boy."))) !!}</p>
            <div class="footer-socials">
                @if(\App\Models\Setting::get('footer_twitter', '#') != '#')
                <a href="{{ \App\Models\Setting::get('footer_twitter') }}" class="social-icon" target="_blank">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                </a>
                @endif
                @if(\App\Models\Setting::get('footer_facebook', '#') != '#')
                <a href="{{ \App\Models\Setting::get('footer_facebook') }}" class="social-icon" target="_blank">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                </a>
                @endif
                @if(\App\Models\Setting::get('footer_instagram', '#') != '#')
                <a href="{{ \App\Models\Setting::get('footer_instagram') }}" class="social-icon" target="_blank">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                @endif
                @if(\App\Models\Setting::get('footer_github', '#') != '#')
                <a href="{{ \App\Models\Setting::get('footer_github') }}" class="social-icon" target="_blank">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
                @endif
            </div>
        </div>
        
        <div class="footer-col">
            <h4>Customer Care</h4>
            <ul>
                <li><a href="{{ route('aboutus') }}">About</a></li>
                <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                
                <li><a href="{{ route('faqs') }}">FAQ's</a></li>
                <li><a href="{{ route('blog') }}">Blogs</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Information</h4>
            <ul>
                <li><a href="{{ route('return.policy') }}">Return & Exchange</a></li>
                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('shipping.policy') }}">Shipping Policy</a></li>
                <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Get In Touch</h4>
            <div class="footer-contact-info">
                <span>{{ \App\Models\Setting::get('footer_address', 'Plot # 126, Al Noor Industrial Estate 20-KM Ferozpur Road, Asif Town, Lahore') }}</span>
                <span>{{ \App\Models\Setting::get('footer_email', 'Customercare@example.com.pk') }}</span>
                <span>{{ \App\Models\Setting::get('footer_phone', '042-35140496') }}</span>
                <span>{{ \App\Models\Setting::get('footer_timing', 'Mon - Sat / 10AM - 6PM') }}</span>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="footer-copyright">
            Dua Mehrama &copy; 2026, All Rights Reserved
        </div>
        <div class="footer-payments">
            <img src="{{ asset('images/footer-cards.png') }}" alt="Payment Methods" style="height: 30px; object-fit: contain;">
        </div>
    </div>
</footer>
