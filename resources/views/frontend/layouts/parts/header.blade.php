<header class="ltn__header-area ltn__header-3">       
    <!-- ltn__header-top-area start -->
    <div class="ltn__header-top-area border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="ltn__top-bar-menu">
                        <ul>
                            <li><a href="mailto:info@webmail.com?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i> info@webmail.com</a></li>
                            <li><a href="locations.html"><i class="icon-placeholder"></i> Thanlyin Yangon</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="top-bar-right text-right text-end">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                
                                <li>
                                    <!-- ltn__social-media -->
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                            
                                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-top-area end --> 
    <!-- ltn__header-middle-area start -->
    <div class="ltn__header-middle-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="site-logo">
                        <a href="index.html"><img src="{{asset('assets/img/logo.png')}}" alt="Logo"></a>
                    </div>
                </div>
                <div class="col header-contact-serarch-column d-none d-lg-block">
                    <div class="header-contact-search">
                        <!-- header-feature-item -->
                        <div class="header-feature-item">
                            <div class="header-feature-icon">
                                <i class="icon-call"></i>
                            </div>
                            <div class="header-feature-info">
                                <h6>Phone</h6>
                                <p><a href="tel:0123456789">09 955525053</a></p>
                            </div>
                        </div>
                        <!-- header-search-2 -->
                        <div class="header-search-2">
                            <form id="#123" method="get"  action="#">
                                <input type="text" name="search" value="" placeholder="Search here..."/>
                                <button type="submit">
                                    <span><i class="icon-search"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- header-options -->
                    <div class="ltn__header-options">
                        <ul>
                            
                            <li class="d-lg-none">
                                <!-- header-search-1 -->
                                <div class="header-search-wrap">
                                    <div class="header-search-1">
                                        <div class="search-icon">
                                            <i class="icon-search  for-search-show"></i>
                                            <i class="icon-cancel  for-search-close"></i>
                                        </div>
                                    </div>
                                    <div class="header-search-1-form">
                                        <form id="#" method="get"  action="#">
                                            <input type="text" name="search" value="" placeholder="Search here..."/>
                                            <button type="submit">
                                                <span><i class="icon-search"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="d-none---"> 
                                <!-- user-menu -->
                                <div class="ltn__drop-menu user-menu">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon-user"></i></a>
                                            <ul>
                                                
                                                @guest
                                                <li><a href="{{route('login')}}">Sign in</a></li>
                                                <li><a href="{{route('register')}}">Register</a></li>
                                                <li><a href="{{route('my.account')}}">My Account</a></li>
                                                @endguest
                                                @auth
                                                <li><a href="{{route('my.account')}}">{{Auth::user()->name}}</a></li>
                                                <li><a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                                                {{-- logout form --}}
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                </form>
                                                {{-- end logout form --}}
                                                @endauth
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <!-- mini-cart 2 -->
                                <div class="mini-cart-icon mini-cart-icon-2">
                                    <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">

                                        @php $total = 0 @endphp

                                        @foreach((array) session('cart') as $id => $details)
                
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                
                                        @endforeach

                                        <span class="mini-cart-icon">
                                            <i class="icon-shopping-cart"></i>
                                            <sup>{{ count((array) session('cart')) }}</sup>
                                        </span>
                                        <h6><span>Your Cart</span> <span class="ltn__secondary-color">{{ $total }} {{currency()->code}}</span></h6>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-middle-area end -->
    
    <!-- Side Nav START -->
    @include('frontend.layouts.parts.nav')
    <!-- Side Nav END -->
</header>

