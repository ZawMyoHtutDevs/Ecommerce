@extends('frontend.layouts.app')
@section('breadcrumb')
<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('assets/img/bg/14.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Shop</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('index')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Shop</li>
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
<!-- PRODUCT DETAILS AREA START -->
<div class="ltn__product-area ltn__product-gutter mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__shop-options">
                    <ul>
                        <li>
                            <div class="ltn__grid-list-tab-menu ">
                                <div class="nav">
                                    <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                    <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="showing-product-number text-right">
                                <span>Showing 1–12 of 18 results</span>
                            </div> 
                        </li>
                        <li>
                            <div class="short-by text-center">
                                <select class="nice-select">
                                    <option>Default Sorting</option>
                                    <option>Sort by popularity</option>
                                    <option>Sort by new arrivals</option>
                                    <option>Sort by price: low to high</option>
                                    <option>Sort by price: high to low</option>
                                </select>
                            </div> 
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="liton_product_grid">
                        <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                            <div class="row">
                                
                                @foreach ($products as $item)
                                <!-- ltn__product-item -->
                                <div class="col-xl-4 col-sm-6 col-6">
                                    
                                    @include('frontend.product_item')
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="text-center">
                    {{ $products->links() }}
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                    <!-- Search Widget -->
                    <div class="widget ltn__search-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
                        <form action="#">
                            <input type="text" name="search" placeholder="Search your keyword...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <!-- Category Widget -->
                    <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                        <ul>
                            @if($categories_data)
                            @foreach($categories_data as $category)
                            <?php $dash=''; ?>
                            <li><a href="{{route('category.item', $category->permalink)}}">{{$category->name}} <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            @if(count($category->subcategory))
                            @include('frontend.subcategories',['subcategories' => $category->subcategory])
                            @endif
                            @endforeach
                            @endif
                            
                        </ul>
                    </div>
                    <!-- Top Rated Product Widget -->
                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                        <ul>
                            @foreach ($featured_products as $item)
                            <li>
                                @include('frontend.product_list_item')
                            </li>
                            @endforeach
                            
                           
                        </ul>
                    </div>
                    
                    
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget">
                        <a href="shop.html"><img src="{{asset('assets/img/banner/banner-2.jpg')}}" alt="#"></a>
                    </div>
                    
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT DETAILS AREA END -->
@endsection
