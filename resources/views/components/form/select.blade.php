@props([
    'name',
    'id',
    'label',
    'containerClass' => null,
])

<div class="mb-3 {{ $containerClass }}">
    <label class="form-label" for="order_type">{{ $label }}</label>
    <select {{ $attributes->merge(['class' => 'form-select']) }} name="{{ $name }}" id="{{ $id }}">
        {{ $slot }}
    </select>

    <x-form.error :name="$name" />
</div>
