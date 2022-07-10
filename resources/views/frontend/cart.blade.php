@extends('frontend.layouts.app')
@section('breadcrumb')
<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="{{asset('assets/img/bg/14.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Cart</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="{{route('index')}}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Cart</li>
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
<!-- SHOPING CART AREA START -->
<div class="liton__shoping-cart-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping-cart-inner">
                    <div class="shoping-cart-table table-responsive">
                        <table class="table">
                            <thead>
                                <th class="cart-product-remove">Remove</th>
                                <th class="cart-product-image">Image</th>
                                <th class="cart-product-info">Product</th>
                                <th class="cart-product-price">Price</th>
                                <th class="cart-product-quantity">Quantity</th>
                                <th class="cart-product-subtotal">Subtotal</th>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                
                                @if(session('cart'))
                                
                                @foreach(session('cart') as $id => $details)
                                
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td class="cart-product-remove actions" data-th=""><button class="remove-from-cart">x</button></td>
                                    <td class="cart-product-image">
                                        <a href="product-details.html"><img src="{{ asset('images/products/'. $details['asset']) }}" alt="#"></a>
                                    </td>
                                    <td class="cart-product-info">
                                        <h4><a href="product-details.html">{{ $details['name'] }}</a></h4>
                                    </td>
                                    <td class="cart-product-price">{{ $details['price'] }} {{currency()->code}}</td>
                                    <td class="cart-product-quantity " data-th="Quantity">
                                            <input type="number" value="{{ $details['quantity'] }}" name="qtybutton" class="form-control cart-plus-minus-box quantity update-cart" style="height: 50px; border: 1px solid gray;">
                                    </td>
                                    <td class="cart-product-subtotal">{{ $details['price'] * $details['quantity'] }} {{currency()->code}}</td>
                                </tr>
                                @endforeach
                                
                                @endif
                                {{-- <tr class="cart-coupon-row">
                                    <td colspan="6">
                                        <div class="cart-coupon">
                                            <input type="text" name="cart-coupon" placeholder="Coupon code">
                                            <button type="submit" class="btn theme-btn-2 btn-effect-2">Apply Coupon</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn theme-btn-2 btn-effect-2-- disabled">Update Cart</button>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="shoping-cart-total mt-50">
                        <h4>Cart Totals</h4>
                        <table class="table">
                            <tbody>
                                
                                <tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong>{{ $total }} {{currency()->code}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-right">
                            <a href="{{ route('checkout')}}" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SHOPING CART AREA END -->

@endsection

@section('script')

<script type="text/javascript">

  

    $(".update-cart").change(function (e) {

        e.preventDefault();

  

        var ele = $(this);

  

        $.ajax({

            url: '{{ route('update.cart') }}',

            method: "patch",

            data: {

                _token: '{{ csrf_token() }}', 

                id: ele.parents("tr").attr("data-id"), 

                quantity: ele.parents("tr").find(".quantity").val()

            },

            success: function (response) {

               window.location.reload();

            }

        });

    });

  

    $(".remove-from-cart").click(function (e) {

        e.preventDefault();

  

        var ele = $(this);

  

        if(confirm("Are you sure want to remove?")) {

            $.ajax({

                url: '{{ route('remove.from.cart') }}',

                method: "DELETE",

                data: {

                    _token: '{{ csrf_token() }}', 

                    id: ele.parents("tr").attr("data-id")

                },

                success: function (response) {

                    window.location.reload();

                }

            });

        }

    });

  

</script>

@endsection 