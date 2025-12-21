@props([
    'variant' => 'default'
])

@php
$classes = match($variant) {
    'default' => 'rounded-xl border bg-card text-card-foreground shadow',
    'hover' => 'rounded-xl border bg-card text-card-foreground shadow hover:shadow-lg transition-shadow duration-200',
    default => 'rounded-xl border bg-card text-card-foreground shadow'
};
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
