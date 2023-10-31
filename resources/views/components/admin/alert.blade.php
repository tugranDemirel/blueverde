<div class="alert alert-{{ $type }} {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}" role="alert">
    {{ $slot }}
</div>
