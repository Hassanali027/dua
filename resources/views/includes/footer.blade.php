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
                @if(\App\Models\Setting::get('footer_tiktok', '#') != '#')
                <a href="{{ \App\Models\Setting::get('footer_tiktok') }}" class="social-icon" target="_blank">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.014 3.91-.02.08 1.536.63 3.093 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                </a>
                @endif
                @if(\App\Models\Setting::get('footer_pinterest', '#') != '#')
                <a href="{{ \App\Models\Setting::get('footer_pinterest') }}" class="social-icon" target="_blank">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.951-7.252 4.168 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.367 18.592 0 12.017 0z"/></svg>
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
