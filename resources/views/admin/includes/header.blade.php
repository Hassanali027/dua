<style>
    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .header-search {
        position: relative;
    }
    .header-search input {
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 8px 15px 8px 35px;
        font-size: 13px;
        outline: none;
        width: 250px;
        transition: border-color 0.3s;
    }
    .header-search input:focus {
        border-color: #1a1a1a;
    }
    .header-search svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        width: 16px;
    }
    .header-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }
    .profile-img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #dcc6b6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-weight: 600;
    }
    .profile-name {
        font-size: 14px;
        font-weight: 500;
        color: #333;
    }
</style>

<div class="admin-header">
    <div class="header-title">Overview</div>
    
    <div class="header-right">
        <div class="header-search">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Search anything...">
        </div>
        
        <div class="header-profile" style="position: relative;" onclick="document.getElementById('profile-dropdown').style.display = document.getElementById('profile-dropdown').style.display === 'block' ? 'none' : 'block'">
            <div class="profile-img">{{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}</div>
            <div class="profile-name">{{ Auth::user()->name ?? 'Admin' }}</div>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 14px; height: 14px; margin-left: 5px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            
            <div id="profile-dropdown" style="display: none; position: absolute; top: 50px; right: 0; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 8px; width: 180px; z-index: 100;">
                <a href="{{ route('admin.password.form') }}" style="display: block; padding: 12px 20px; color: #333; text-decoration: none; font-size: 14px; border-bottom: 1px solid #eee;">Change Password</a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="display: block; width: 100%; text-align: left; padding: 12px 20px; color: #dc2626; background: none; border: none; cursor: pointer; font-size: 14px; font-family: inherit;">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        var profile = document.querySelector('.header-profile');
        var dropdown = document.getElementById('profile-dropdown');
        if (profile && !profile.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>
