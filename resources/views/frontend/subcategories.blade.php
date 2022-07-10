<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <li><a href="{{route('category.item', $subcategory->permalink)}}">{{$dash}}{{$subcategory->name}}<span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
    @if(count($subcategory->subcategory))
        @include('frontend.subcategories',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach