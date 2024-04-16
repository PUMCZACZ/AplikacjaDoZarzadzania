@props([
    'name',
    'id',
    'label',
    'type' => 'text',
    'containerClass' => null,
])
<div class="mb-3 {{ $containerClass }}">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <input {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $id }}"/>
</div>
