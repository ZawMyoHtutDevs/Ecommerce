@extends('frontend.layouts.app')
@section('breadcrumb')
<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('assets/img/bg/14.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">{{$product->name}}</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('index')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Product</li>
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

<!-- SHOP DETAILS AREA START -->
<div class="ltn__shop-details-area pb-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="ltn__shop-details-inner mb-60">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="ltn__shop-details-img-gallery">
                                <div class="ltn__shop-details-large-img">
                                    <div class="single-large-img">
                                        <a href="{{ url('images/products/'.$product->asset) }}" data-rel="lightcase:myCollection">
                                            <img src="{{ url('images/products/'.$product->asset) }}" alt="{{$product->name}}">
                                        </a>
                                    </div>
                                    @foreach ($product->images as $item)
                                    <div class="single-large-img">
                                        <a href="{{ url('images/products/'.$item->image) }}" data-rel="lightcase:myCollection">
                                            <img src="{{ url('images/products/'.$item->image) }}" alt="{{$item->alt}}">
                                        </a>
                                    </div>
                                    @endforeach
                                    
                                    
                                </div>
                                <div class="ltn__shop-details-small-img slick-arrow-2">
                                    <div class="single-small-img">
                                        <img src="{{ url('images/products/'.$product->asset) }}" alt="{{$product->name}}">
                                    </div>

                                    @foreach ($product->images as $item)
                                    <div class="single-small-img">
                                        <img src="{{ url('images/products/'.$item->image) }}" alt="{{$item->alt}}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-product-info shop-details-info pl-0">
                                
                                <h3>{{$product->name}}</h3>
                                <div class="product-price">
                                    <span>{{$product->price}} {{currency()->code}}</span>
                                    {{-- <del>$65.00</del> --}}
                                </div>
                                <p>
                                    {!!$product->description!!}
                                </p>
                                <div class="modal-product-meta ltn__product-details-menu-1">
                                    <ul>
                                        <li>
                                            <strong>Categories:</strong> 
                                            <span>
                                                <a href="{{route('category.item', $product->category->permalink)}}">{{$product->category->name}}</a>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__product-details-menu-2">
                                    <ul>
                                        <li>
                                            <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-effect-3 btn-white" title="Add to Cart" >
                                                <span>ADD TO CART</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('buy.now', $product->id) }}" class="theme-btn-1 btn btn-effect-1" title="Buy Now" >
                                                <span>Buy Now</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="ltn__social-media">
                                    <ul>
                                        <li>Share:</li>
                                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                        
                                    </ul>
                                </div>
                                <hr>
                                <div class="ltn__safe-checkout">
                                    <h5>Guaranteed Safe Checkout</h5>
                                    <img src="{{asset('assets/img/icons/payment-4.png')}}" alt="Payment Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Shop Tab Start -->
                <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                    <div class="ltn__shop-details-tab-menu">
                        <div class="nav">
                            <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_1_1">Detail</a>
                            {{-- <a data-bs-toggle="tab" href="#liton_tab_details_1_2" class="">Reviews</a> --}}
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                            <div class="ltn__shop-details-tab-content-inner">
                                {!! $product->detail !!}
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="liton_tab_details_1_2">
                            <div class="ltn__shop-details-tab-content-inner">
                                <h4 class="title-2">Customer Reviews</h4>
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                    </ul>
                                </div>
                                <hr>
                                <!-- comment-area -->
                                <div class="ltn__comment-area mb-30">
                                    <div class="ltn__comment-inner">
                                        <ul>
                                            <li>
                                                <div class="ltn__comment-item clearfix">
                                                    <div class="ltn__commenter-img">
                                                        <img src="img/testimonial/1.jpg" alt="Image">
                                                    </div>
                                                    <div class="ltn__commenter-comment">
                                                        <h6><a href="#">Adam Smit</a></h6>
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                        <span class="ltn__comment-reply-btn">September 3, 2020</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ltn__comment-item clearfix">
                                                    <div class="ltn__commenter-img">
                                                        <img src="img/testimonial/3.jpg" alt="Image">
                                                    </div>
                                                    <div class="ltn__commenter-comment">
                                                        <h6><a href="#">Adam Smit</a></h6>
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                        <span class="ltn__comment-reply-btn">September 2, 2020</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ltn__comment-item clearfix">
                                                    <div class="ltn__commenter-img">
                                                        <img src="img/testimonial/2.jpg" alt="Image">
                                                    </div>
                                                    <div class="ltn__commenter-comment">
                                                        <h6><a href="#">Adam Smit</a></h6>
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                        <span class="ltn__comment-reply-btn">September 2, 2020</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- comment-reply -->
                                <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                    <form action="#">
                                        <h4 class="title-2">Add a Review</h4>
                                        <div class="mb-30">
                                            <div class="add-a-review">
                                                <h6>Your Ratings:</h6>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-item input-item-textarea ltn__custom-icon">
                                            <textarea placeholder="Type your comments...."></textarea>
                                        </div>
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" placeholder="Type your name....">
                                        </div>
                                        <div class="input-item input-item-email ltn__custom-icon">
                                            <input type="email" placeholder="Type your email....">
                                        </div>
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="website" placeholder="Type your website....">
                                        </div>
                                        <label class="mb-0"><input type="checkbox" name="agree"> Save my name, email, and website in this browser for the next time I comment.</label>
                                        <div class="btn-wrapper">
                                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- Shop Tab End -->
            </div>
        </div>
    </div>
</div>
<!-- SHOP DETAILS AREA END -->

<!-- PRODUCT SLIDER AREA START -->
<div class="ltn__product-slider-area ltn__product-gutter pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2">
                    <h4 class="title-2">Related Products<span>.</span></h1>
                </div>
            </div>
        </div>
        <div class="row ltn__related-product-slider-one-active slick-arrow-1">
            
            @foreach ($category_products as $item)
            <!-- ltn__product-item -->
            <div class="col-lg-12">
                
            @include('frontend.product_item')
            
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- PRODUCT SLIDER AREA END -->

@endsection

@section('script')

@endsection 