@extends('admin.layouts.app')

@section('styles')
<style>
    .settings-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .settings-header h2 {
        font-size: 24px;
        color: #1a1a1a;
        margin: 0;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }
    .settings-card {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 30px;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .card-header h3 {
        font-size: 18px;
        color: #1a1a1a;
        margin: 0;
    }
    .btn-add {
        background: #1a1a1a;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-add:hover {
        background: #333;
    }
    .card-desc {
        font-size: 14px;
        color: #888;
        margin-bottom: 20px;
    }
    .link-row {
        display: flex;
        gap: 15px;
        align-items: center;
        background: #f9f9f9;
        padding: 15px;
        border-radius: 6px;
        border: 1px solid #eee;
        margin-bottom: 15px;
    }
    .input-group {
        flex: 1;
    }
    .input-group label {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
        font-weight: 500;
    }
    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }
    .input-group input:focus {
        border-color: #1a1a1a;
        outline: none;
    }
    .btn-remove {
        background: none;
        border: none;
        color: #dc3545;
        font-size: 18px;
        cursor: pointer;
        padding: 10px 5px 0 5px;
        font-weight: bold;
    }
    .btn-remove:hover {
        color: #a71d2a;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
    }
    .btn-save {
        background: #28a745;
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-save:hover {
        background: #218838;
    }
</style>
@endsection

@section('content')
<div class="settings-container">
    <div class="settings-header">
        <h2>Navbar Settings</h2>
        <button type="button" onclick="document.getElementById('navbar-form').submit()" class="btn-save" style="padding: 8px 20px; font-size: 14px;">Save Settings</button>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form id="navbar-form" action="{{ route('admin.navbar.update') }}" method="POST">
        @csrf

        <!-- Top Links Section -->
        <div class="settings-card">
            <div class="card-header">
                <h3>Main Navigation Links (Navbar)</h3>
                <button type="button" onclick="addTopLink()" class="btn-add">
                    + Add Link
                </button>
            </div>
            <p class="card-desc">These links appear horizontally in the center of the main header (e.g., Bridal, Kids, Stitched).</p>

            <div id="top-links-container">
                @foreach($topLinks as $index => $link)
                <div class="link-row">
                    <div class="input-group">
                        <label>Label</label>
                        <input type="text" name="top_links[{{ $index }}][label]" value="{{ $link['label'] ?? '' }}" required>
                    </div>
                    <div class="input-group">
                        <label>URL</label>
                        <input type="text" name="top_links[{{ $index }}][url]" value="{{ $link['url'] ?? '#' }}" required>
                    </div>
                    <div>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="btn-remove">&times;</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>



        <div class="form-actions">
            <button type="submit" class="btn-save">
                Save Navbar Settings
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let topLinkCount = {{ count($topLinks) }};

    function addTopLink() {
        const container = document.getElementById('top-links-container');
        const html = `
            <div class="link-row">
                <div class="input-group">
                    <label>Label</label>
                    <input type="text" name="top_links[${topLinkCount}][label]" value="" required>
                </div>
                <div class="input-group">
                    <label>URL</label>
                    <input type="text" name="top_links[${topLinkCount}][url]" value="#" required>
                </div>
                <div>
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="btn-remove">&times;</button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        topLinkCount++;
    }


</script>
@endsection
