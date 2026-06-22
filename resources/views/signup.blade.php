@include('includes.header')
<style>
.signup-container {
    width: 100%;
    min-height: 70vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
    padding: 60px 20px;
    font-family: 'Poppins', sans-serif;
}
.signup-box {
    width: 100%;
    max-width: 450px;
    text-align: center;
}
.signup-box h1 {
    font-size: 24px;
    font-weight: 700;
    color: #000;
    margin-bottom: 40px;
}
.input-group {
    margin-bottom: 25px;
    text-align: left;
}
.input-group input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
    font-size: 13px;
    color: #333;
    outline: none;
    background: transparent;
    transition: border-color 0.3s;
}
.input-group input::placeholder {
    color: #aaa;
}
.input-group input:focus {
    border-bottom-color: #000;
}
.signup-btn {
    width: 100%;
    padding: 14px;
    background-color: #dcc6b6;
    color: #000;
    font-weight: 700;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-bottom: 25px;
    margin-top: 10px;
    transition: background-color 0.3s;
}
.signup-btn:hover {
    background-color: #ceb5a3;
}
.login-link {
    font-size: 12px;
    color: #555;
    margin-bottom: 30px;
}
.login-link a {
    color: #4a90e2;
    text-decoration: none;
}
.or-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #888;
    font-size: 14px;
    margin-bottom: 30px;
}
.or-divider::before, .or-divider::after {
    content: "";
    flex: 1;
    height: 1px;
    background: #e0e0e0;
    margin: 0 15px;
}
.social-login {
    display: flex;
    gap: 15px;
}
.social-btn {
    flex: 1;
    padding: 12px;
    background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 6px;
    font-size: 11px;
    color: #555;
    cursor: pointer;
    transition: background 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.social-btn:hover {
    background: #f9f9f9;
}
</style>

<div class="signup-container">
    <div class="signup-box">
        <h1>Create Account</h1>
        
        @if($errors->any())
            <div style="background-color: #fde8e8; color: #9b1c1c; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" id="signupForm" onsubmit="return validateSignup()">
            @csrf
            <div class="input-group">
                <input type="text" name="name" id="name" placeholder="Full Name" required minlength="3">
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-group" style="position: relative;">
                <input type="password" name="password" id="password" placeholder="Password" required minlength="8">
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password', this)" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #666; padding: 5px; outline: none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </div>
            <div class="input-group" style="position: relative;">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required minlength="8">
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password_confirmation', this)" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #666; padding: 5px; outline: none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </div>
            <div id="signupError" style="color: red; font-size: 12px; text-align: left; margin-bottom: 15px; display: none;">Passwords do not match.</div>
            
            <button type="submit" class="signup-btn">Create Account</button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="{{ route('signin') }}">Login</a>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('.eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    }

    function validateSignup() {
        const pwd = document.getElementById('password').value;
        const confirmPwd = document.getElementById('password_confirmation').value;
        const errorDiv = document.getElementById('signupError');
        
        if (pwd !== confirmPwd) {
            errorDiv.style.display = 'block';
            return false;
        }
        errorDiv.style.display = 'none';
        return true;
    }
</script>

@include('includes.footer')
