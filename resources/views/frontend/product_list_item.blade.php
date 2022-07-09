<div class="top-rated-product-item clearfix">
    <div class="top-rated-product-img">
        <a href="{{route('shop.detail', $item->permalink)}}"><img src="{{ url('images/products/'.$item->asset) }}" alt="{{$item->name}}"></a>
    </div>
    <div class="top-rated-product-info">
        @if ($item->discount_id != '')
            {{-- Fit Price and Percentage Price --}}
            @if ($item->discount->status == 'fit price' || $item->discount->status == 'percentage price' )
            <div class="product-price">
                <span>Discount</span>
            </div>

            {{-- Free Gif --}}
            @elseif ($item->discount->status == 'free gif' )
            <div class="product-price">
                <span>Free Gif</span>
            </div>

            {{-- Free Shipping --}}
            @elseif ($item->discount->status == 'free shipping' )
            
            <div class="product-price">
                <span>Free Shipping</span>
            </div>

            {{-- Free Shipping --}}
            @elseif ($item->discount->status == 'buy one get one' )
            <div class="product-price">
                <span>Buy on Get One</span>
            </div>

            @endif
        

        @endif
        <h6><a href="{{route('shop.detail', $item->permalink)}}">{{$item->name}}</a></h6>
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