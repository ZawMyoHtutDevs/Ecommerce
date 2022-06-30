<?php $dash.='-- '; ?>
@foreach($subcategories as $item)
<tr>
    <td>
        <img class="img-fluid rounded shadow" src="{{ url('images/products/categories/'.$item->asset) }}" style="max-width: 60px" alt="">
    </td>
    <td>{{$dash}}{{$item->name}}</td>
    <td>
       {{-- Products Count --}}
       {{$item->products->count()}}
    </td>
    <td>
        
        {{-- Edit and View --}}
        <a href="{{route('categories.edit', $item->id)}}" class="btn btn-icon btn-hover btn-sm btn-rounded pull-right text-primary">
            <i class="anticon anticon-edit"></i>
        </a>
        
        
        <button class="btn btn-icon btn-hover btn-sm btn-rounded text-danger" onclick="if(confirm('Are you sure you want to delete this data?')){document.getElementById('delete-form{{$item->id}}').submit(); }">
            <i class="anticon anticon-delete"></i>
        </button>
        <form style="display: none;" id="delete-form{{$item->id}}" method="POST" action="{{route('categories.destroy', $item->id)}}" >
            @csrf @method('DELETE')
        </form>
        
    </td>
</tr>
    @if(count($item->subcategory))
        @include('products.categories.subcategorieslist',['subcategories' => $item->subcategory])
    @endif
@endforeach