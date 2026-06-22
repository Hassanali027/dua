@extends('admin.layouts.app')
@section('content')
<div class="settings-container">
    <div class="header-section" style="margin-bottom: 30px;">
        <h2 class="header-title">Edit Product</h2>
        <p class="header-subtitle">Update product information.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="settings-card">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Product Name <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="e.g. 3 Piece Unstitched Embroidered Lawn Suit" value="{{ old('name', $product->name) }}">
            </div>

            <div class="form-group">
                <label for="price">Price (Rs.) <span style="color: red;">*</span></label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" min="0" required placeholder="e.g. 17990" value="{{ old('price', $product->price) }}">
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label>Categories <span style="color: red;">*</span></label>
                    <div class="custom-dropdown" id="categoryDropdown">
                        <div class="dropdown-selected form-control" onclick="toggleCategoryDropdown()">
                            <span>Select Categories</span>
                            <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        <div class="dropdown-content" id="categoryDropdownContent">
                            @php
                                $selectedCategories = is_array(old('categories')) ? old('categories') : $product->categories->pluck('id')->toArray();
                            @endphp
                            @foreach($categories as $category)
                                <label class="dropdown-item" style="font-weight: 600;">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}> {{ $category->name }}
                                </label>
                                @foreach($category->children as $child)
                                    <label class="dropdown-item" style="padding-left: 30px; font-size: 13px;">
                                        <input type="checkbox" name="categories[]" value="{{ $child->id }}" {{ in_array($child->id, $selectedCategories) ? 'checked' : '' }}> {{ $child->name }}
                                    </label>
                                    @foreach($child->children as $grandchild)
                                        <label class="dropdown-item" style="padding-left: 50px; font-size: 12px; color: #6b7280;">
                                            <input type="checkbox" name="categories[]" value="{{ $grandchild->id }}" {{ in_array($grandchild->id, $selectedCategories) ? 'checked' : '' }}> {{ $grandchild->name }}
                                        </label>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <div style="flex: 1;">
                    <label for="season">Season</label>
                    <input type="text" id="season" name="season" class="form-control" placeholder="e.g. Summer, Festive" value="{{ old('season', $product->season) }}">
                </div>
            </div>

            <div class="form-group" style="display: flex; gap: 20px; align-items: flex-end;">
                <div style="flex: 1;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_on_sale" id="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale) ? 'checked' : '' }} style="width: 16px; height: 16px;">
                        Is Product on Sale?
                    </label>
                </div>
                <div style="flex: 1;">
                    <label for="sale_price">Sale Price (Rs.)</label>
                    <input type="number" id="sale_price" name="sale_price" class="form-control" step="0.01" min="0" placeholder="e.g. 15990" value="{{ old('sale_price', $product->sale_price) }}">
                </div>
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label>Colors</label>
                    @php
                        $selectedColors = explode(',', $product->color ?? '');
                        $selectedColors = array_map('trim', $selectedColors);
                    @endphp
                    <div class="custom-dropdown" id="colorDropdown">
                        <div class="dropdown-selected form-control" onclick="toggleDropdown()">
                            <span>Select Colors</span>
                            <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        <div class="dropdown-content" id="colorDropdownContent">
                            @if(isset($colors) && $colors->count() > 0)
                                @foreach($colors as $color)
                                    <label class="dropdown-item">
                                        <input type="checkbox" name="colors[]" value="{{ $color->name }}" {{ in_array($color->name, $selectedColors) ? 'checked' : '' }}>
                                        {{ $color->name }}
                                    </label>
                                @endforeach
                            @else
                                <p style="padding: 10px; margin: 0; font-size: 13px; color: #6b7280;">No colors available. Add some from the Colors menu first.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div style="flex: 1;">
                    <label>Size</label>
                    @php
                        $selectedSizes = explode(',', $product->size ?? '');
                        $selectedSizes = array_map('trim', $selectedSizes);
                    @endphp
                    <div class="custom-dropdown" id="sizeDropdown">
                        <div class="dropdown-selected form-control" onclick="toggleSizeDropdown()">
                            <span>Select Sizes</span>
                            <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        <div class="dropdown-content" id="sizeDropdownContent">
                            <label class="dropdown-item">
                                <input type="checkbox" name="sizes[]" value="XS" {{ in_array('XS', $selectedSizes) ? 'checked' : '' }}> XS
                            </label>
                            <label class="dropdown-item">
                                <input type="checkbox" name="sizes[]" value="S" {{ in_array('S', $selectedSizes) ? 'checked' : '' }}> S
                            </label>
                            <label class="dropdown-item">
                                <input type="checkbox" name="sizes[]" value="M" {{ in_array('M', $selectedSizes) ? 'checked' : '' }}> M
                            </label>
                            <label class="dropdown-item">
                                <input type="checkbox" name="sizes[]" value="L" {{ in_array('L', $selectedSizes) ? 'checked' : '' }}> L
                            </label>
                            <label class="dropdown-item">
                                <input type="checkbox" name="sizes[]" value="XL" {{ in_array('XL', $selectedSizes) ? 'checked' : '' }}> XL
                            </label>
                        </div>
                    </div>
                </div>
                <div style="flex: 1;">
                    <label for="quantity">Quantity <span style="color: red;">*</span></label>
                    <input type="number" id="quantity" name="quantity" class="form-control" min="0" required value="{{ old('quantity', $product->quantity) }}">
                </div>
            </div>

            <div class="form-group">
                <label for="product_detail">Product Detail (Description)</label>
                <textarea id="product_detail" name="product_detail" class="form-control" rows="4" placeholder="Enter product description here...">{{ old('product_detail', $product->product_detail) }}</textarea>
            </div>

            <div style="margin-top: 30px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="font-size: 18px; color: #1a1a1a;">Homepage Display Settings</h3>
                <p style="font-size: 13px; color: #6b7280; margin-top: 5px;">Select where this product should appear on the home page.</p>
            </div>

            <div class="form-group" style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 150px; margin-bottom: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} style="width: 16px; height: 16px;">
                        Featured
                    </label>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_best_selling" id="is_best_selling" value="1" {{ old('is_best_selling', $product->is_best_selling) ? 'checked' : '' }} style="width: 16px; height: 16px;">
                        Best Selling
                    </label>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_most_in_demand" id="is_most_in_demand" value="1" {{ old('is_most_in_demand', $product->is_most_in_demand) ? 'checked' : '' }} style="width: 16px; height: 16px;">
                        Most In Demand
                    </label>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_new_arrival" id="is_new_arrival" value="1" {{ old('is_new_arrival', $product->is_new_arrival) ? 'checked' : '' }} style="width: 16px; height: 16px;">
                        New Arrival
                    </label>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_bridal_party_wear" id="is_bridal_party_wear" value="1" {{ old('is_bridal_party_wear', $product->is_bridal_party_wear) ? 'checked' : '' }} style="width: 16px; height: 16px;">
                        Bridal & Party Wear
                    </label>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="show_in_navbar" id="show_in_navbar" value="1" {{ old('show_in_navbar', $product->show_in_navbar) ? 'checked' : '' }} style="width: 16px; height: 16px;">
                        Show in Navbar (Mega Menu)
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="related_products">Related Products (Optional)</label>
                <select id="related_products" name="related_products[]" class="form-control select2" multiple="multiple">
                    @foreach($allProducts as $p)
                        <option value="{{ $p->id }}" {{ $product->relatedProducts->contains($p->id) ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
                <small style="color: #6b7280; font-size: 12px; margin-top: 5px; display: block;">Search and select related products. Leave empty to show random products.</small>
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="image_path">Product Main Image</label>
                    @if($product->image_path)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset($product->image_path) }}" alt="Current Image" style="height: 100px; border-radius: 4px;">
                        </div>
                    @endif
                    <input type="file" id="image_path" name="image_path" class="form-control" accept="image/*">
                    <small style="color: #6b7280; font-size: 12px; margin-top: 5px; display: block;">Leave empty to keep the current image. Recommended format: JPG, PNG, WEBP. Max size: 2MB.</small>
                </div>
                <div style="flex: 1;">
                    <label for="gallery_images">Product Gallery Images</label>
                    @if($product->images && $product->images->count() > 0)
                        <div style="margin-bottom: 10px; display: flex; gap: 10px; flex-wrap: wrap;" id="gallery-container">
                            @foreach($product->images as $img)
                                <div class="gallery-image-wrapper" id="gallery-img-{{ $img->id }}" style="position: relative; display: inline-block;">
                                    <img src="{{ asset($img->image_path) }}" alt="Gallery Image" style="height: 100px; border-radius: 4px; object-fit: cover;">
                                    <button type="button" onclick="deleteGalleryImage({{ $img->id }})" style="position: absolute; top: 5px; right: 5px; background: rgba(220, 38, 38, 0.9); color: white; border: none; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2);" title="Delete Image">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" id="gallery_images" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                    <small style="color: #6b7280; font-size: 12px; margin-top: 5px; display: block;">Select multiple images to add to the gallery.</small>
                </div>
            </div>

            <div style="margin-top: 30px; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="font-size: 18px; color: #1a1a1a;">Accordion Sections (Optional)</h3>
                <p style="font-size: 13px; color: #6b7280; margin-top: 5px;">Leave empty to use the default standard text for these sections.</p>
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="product_details">Product Details (Accordion)</label>
                    <textarea id="product_details" name="product_details" class="form-control" rows="3" placeholder="Custom product details...">{{ old('product_details', $product->product_details) }}</textarea>
                </div>
                <div style="flex: 1;">
                    <label for="product_care">Product Care (Accordion)</label>
                    <textarea id="product_care" name="product_care" class="form-control" rows="3" placeholder="Custom product care instructions...">{{ old('product_care', $product->product_care) }}</textarea>
                </div>
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="shipping">Shipping (Accordion)</label>
                    <textarea id="shipping" name="shipping" class="form-control" rows="3" placeholder="Custom shipping details...">{{ old('shipping', $product->shipping) }}</textarea>
                </div>
                <div style="flex: 1;">
                    <label for="return_exchange">Return & Exchange (Accordion)</label>
                    <textarea id="return_exchange" name="return_exchange" class="form-control" rows="3" placeholder="Custom return & exchange policy...">{{ old('return_exchange', $product->return_exchange) }}</textarea>
                </div>
            </div>

            <div class="form-actions" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary" style="margin-left: 10px; text-decoration: none; display: inline-block;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .settings-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .header-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 5px;
    }
    .header-subtitle {
        color: #6b7280;
        font-size: 14px;
    }
    .settings-card {
        background: #fff;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s;
        font-family: 'Poppins', sans-serif;
    }
    .form-control:focus {
        outline: none;
        border-color: #1a1a1a;
        box-shadow: 0 0 0 2px rgba(26, 26, 26, 0.1);
    }
    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        border: none;
        transition: all 0.2s;
    }
    .btn-primary {
        background-color: #1a1a1a;
        color: #fff;
    }
    .btn-primary:hover {
        background-color: #000;
    }
    .btn-secondary {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    .btn-secondary:hover {
        background-color: #e5e7eb;
    }
    .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .alert-danger {
        background-color: #fde8e8;
        color: #9b1c1c;
        border: 1px solid #f8b4b4;
    }
    .custom-dropdown {
        position: relative;
        width: 100%;
    }
    .dropdown-selected {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        background-color: #fff;
    }
    .dropdown-arrow {
        width: 16px;
        height: 16px;
        transition: transform 0.2s;
    }
    .custom-dropdown.open .dropdown-arrow {
        transform: rotate(180deg);
    }
    .dropdown-content {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        border: 1px solid #d1d5db;
        border-top: none;
        border-radius: 0 0 6px 6px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 10;
        display: none;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .custom-dropdown.open .dropdown-content {
        display: block;
    }
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        cursor: pointer;
        font-weight: normal;
        margin: 0;
        transition: background-color 0.2s;
    }
    .dropdown-item:hover {
        background-color: #f3f4f6;
    }
    .dropdown-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        min-height: 42px;
        padding: 5px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #002e4d;
        color: white;
        border: none;
        border-radius: 3px;
        padding: 4px 8px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white;
        margin-right: 5px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #ff4d4d;
        background: transparent;
    }
