@include('includes.header')
<style>
.signin-container {
    width: 100%;
    min-height: 70vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
    padding: 60px 20px;
    font-family: 'Poppins', sans-serif;
}
.signin-box {
    width: 100%;
    max-width: 450px;
    text-align: center;
}
.signin-box h1 {
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
.forget-password {
    text-align: right;
    margin-top: -15px;
    margin-bottom: 30px;
}
.forget-password a {
    color: #4a90e2;
    font-size: 12px;
    text-decoration: none;
}
.login-btn {
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
    transition: background-color 0.3s;
}
.login-btn:hover {
    background-color: #ceb5a3;
}
.signup-link {
    font-size: 12px;
    color: #555;
    margin-bottom: 30px;
}
.signup-link a {
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

<div class="signin-container">
    <div class="signin-box">
        <h1>Sign-in</h1>
        
        @if($errors->any())
            <div style="background-color: #fde8e8; color: #9b1c1c; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" id="signinForm">
            @csrf
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div class="signup-link">
            Don't have an account? <a href="{{ route('signup') }}">Signup Here</a>
        </div>
    </div>
</div>

<script>
    // JS removed since password toggle is no longer needed
</script>

@include('includes.footer')
