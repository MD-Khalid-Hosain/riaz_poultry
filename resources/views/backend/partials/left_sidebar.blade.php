<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{ url('/') }}" target="#"><span class="m-l-10">Usha Poultry Feed</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="">@if ( Auth::guard('admin')->user()->image !=null ) <img src="{{ asset('backend/uploads/admin') }}/{{ Auth::guard('admin')->user()->image }}" alt="{{ Auth::guard('admin')->user()->name }}"> @else <img src="{{ asset('backend/uploads/admin/default_photo.jpg') }}" alt="Default Image"> @endif</a>
                    <div class="detail">
                        <h4>{{ ucwords(auth('admin')->user()->name) }}</h4>
                        <small>{{ ucwords(auth('admin')->user()->type) }}</small>
                    </div>
                </div>
            <li class="@yield('dashboard_active')"><a class="@yield('dashboard_toggled')"href="{{ route('dashboard.index') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            @if(auth('admin')->user()->can('assign role'))
            <li class="@yield('role_management_active')"><a href="javascript:void(0);" class="menu-toggle @yield('role_create_toggled')"><i class="zmdi zmdi-settings"></i><span>Role Management</span></a>
                <ul class="ml-menu">
                    <li class="@yield('role_create_active')"><a class="@yield('role_create_toggled')" href="{{ route('management.index') }}">Create Role</a></li>
                    <li class="@yield('assign_role_active')"><a class="@yield('assign_role_toggled')" href="{{ route('management.user') }}">Assign Role to User</a></li>

                </ul>
            </li>
            @endif
            <li class="@yield('admin_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('update_details_toggled')"><i class="zmdi zmdi-account"></i><span>Admin Profile</span></a>
                <ul class="ml-menu">
                    <li class="@yield('update_details_active')"><a class="@yield('update_details_toggled')" href="{{ url('/admin/update-details') }}">Update Details</a></li>
                    <li class="@yield('change_pwd_active')"><a class="@yield('change_pwd_toggled')" href="{{ route('admin-settings') }}">Change Password</a></li>
                </ul>
            </li>
            <li class="@yield('vendor_active')"><a class="@yield('vendor_toggled')"href="{{ route('vendors.index') }}"><i class="zmdi zmdi-shopping-basket"></i><span>Vendors</span></a></li>
            <li class="@yield('feed_product_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('feed_product_toggled')"><i class="zmdi zmdi-collection-item"></i><span>Products</span></a>
                <ul class="ml-menu">
                    <li class="@yield('feed_product_active')"><a class="@yield('feed_product_toggled')" href="{{route('feed-products.index')}}">All Products</a></li>
                    <li class="@yield('purchase_active')"><a class="@yield('purchase_toggled')" href="{{route('product-purchase.index')}}">Product Purchase</a></li>
                </ul>
            </li>
            <li class="@yield('customer_active')"><a class=" menu-toggle@yield('customer_toggled')"href="{{ route('customer.index') }}"><i class="zmdi zmdi-account-box-o"></i><span>Customer</span></a></li>
            <li class="@yield('customer_due_active')"><a class=" menu-toggle@yield('customer_due_toggled')"href="{{route('customer-money-collection')}}"><i class="zmdi zmdi-money"></i><span>Collect Money</span></a></li>
            <li class="@yield('customer_order_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('customer_order_toggled')"><i class="zmdi zmdi-collection-pdf"></i><span>Customer Orders</span></a>
                <ul class="ml-menu">
                    <li class="@yield('customer_order_active')"><a class="@yield('customer_order_toggled')" href="{{route('customer-order-list')}}">All Orders</a></li>
                    <li class="@yield('customer_order_report_active')"><a class="@yield('customer_order_report_toggled')" href="{{ route('order.search') }}">Order Report</a></li>
                    <li class="@yield('customer_due_report_active')"><a class="@yield('customer_due_report_toggled')" href="{{ route('due-collection.search') }}">Collection Report</a></li>
                </ul>
            </li>
            <li class="@yield('section_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('section_toggled')"><i class="zmdi zmdi-account"></i><span>Brand</span></a>
                <ul class="ml-menu">
                    <li class="@yield('brand_active')"><a class="@yield('brand_toggled')" href="{{ url('/admin/brands') }}">Create Brand</a></li>
                </ul>
            </li>


        </ul>
    </div>
</aside>