</style>
@endsection

<script>
    function toggleCategoryDropdown() {
        document.getElementById('categoryDropdown').classList.toggle('open');
        document.getElementById('colorDropdown').classList.remove('open');
        document.getElementById('sizeDropdown').classList.remove('open');
    }

    function toggleDropdown() {
        document.getElementById('colorDropdown').classList.toggle('open');
        document.getElementById('sizeDropdown').classList.remove('open');
        if(document.getElementById('categoryDropdown')) document.getElementById('categoryDropdown').classList.remove('open');
    }
    
    function toggleSizeDropdown() {
        document.getElementById('sizeDropdown').classList.toggle('open');
        document.getElementById('colorDropdown').classList.remove('open');
        if(document.getElementById('categoryDropdown')) document.getElementById('categoryDropdown').classList.remove('open');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        var colorDropdown = document.getElementById('colorDropdown');
        var sizeDropdown = document.getElementById('sizeDropdown');
        var categoryDropdown = document.getElementById('categoryDropdown');
        
        if (colorDropdown && !colorDropdown.contains(event.target)) {
            colorDropdown.classList.remove('open');
        }
        if (sizeDropdown && !sizeDropdown.contains(event.target)) {
            sizeDropdown.classList.remove('open');
        }
        if (categoryDropdown && !categoryDropdown.contains(event.target)) {
            categoryDropdown.classList.remove('open');
        }
    });

    // Update selected text when checkboxes change for Colors
    document.addEventListener('DOMContentLoaded', function() {
        var colorCheckboxes = document.querySelectorAll('#colorDropdownContent input[type="checkbox"]');
        var colorSelectedText = document.querySelector('#colorDropdown .dropdown-selected span');
        
        function updateColorText() {
            var selected = [];
            colorCheckboxes.forEach(function(cb) {
                if (cb.checked) selected.push(cb.value);
            });
            if (selected.length > 0) {
                colorSelectedText.textContent = selected.join(', ');
            } else {
                colorSelectedText.textContent = 'Select Colors';
            }
        }
        
        colorCheckboxes.forEach(function(cb) {
            cb.addEventListener('change', updateColorText);
        });
        
        // Initial update
        updateColorText();
        
        // Update selected text when checkboxes change for Sizes
        var sizeCheckboxes = document.querySelectorAll('#sizeDropdownContent input[type="checkbox"]');
        var sizeSelectedText = document.querySelector('#sizeDropdown .dropdown-selected span');
        
        function updateSizeText() {
            var selected = [];
            sizeCheckboxes.forEach(function(cb) {
                if (cb.checked) selected.push(cb.value);
            });
            if (selected.length > 0) {
                sizeSelectedText.textContent = selected.join(', ');
            } else {
                sizeSelectedText.textContent = 'Select Sizes';
            }
        }
        
        sizeCheckboxes.forEach(function(cb) {
            cb.addEventListener('change', updateSizeText);
        });
        
        // Initial update
        updateSizeText();

        // Update selected text when checkboxes change for Categories
        var categoryCheckboxes = document.querySelectorAll('#categoryDropdownContent input[type="checkbox"]');
        var categorySelectedText = document.querySelector('#categoryDropdown .dropdown-selected span');
        
        function updateCategoryText() {
            var selected = [];
            categoryCheckboxes.forEach(function(cb) {
                if (cb.checked) {
                    selected.push(cb.parentElement.textContent.trim());
                }
            });
            if (selected.length > 0) {
                categorySelectedText.textContent = selected.join(', ');
            } else {
                categorySelectedText.textContent = 'Select Categories';
            }
        }
        
        categoryCheckboxes.forEach(function(cb) {
            cb.addEventListener('change', updateCategoryText);
        });
        
        // Initial update
        updateCategoryText();
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Search for related products...",
            allowClear: true,
            width: '100%'
        });
    });

    function deleteGalleryImage(id) {
        if(confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: '/admin/product/image/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if(response.success) {
                        $('#gallery-img-' + id).remove();
                    }
                },
                error: function(err) {
                    alert('Error deleting image.');
                }
            });
        }
    }
</script>
