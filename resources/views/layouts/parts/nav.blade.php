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
                        <i class="anticon anticon-smile"></i>
                    </span>
                    <span class="title">Our Products</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                {{-- <ul class="dropdown-menu">
                    <li class="{{ Route::is('products.*') ? 'active' : '' }}">
                        <a href="{{ route('products.index')}}">Our Products</a>
                    </li>
                    <li class="">
                        <a href="{{ route('products.create')}}">Create New</a>
                    </li>

                    <li class="{{ Route::is('categories.*') ? 'active' : '' }}">
                        <a href="{{ route('categories.index')}}">Categories</a>
                    </li>

                    <li class="{{ Route::is('brands.*') ? 'active' : '' }}">
                        <a href="{{ route('brands.index')}}">Brands</a>
                    </li>
                    
                </ul> --}}
            </li>

            {{-- Services --}}
            {{-- <li class="nav-item dropdown">
                <a href="{{route('services.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-flag"></i>
                    </span>
                    <span class="title">Services</span>
                </a>
            </li> --}}
            
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-smile"></i>
                    </span>
                    <span class="title">Our Works</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                {{-- <ul class="dropdown-menu">
                    <li class="{{ Route::is('works.*') ? 'active' : '' }}">
                        <a href="{{ route('works.index')}}">Our Works</a>
                    </li>
                    <li class="">
                        <a href="{{ route('works.create')}}">Create New</a>
                    </li>
                    
                </ul> --}}
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle " href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-contacts"></i>
                    </span>
                    <span class="title">Contact Form</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                {{-- <ul class="dropdown-menu">
                    <li class="{{ Route::is('contacts.*') ? 'active' : '' }}">
                        <a href="{{route('contacts.index')}}">Data List</a>
                    </li>
                    <li class="{{ Route::is('contacts_chart') ? 'active' : '' }}">
                        <a href="{{route('contacts_chart')}}">Data Chart</a>
                    </li>
                </ul> --}}
            </li>

            {{-- Apply --}}
            {{-- <li class="nav-item dropdown">
                <a href="{{route('applies.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-profile"></i>
                    </span>
                    <span class="title">Request Form</span>
                </a>
            </li> --}}


        </ul>
    </div>
</div>