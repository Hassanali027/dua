@include('includes.header')

<div style="max-width: 1000px; margin: 0 auto; padding: 40px 20px;">
    
    <!-- Breadcrumbs -->
    <div style="font-size: 14px; color: #6b7280; margin-bottom: 30px; display: flex; align-items: center; gap: 8px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a> 
        <span>></span> 
        <span style="color: #111827;">My Account</span>
    </div>

    <!-- Title and Tabs -->
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 20px;">My Account</h1>
        <div style="display: inline-flex; gap: 10px;">
            <button class="account-tab active" onclick="switchTab('profile')" id="tab-profile" style="padding: 10px 25px; border: 1px solid #dcc6b6; background: #dcc6b6; border-radius: 4px; font-weight: 500; cursor: pointer; transition: all 0.2s; color: #000;">Profile</button>
            <button class="account-tab" onclick="switchTab('orders')" id="tab-orders" style="padding: 10px 25px; border: 1px solid #e5e7eb; background: #fff; border-radius: 4px; font-weight: 500; cursor: pointer; transition: all 0.2s; color: #000;">Orders ({{ isset($orders) ? $orders->count() : 0 }})</button>
        </div>
    </div>

    @if(session('success'))
        <div style="background-color: #def7ec; color: #03543f; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; border: 1px solid #84e1bc;">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div style="background-color: #fde8e8; color: #9b1c1c; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; border: 1px solid #f8b4b4;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $nameParts = explode(' ', $user->name, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
    @endphp

    <!-- Profile Tab Content -->
    <div id="content-profile">
        <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px;">Profile</h2>
        
        <!-- Name & Email Card -->
        <div style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 30px; margin-bottom: 20px; position: relative;">
            <div id="display-profile">
                <div style="margin-bottom: 20px;">
                    <p style="font-size: 14px; color: #6b7280; margin: 0 0 5px 0;">Name</p>
                    <p style="font-size: 16px; font-weight: 500; margin: 0;">{{ $user->name }}</p>
                </div>
                <div>
                    <p style="font-size: 14px; color: #6b7280; margin: 0 0 5px 0;">Email</p>
                    <p style="font-size: 16px; font-weight: 500; margin: 0;">{{ $user->email }}</p>
                </div>
                <button onclick="openModal('profile-modal')" style="position: absolute; bottom: 30px; right: 30px; background: #f3f4f6; border: 1px solid #e5e7eb; padding: 6px 12px; border-radius: 4px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                    Add <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
            </div>
        </div>

        <!-- Address Card -->
        <div style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 30px; position: relative;">
            <div id="display-address">
                <h3 style="font-size: 16px; font-weight: 600; margin: 0 0 20px 0;">Address</h3>
                
                <div style="display: grid; grid-template-columns: 100px 1fr; gap: 15px 0; font-size: 14px;">
                    <div style="color: #6b7280;">Name:</div>
                    <div style="font-weight: 500;">{{ $user->name }}</div>
                    
                    <div style="color: #6b7280;">Address:</div>
                    <div style="font-weight: 500;">{{ $user->address ?: '-' }}</div>
                    
                    <div style="color: #6b7280;">Province:</div>
                    <div style="font-weight: 500;">{{ $user->province ?: '-' }}</div>
                    
                    <div style="color: #6b7280;">City:</div>
                    <div style="font-weight: 500;">{{ $user->city ?: '-' }}</div>
                    
                    <div style="color: #6b7280;">Postal Code:</div>
                    <div style="font-weight: 500;">{{ $user->postal_code ?: '-' }}</div>
                    
                    <div style="color: #6b7280;">Phone No:</div>
                    <div style="font-weight: 500;">{{ $user->phone ?: '-' }}</div>
                </div>

                <button onclick="openModal('address-modal')" style="position: absolute; bottom: 30px; right: 30px; background: #f3f4f6; border: 1px solid #e5e7eb; padding: 6px 12px; border-radius: 4px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                    Add <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Orders Tab Content -->
    <div id="content-orders" style="display: none;">
        <div id="order-list-view">
            <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px;">Order History</h2>
            
            <div style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden;">
                @if(isset($orders) && $orders->count() > 0)
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead style="background-color: #f3f4f6; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                            <tr>
                                <th style="padding: 15px 30px;">Order ID</th>
                                <th style="padding: 15px 20px;">Date</th>
                                <th style="padding: 15px 20px;">Total</th>
                                <th style="padding: 15px 20px;">Status</th>
                                <th style="padding: 15px 30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr style="border-top: 1px solid #e5e7eb;">
                                <td style="padding: 20px 30px; color: #4b5563;">#{{ $order->order_number ?? $order->id }}</td>
                                <td style="padding: 20px; color: #4b5563;">{{ $order->created_at->format('j M, Y') }}</td>
                                <td style="padding: 20px; color: #4b5563;">Rs {{ number_format($order->total_amount) }} @if($order->items && $order->items->count() > 0)({{ $order->items->sum('quantity') }} Products)@endif</td>
                                <td style="padding: 20px; color: {{ strtolower($order->status) == 'completed' ? '#10b981' : '#4b5563' }};">{{ ucfirst($order->status) }}</td>
                                <td style="padding: 20px 30px; text-align: right;">
                                    <a href="javascript:void(0)" onclick="showOrderDetail({{ $order->id }})" style="color: #111827; font-weight: 600; text-decoration: none; font-size: 13px;">View Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="padding: 40px; text-align: center; color: #6b7280;">
                        You haven't placed any orders yet.
                    </div>
                @endif
            </div>
        </div>

        @if(isset($orders) && $orders->count() > 0)
            @foreach($orders as $order)
            <div id="order-detail-view-{{ $order->id }}" class="order-detail-view" style="display: none; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: #fff;">
                
                <!-- Header -->
                <div style="padding: 20px 30px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 18px; font-weight: 600; color: #111827;">
                        Order Details <span style="color: #6b7280; font-weight: 400; font-size: 14px;">• {{ $order->created_at->format('F j, Y') }} • {{ $order->items ? $order->items->sum('quantity') : 0 }} Product{{ $order->items && $order->items->sum('quantity') != 1 ? 's' : '' }}</span>
                    </div>
                    <button onclick="hideOrderDetail()" style="background: none; border: none; font-size: 14px; font-weight: 600; color: #111827; cursor: pointer;">Back to List</button>
                </div>

                <!-- Products Table -->
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                    <thead style="background-color: #f3f4f6; color: #6b7280; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                        <tr>
                            <th style="padding: 12px 30px;">Product</th>
                            <th style="padding: 12px 20px;">Price</th>
                            <th style="padding: 12px 20px;">Quantity</th>
                            <th style="padding: 12px 30px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->items)
                            @foreach($order->items as $item)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 20px 30px; display: flex; align-items: center; gap: 15px;">
                                    <img src="{{ optional($item->product)->image_path ? asset(optional($item->product)->image_path) : asset('images/default-product.png') }}" alt="{{ $item->product_name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    <span style="font-weight: 500; color: #374151;">{{ $item->product_name ?? 'Product' }}</span>
                                </td>
                                <td style="padding: 20px; color: #4b5563;">Rs {{ number_format($item->price) }}</td>
                                <td style="padding: 20px; color: #4b5563;">x{{ $item->quantity }}</td>
                                <td style="padding: 20px 30px; font-weight: 500; color: #111827;">Rs {{ number_format($item->price * $item->quantity) }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <!-- Bottom Section -->
                <div style="display: flex; flex-wrap: wrap; padding: 30px; gap: 30px;">
                    <!-- Addresses -->
                    <div style="flex: 2; display: flex; gap: 20px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0;">
                        <!-- Billing -->
                        <div style="flex: 1; padding: 20px; border-right: 1px solid #e5e7eb;">
                            <h4 style="font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px; font-weight: 600;">Billing Address</h4>
                            <div style="font-weight: 500; color: #111827; margin-bottom: 10px; font-size: 15px;">{{ $order->billing_first_name ?? $order->first_name }} {{ $order->billing_last_name ?? $order->last_name }}</div>
                            <div style="color: #6b7280; font-size: 13px; line-height: 1.5; margin-bottom: 15px;">
                                {{ $order->billing_address ?? $order->address }}<br>
                                {{ $order->billing_city ?? $order->city }}@if($order->billing_postal_code || $order->postal_code), {{ $order->billing_postal_code ?? $order->postal_code }}@endif
                            </div>
                            <div style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 2px; font-weight: 600;">Email</div>
                            <div style="color: #111827; font-size: 13px; margin-bottom: 15px;">{{ $order->email }}</div>
                            <div style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 2px; font-weight: 600;">Phone</div>
                            <div style="color: #111827; font-size: 13px;">{{ $order->billing_phone ?? $order->phone }}</div>
                        </div>
                        <!-- Shipping -->
                        <div style="flex: 1; padding: 20px;">
                            <h4 style="font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px; font-weight: 600;">Shipping Address</h4>
                            <div style="font-weight: 500; color: #111827; margin-bottom: 10px; font-size: 15px;">{{ $order->first_name }} {{ $order->last_name }}</div>
                            <div style="color: #6b7280; font-size: 13px; line-height: 1.5; margin-bottom: 15px;">
                                {{ $order->address }}<br>
                                {{ $order->city }}@if($order->postal_code), {{ $order->postal_code }}@endif
                            </div>
                            <div style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 2px; font-weight: 600;">Email</div>
                            <div style="color: #111827; font-size: 13px; margin-bottom: 15px;">{{ $order->email }}</div>
                            <div style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 2px; font-weight: 600;">Phone</div>
                            <div style="color: #111827; font-size: 13px;">{{ $order->phone }}</div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div style="flex: 1; min-width: 250px;">
                        <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                                <div>
                                    <div style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 5px; font-weight: 600;">Order ID:</div>
                                    <div style="font-weight: 500; color: #111827; font-size: 14px;">#{{ $order->order_number ?? $order->id }}</div>
                                </div>
                                <div style="text-align: right; border-left: 1px solid #e5e7eb; padding-left: 15px;">
                                    <div style="font-size: 11px; color: #9ca3af; text-transform: uppercase; margin-bottom: 5px; font-weight: 600;">Payment Method:</div>
                                    <div style="font-weight: 500; color: #111827; font-size: 14px;">{{ ucfirst($order->payment_method ?? 'Cash on Delivery') }}</div>
                                </div>
                            </div>
                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 15px 0;">
                            
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 13px; color: #6b7280;">
                                <span>Subtotal:</span>
                                <span style="font-weight: 500; color: #111827;">Rs {{ number_format($order->subtotal ?? $order->total_amount) }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 13px; color: #6b7280;">
                                <span>Discount:</span>
                                <span style="font-weight: 500; color: #111827;">{{ $order->discount_amount ? '- Rs ' . number_format($order->discount_amount) : '0%' }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 13px; color: #6b7280;">
                                <span>Shipping:</span>
                                <span style="font-weight: 500; color: #111827;">{{ $order->shipping ? 'Rs ' . number_format($order->shipping) : 'Free' }}</span>
                            </div>
                            
                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 15px 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 15px; color: #374151;">Total:</span>
                                <span style="font-size: 18px; font-weight: 700; color: #111827;">Rs {{ number_format($order->total_amount) }}</span>
                            </div>
                        </div>
                        @if(strtolower($order->status) != 'completed' && strtolower($order->status) != 'cancelled')
                        <div style="text-align: right;">
                            <button type="button" onclick="openCancelModal({{ $order->id }})" style="border: 1px solid #ef4444; color: #ef4444; background: none; padding: 10px 20px; border-radius: 4px; font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.2s;">
                                Cancel Order
                            </button>
                        </div>
                        @else
                        <div style="text-align: right; color: #6b7280; font-size: 13px; font-weight: 500;">
                            Status: {{ ucfirst($order->status) }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- Modals -->
    <!-- Profile Modal -->
    <div id="profile-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 25px;">Edit Profile</h2>
            <form action="{{ route('account.profile.update') }}" method="POST">
                @csrf
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <input type="text" name="first_name" value="{{ $firstName }}" placeholder="First Name" required class="modal-input">
                    </div>
                    <div style="flex: 1;">
                        <input type="text" name="last_name" value="{{ $lastName }}" placeholder="Last Name" required class="modal-input">
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="email" name="email" value="{{ $user->email }}" placeholder="Email" required class="modal-input">
                </div>
                <div style="margin-bottom: 30px; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="news-offers" style="width: 16px; height: 16px;">
                    <label for="news-offers" style="font-size: 13px; color: #4b5563;">Email me with news and offers</label>
                </div>
                <div style="display: flex; justify-content: flex-end; align-items: center; gap: 20px;">
                    <button type="button" onclick="closeModal('profile-modal')" style="background: none; border: none; text-decoration: underline; color: #4b5563; cursor: pointer; font-size: 14px; font-weight: 500;">Cancel</button>
                    <button type="submit" style="background: #000; color: white; border: none; padding: 10px 25px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500;">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Address Modal -->
    <div id="address-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content" style="max-width: 600px;">
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 25px;">Add Address</h2>
            <form action="{{ route('account.address.update') }}" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <input type="text" name="country" placeholder="Country" class="modal-input">
                </div>
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <input type="text" name="first_name" value="{{ $firstName }}" placeholder="First Name" required class="modal-input">
                    </div>
                    <div style="flex: 1;">
                        <input type="text" name="last_name" value="{{ $lastName }}" placeholder="Last Name" required class="modal-input">
                    </div>
                </div>
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <input type="text" name="address" value="{{ $user->address }}" placeholder="Address" required class="modal-input">
                    </div>
                    <div style="flex: 1;">
                        <input type="text" name="province" value="{{ $user->province }}" placeholder="Province" required class="modal-input">
                    </div>
                </div>
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <input type="text" name="city" value="{{ $user->city }}" placeholder="City" required class="modal-input">
                    </div>
                    <div style="flex: 1;">
                        <input type="text" name="postal_code" value="{{ $user->postal_code }}" placeholder="Postal Code" class="modal-input">
                    </div>
                </div>
                <div style="margin-bottom: 30px;">
                    <input type="tel" name="phone" value="{{ $user->phone }}" placeholder="Phone Number" required class="modal-input">
                </div>
                <div style="display: flex; justify-content: flex-end; align-items: center; gap: 20px;">
                    <button type="button" onclick="closeModal('address-modal')" style="background: none; border: none; text-decoration: underline; color: #4b5563; cursor: pointer; font-size: 14px; font-weight: 500;">Cancel</button>
                    <button type="submit" style="background: #000; color: white; border: none; padding: 10px 25px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500;">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancel Order Modal -->
    <div id="cancel-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content" style="max-width: 400px; text-align: center; padding: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; margin-bottom: 15px; color: #000;">Cancel Order?</h2>
            <p style="font-size: 14px; color: #4b5563; margin-bottom: 30px; line-height: 1.5;">
                Are you sure you want to cancel this order? This action cannot be undone.
            </p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button type="button" onclick="closeModal('cancel-modal')" style="flex: 1; padding: 12px; border: 1px solid #22c55e; color: #22c55e; background: #fff; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
                    Keep Order
                </button>
                <form id="cancel-order-form" method="POST" style="flex: 1; display: flex;">
                    @csrf
                    <button type="submit" style="flex: 1; padding: 12px; border: 1px solid #ef4444; color: #ef4444; background: #fff; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
                        Cancel Order
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <style>
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .modal-content {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .modal-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .modal-input:focus {
            border-color: #9ca3af;
        }
        .modal-input::placeholder {
            color: #9ca3af;
        }
        .account-tab.active {
            /* Active style is now handled inline and via JS */
        }
    </style>

<script>
    function switchTab(tab) {
        // Reset both tabs to inactive state
        document.getElementById('tab-profile').style.background = '#fff';
        document.getElementById('tab-profile').style.border = '1px solid #e5e7eb';
        
        document.getElementById('tab-orders').style.background = '#fff';
        document.getElementById('tab-orders').style.border = '1px solid #e5e7eb';
        
        document.getElementById('tab-profile').classList.remove('active');
        document.getElementById('tab-orders').classList.remove('active');
        
        // Hide both contents
        document.getElementById('content-profile').style.display = 'none';
        document.getElementById('content-orders').style.display = 'none';
        
        // Set active tab styles
        document.getElementById('tab-' + tab).style.background = '#dcc6b6';
        document.getElementById('tab-' + tab).style.border = '1px solid #dcc6b6';
        document.getElementById('tab-' + tab).classList.add('active');
        
        // Show active content
        document.getElementById('content-' + tab).style.display = 'block';
    }

    function showOrderDetail(orderId) {
        document.getElementById('order-list-view').style.display = 'none';
        
        // Hide all details
        const detailViews = document.getElementsByClassName('order-detail-view');
        for (let i = 0; i < detailViews.length; i++) {
            detailViews[i].style.display = 'none';
        }
        
        // Show specific detail
        document.getElementById('order-detail-view-' + orderId).style.display = 'block';
    }

    function hideOrderDetail() {
        // Hide all details
        const detailViews = document.getElementsByClassName('order-detail-view');
        for (let i = 0; i < detailViews.length; i++) {
            detailViews[i].style.display = 'none';
        }
        
        document.getElementById('order-list-view').style.display = 'block';
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    function openCancelModal(orderId) {
        // Set the form action dynamically based on order ID
        const form = document.getElementById('cancel-order-form');
        form.action = "{{ url('/account/orders') }}/" + orderId + "/cancel";
        openModal('cancel-modal');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = "none";
        }
    }
</script>

@include('includes.footer')
