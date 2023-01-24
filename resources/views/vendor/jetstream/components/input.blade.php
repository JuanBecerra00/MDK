@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-zinc-700 focus:ring focus:ring-zinc-700 rounded-md shadow-sm dark:bg-zinc-700']) !!}>
