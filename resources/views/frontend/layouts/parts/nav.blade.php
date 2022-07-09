<div class="header-bottom-area ltn__border-top ltn__header-sticky  ltn__sticky-bg-white--- ltn__sticky-bg-secondary ltn__secondary-bg section-bg-1 menu-color-white d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col header-menu-column justify-content-center">
                <div class="sticky-logo">
                    <div class="site-logo">
                        <a href="index.html"><img src="{{asset('assets/img/logo-3.png')}}" alt="Logo"></a>
                    </div>
                </div>
                <div class="header-menu header-menu-2">
                    <nav>
                        <div class="ltn__main-menu">
                            <ul>
                                <li class="{{ Route::is('index') ? 'active' : '' }}"><a href="{{route('index')}}">Home</a>
                                    
                                </li>
                                <li class="{{ Route::is('about') ? 'active' : '' }}"><a href="{{route('about')}}">About</a>
                                    
                                </li>
                                <li class="{{ Route::is('shop') ? 'active' : '' }}"><a href="{{route('shop')}}">Shop</a>
                                    
                                </li>
                                <li ><a href="#">FAQ</a></li>
                                
                                <li class="{{ Route::is('contact') ? 'active' : '' }}"><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>