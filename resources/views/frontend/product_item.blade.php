
<div class="ltn__product-item ltn__product-item-3 text-center">
    <div class="product-img">
        <a href="{{route('shop.detail', $item->permalink)}}"><img src="{{ url('images/products/'.$item->asset) }}" alt="{{$item->name}}"></a>
        
        @if ($item->discount_id != '')
            {{-- Fit Price and Percentage Price --}}
            @if ($item->discount->status == 'fit price' || $item->discount->status == 'percentage price' )
            <div class="product-badge">
                <ul>
                    <li class="sale-badge">Discount</li>
                </ul>
            </div>

            {{-- Free Gif --}}
            @elseif ($item->discount->status == 'free gif' )
            <div class="product-badge">
                <ul>
                    <li class="sale-badge">Free Gif</li>
                </ul>
            </div>

            {{-- Free Shipping --}}
            @elseif ($item->discount->status == 'free shipping' )
            <div class="product-badge">
                <ul>
                    <li class="sale-badge">Free Shipping</li>
                </ul>
            </div>

            {{-- Free Shipping --}}
            @elseif ($item->discount->status == 'buy one get one' )
            <div class="product-badge">
                <ul>
                    <li class="sale-badge">Buy on Get One</li>
                </ul>
            </div>

            @endif
        

        @endif
        
        
        <div class="product-hover-action">
            <ul>
                <li>
                    <a href="{{route('shop.detail', $item->permalink)}}" title="View">
                        <i class="far fa-eye"></i>
                    </a>
                </li>
                <li>
                    <a 
                    href="{{ route('add.to.cart', $item->id) }}"
                    title="Add to Cart" role="button">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="product-info">
    
    <h2 class="product-title"><a href="{{route('shop.detail', $item->permalink)}}">{{$item->name}}</a></h2>
    <div class="product-price">
        @if ($item->discount_id != '')
        {{-- Fit Price --}}
            @if ($item->discount->status == 'fit price')
            <span>{{$item->discount->discount_price}}  {{currency()->code}}</span>
            <del>{{$item->price}}</del>

            {{-- Percentage Discount --}}
            @elseif ($item->discount->status == 'percentage price')
            @php
                $price = $item->price - $item->discount->discount_percent / 100;
            @endphp
            <span>{{$price}}  {{currency()->code}}</span>
            <del>{{$item->price}}</del>

            @else
            <span>{{$item->price}}  {{currency()->code}}</span>
            @endif
        
        @else
        <span>{{$item->price}}  {{currency()->code}}</span>
        @endif
        
        
    </div>
</div>
</div>
