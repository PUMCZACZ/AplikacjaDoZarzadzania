@props([
    'title',
    'icon',
])

<div {{ $attributes-merge(['class' => 'card shadow-lg p-3 mb-3 bg-body rounded']) }}>
    <div class="card-header shadow p-3 mb-2 bg-body rounded">
        <h1><i class="{{ $icon }}" style="font-size: 2rem;"> </i>{{ title }}</h1>
    </div>
    <div class="card-body">
        <p class="card-text">Text</p>
    </div>
</div>
