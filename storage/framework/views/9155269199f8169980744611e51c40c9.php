<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'default'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'variant' => 'default'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
$classes = match($variant) {
    'default' => 'rounded-xl border bg-card text-card-foreground shadow',
    'hover' => 'rounded-xl border bg-card text-card-foreground shadow hover:shadow-lg transition-shadow duration-200',
    default => 'rounded-xl border bg-card text-card-foreground shadow'
};
?>

<div <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</div>
<?php /**PATH C:\Users\hagga\Documents\GitHub\TeamBoard\resources\views/components/card.blade.php ENDPATH**/ ?>