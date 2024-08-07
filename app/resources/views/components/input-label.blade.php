@props(['value'])

<label style="color: #28CB8B; font-size:15px;" {{ $attributes->merge(['class' => 'block font-medium text-sm pt-1s']) }}>
    {{ $value ?? $slot }}
</label>
