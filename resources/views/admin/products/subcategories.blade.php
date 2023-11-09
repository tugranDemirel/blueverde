{{--
@foreach($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}">{{ $prefix }} {{ $subcategory->name }}</option>
    @if($subcategory->children)
        @include('admin.products.subcategories', ['subcategories' => $subcategory->children, 'prefix' => $prefix . '-'])
    @endif
@endforeach
--}}
