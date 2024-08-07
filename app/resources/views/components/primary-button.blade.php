<button style="background-color: #28CB8B" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs text-white    transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
