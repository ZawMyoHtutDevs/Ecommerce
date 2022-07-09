@extends('frontend.layouts.app')
@section('breadcrumb')
<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('assets/img/bg/14.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Checkout</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('index')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->
@endsection
@section('content')
<!-- WISHLIST AREA START -->
<div class="ltn__checkout-area mb-105">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__checkout-inner">
                    @guest
                    <div class="ltn__checkout-single-content ltn__returning-customer-wrap">
                        <h5>Returning customer? <a class="ltn__secondary-color" href="{{route('login')}}">Click here to login</a></h5>
                        
                    </div>

                    <div class="ltn__checkout-single-content mt-50">
                        <h4 class="title-2">Billing Details</h4>
                        <div class="ltn__checkout-single-content-info">
                            <form action="#" >
                                <h6>Personal Information</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" name="name" placeholder="Your Name">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="input-item input-item-email ltn__custom-icon">
                                            <input type="email" name="email" placeholder="email address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-phone ltn__custom-icon">
                                            <input type="text" name="phone" placeholder="phone number">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <h6>Country</h6>
                                        <div class="input-item">
                                            <select class="nice-select" name="country">
                                                <option>Select Country</option>
                                                <option>Australia</option>
                                                <option>Canada</option>
                                                <option>China</option>
                                                <option>Morocco</option>
                                                <option>Saudi Arabia</option>
                                                <option>United Kingdom (UK)</option>
                                                <option>United States (US)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <h6>Town / City</h6>
                                        <div class="input-item">
                                            <input type="text" name="city" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <h6>Address</h6>
                                        <div class="input-item">
                                            <input type="text" name="address" placeholder="House number and street name">
                                        </div>
                                    </div>
                                    
                                </div>
                                <h6>Order Notes (optional)</h6>
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>

                            </form>
                        </div>
                    </div>
                    @endguest
                    
                    @auth
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="title-2">Your Information</h4>

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{Auth::user()->name}}</h4>
                                    <p class="card-text mb-0"><strong>Phone</strong> - {{Auth::user()->phone ?? 'No Data'}}</p>
                                    <p class="card-text mb-0"><strong>Email</strong> - {{Auth::user()->email ?? 'No Data'}}</p>
                                    <p class="card-text mb-0"><strong>Description</strong> - {{Auth::user()->description ?? 'No Data'}}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h4 class="title-2">Address</h4>

                            <div class="row">
                                @foreach (Auth::user()->addresses as $item)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="product-badge">
                                                <ul>
                                                    <li class="sale-badge">{{$item->address_type}}</li>
                                                </ul>
                                            </div>
                                            <h4 class="card-title mt-5">{{$item->name}}</h4>
                                            <p class="card-text mb-0"><strong>{{$item->country}}</strong>, {{$item->city}}</p>
                                            <p class="card-text mb-0">{{$item->address}} </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="ltn__checkout-single-content mt-50">
                        <h4 class="title-2">Details</h4>
                        <div class="ltn__checkout-single-content-info">
                            <form action="#" >
                                <div class="row">
                                    
                                    <div class="col-lg-6 col-md-6">
                                        <h6>Select Address</h6>
                                        <div class="input-item">
                                            <select class="nice-select" name="address_id">
                                                @foreach (Auth::user()->addresses as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <h6>Order Notes (optional)</h6>
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>

                            </form>
                        </div>
                    </div>
                    @endauth
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ltn__checkout-payment-method mt-50">
                    <h4 class="title-2">Payment Method</h4>
                    <div id="checkout_accordion_1">
                        <!-- card -->
                        <div class="card">
                            <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-1" aria-expanded="false">
                                Check payments
                            </h5>
                            <div id="faq-item-2-1" class="collapse" data-bs-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card">
                            <h5 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2" aria-expanded="true"> 
                                Cash on delivery 
                            </h5>
                            <div id="faq-item-2-2" class="collapse show" data-bs-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>
                        </div>                          
                        
                    </div>
                    <div class="ltn__payment-note mt-30 mb-30">
                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                    </div>
                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Place order</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping-cart-total mt-50">
                    <h4 class="title-2">Cart Totals</h4>
                    <table class="table">
                        <tbody>
                            @php $total = 0 @endphp
                                
                                @if(session('cart'))
                                
                                    @foreach(session('cart') as $id => $details)
                                    
                                        
                                        @php 
                                        $product = \App\Models\Product::where(['id' => $id])->first()
                                        @endphp
                                        @if ($product->discount != '')

                                            {{-- Fit Price --}}
                                            @if ($product->discount->status == 'fit price')
                                                <tr>
                                                    <td>{{ $details['name'] }} <strong>× {{$details['quantity']}}</strong></td>
                                                    <td>{{ $product->discount->discount_price * $details['quantity'] }} {{currency()->code}}</td>
                                                </tr>
                                                @php $total += $product->discount->discount_price * $details['quantity'] @endphp
                                            
                                            {{-- percentage Price --}}
                                            @elseif ($product->discount->status == 'percentage price')
                                                <tr>
                                                    <td>{{ $details['name'] }} <strong>× {{$details['quantity']}}</strong></td>
                                                    @php
                                                        $price = $details['price'] - $product->discount->discount_percent / 100;
                                                    @endphp
                                                    <td>{{ $price * $details['quantity'] }} {{currency()->code}}</td>
                                                </tr>
                                                @php $total += $price * $details['quantity'] @endphp
                                            
                                            {{-- Free Gif --}}
                                            @elseif ($product->discount->status == 'free gif')
                                                <tr>
                                                    <td>{{ $details['name'] }} <strong>× {{$details['quantity']}}</strong></td>
                                                    <td>{{ $details['price'] * $details['quantity'] }} {{currency()->code}}</td>
                                                </tr>
                                                @php
                                                     $gif_product = explode(" - ", $product->discount->gif_products_id);
                                                @endphp
                                                @foreach($gif_product as $key => $value)
                                                    @php 
                                                    $gif_product = \App\Models\Product::where(['id' => $value])->first()
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $gif_product->name }} <strong>× 1</strong> Get Gif</td>
                                                        <td>0 {{currency()->code}}</td>
                                                    </tr>
                                                @endforeach
                                                

                                                @php $total += $details['price'] * $details['quantity'] @endphp
                                            
                                            {{-- Free Shipping --}}
                                            @elseif ($product->discount->status == 'free shipping')
                                                @php $total += $details['price'] * $details['quantity'] @endphp
                                                <tr>
                                                    <td>{{ $details['name'] }} <strong>× {{$details['quantity']}}</strong></td>
                                                    <td>{{ $total += $details['price'] * $details['quantity'] }} {{currency()->code}}</td>
                                                </tr>
                                            
                                            {{-- Buy One Get One --}}
                                            @elseif ($product->discount->status == 'buy one get one')
                                                <tr>
                                                    <td>{{ $details['name'] }} <strong>× {{$details['quantity']}}</strong></td>
                                                    <td>{{ $details['price'] * $details['quantity'] }} {{currency()->code}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $details['name'] }} <strong>× {{$details['quantity']}}</strong> Get Free</td>
                                                    <td>{{ 0 * $details['quantity'] }} {{currency()->code}}</td>
                                                </tr>

                                                @php $total += $details['price'] * $details['quantity'] @endphp
                                            @endif
                                        @else
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <tr>
                                            <td>{{ $details['name'] }} <strong>× {{$details['quantity']}}</strong></td>
                                            <td>{{  $details['price'] * $details['quantity'] }} {{currency()->code}}</td>
                                        </tr>
                                        @endif

                                    @endforeach
                                @else
                                <tr>
                                    <td><strong>No Product Selected</strong></td>
                                </tr>
                                @endif
                            
                            
                            <tr>
                                <td><strong>Order Total</strong></td>
                                <td><strong>{{ $total }} {{currency()->code}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- WISHLIST AREA START -->

@endsection
