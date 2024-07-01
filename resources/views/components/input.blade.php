<!-- resources/views/components/input.blade.php -->
@props(['type' => 'text', 'name', 'value', 'autofocus' => false, 'required' => false, 'autocomplete' => 'off', 'placeholder' => ''])

<input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge(['class' => 'form-control']) }}
    @if($autofocus) autofocus @endif
    @if($required) required @endif
    autocomplete="{{ $autocomplete }}"
    placeholder="{{ $placeholder }}">
