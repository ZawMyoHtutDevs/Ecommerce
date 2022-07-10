<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a href="{{route('home')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Home</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping-cart"></i>
                    </span>
                    <span class="title">Our Products</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('products.index') ? 'active' : '' }}">
                        <a href="{{ route('products.index')}}">Our Products</a>
                    </li>
                    <li class="{{ Route::is('products.create') ? 'active' : '' }}">
                        <a href="{{ route('products.create')}}">Create New</a>
                    </li>

                    
                </ul>
            </li>

            {{-- Categories --}}
            <li class="nav-item {{ Route::is('categories.*') ? 'active' : '' }}">
                <a class="" href="{{route('categories.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Product Category</span>
                </a>
            </li>
            
            {{-- Discount --}}
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-crown"></i>
                    </span>
                    <span class="title">Discounts</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('discounts.index') ? 'active' : '' }}">
                        <a href="{{ route('discounts.index')}}">Discount List</a>
                    </li>
                    <li class="{{ Route::is('discounts.create') ? 'active' : '' }}">
                        <a href="{{ route('discounts.create')}}">Create New</a>
                    </li>

                    
                </ul>
            </li>
            
            

            {{-- Order --}}
            <li class="nav-item  {{ Route::is('orders.*') ? 'active' : '' }}">
                <a class="" href="{{route('orders.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-database"></i>
                    </span>
                    <span class="title">Orders</span>
                </a>
            </li>

            {{-- Report --}}
            <li class="nav-item  {{ Route::is('report') ? 'active' : '' }}">
                <a class="" href="{{route('report')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-area-chart"></i>
                    </span>
                    <span class="title">Report</span>
                </a>
            </li>

            {{-- Customer --}}
            <li class="nav-item  {{ Route::is('customers.*') ? 'active' : '' }}">
                <a class="" href="{{route('customers.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-user"></i>
                    </span>
                    <span class="title">Customers</span>
                </a>
            </li>

            {{-- Currency --}}
            <li class="nav-item  {{ Route::is('currencies.*') ? 'active' : '' }}">
                <a class="" href="{{route('currencies.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dollar"></i>
                    </span>
                    <span class="title">Currency</span>
                </a>
            </li>

            {{-- Account --}}
            @admin
            <li class="nav-item  {{ Route::is('users') ? 'active' : '' }}">
                <a class="" href="{{route('users')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-team"></i>
                    </span>
                    <span class="title">All Accounts</span>
                </a>
            </li>
            @endadmin

        </ul>
    </div>
</div>