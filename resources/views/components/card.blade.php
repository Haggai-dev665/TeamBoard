@props(['hover' => false])

<div {{ $attributes->merge(['class' => 'rounded-xl border bg-card text-card-foreground shadow' . ($hover ? ' transition-all duration-300 hover:-translate-y-1 hover:shadow-xl' : '')]) }}>
    {{ $slot }}
</div>
