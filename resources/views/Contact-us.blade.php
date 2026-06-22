@include('includes.header')

<style>
    .contact-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }
    .contact-breadcrumb {
        font-size: 14px;
        color: #555;
        margin-bottom: 50px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .contact-breadcrumb a {
        color: #555;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .contact-header {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 60px;
    }
    .contact-title {
        font-size: 36px;
        font-weight: 700;
        color: #000;
        margin-bottom: 20px;
    }
    .contact-subtitle {
        font-size: 14px;
        color: #000;
        line-height: 1.6;
    }
    
    .contact-content {
        display: flex;
        justify-content: space-between;
        gap: 60px;
    }
    
    .contact-info {
        flex: 1;
        max-width: 400px;
        padding-top: 20px;
    }
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 40px;
    }
    .info-icon {
        margin-top: 5px;
        color: #000;
    }
    .info-details h3 {
        font-size: 18px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
    }
    .info-details p {
        font-size: 14px;
        color: #000;
        line-height: 1.6;
        margin: 0;
    }
    
    .contact-form-section {
        flex: 1.2;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #000;
        margin-bottom: 10px;
    }
    .form-control {
        width: 100%;
        padding: 16px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        color: #000;
    }
    .form-control::placeholder {
        color: #aaa;
    }
    textarea.form-control {
        height: 120px;
        resize: vertical;
    }
    .btn-submit {
        background: #e2d1c3;
        color: #000;
        border: none;
        padding: 16px 40px;
        font-size: 15px;
        font-weight: 700;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        max-width: 250px;
        transition: background 0.2s;
    }
    .btn-submit:hover {
        background: #d6c3b3;
    }
    
    @media (max-width: 768px) {
        .contact-content {
            flex-direction: column;
        }
        .contact-info {
            max-width: 100%;
            margin-bottom: 30px;
        }
        .btn-submit {
            max-width: 100%;
        }
    }
</style>

<div class="contact-container">
    <div class="contact-breadcrumb">
        <a href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            Home
        </a>
        <span>&rsaquo;</span>
        <span>Contact Us</span>
    </div>

    <div class="contact-header">
        <h1 class="contact-title">Get In Touch With Us</h1>
        <p class="contact-subtitle">For more information about our product & services. please feel free to drop us an email. Our staff always be there to help you out. do not hesitate!</p>
    </div>

    <div class="contact-content">
        <div class="contact-info">
            <div class="info-item">
                <div class="info-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <div class="info-details">
                    <h3>Address</h3>
                    <p>{!! \App\Models\Setting::get('footer_address', '9933 Franklin Ave,<br>Franklin Park, IL 60131') !!}</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </div>
                <div class="info-details">
                    <h3>Phone</h3>
                    <p>{!! \App\Models\Setting::get('footer_phone', 'Mobile: +(84) 546-6789<br>Hotline: +(84) 456-6789') !!}</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div class="info-details">
                    <h3>Working Time</h3>
                    <p>{!! \App\Models\Setting::get('footer_timing', 'Monday-Friday: 9:00 - 22:00<br>Saturday-Sunday: 9:00 - 21:00') !!}</p>
                </div>
            </div>
        </div>
        
        <div class="contact-form-section">
            <form action="#">
                <div class="form-group">
                    <label for="name">Your name</label>
                    <input type="text" id="name" class="form-control" placeholder="Abc">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" class="form-control" placeholder="Abc@def.com">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" class="form-control" placeholder="This is an optional">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" class="form-control" placeholder="Hi! I'd like to ask about"></textarea>
                </div>
                <button type="button" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>
</div>

@include('includes.footer')
