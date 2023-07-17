@extends('adminlte::components.form.input-group-component')

{{-- Set errors bag internallly --}}

@php($setErrorsBag($errors ?? null))

{{-- Set input group item section --}}

@section('input_group_item')

    {{-- Input --}}
    {{-- {{$attributes}} to take values given in component --}}
    {{-- {{$attributes['label']}} --}}
    <input @if ($attributes['min']) min="{{ $attributes['min'] }}" @endif
        @if ($attributes['max']) max="{{ $attributes['max'] }}" @endif
        type="@if($attributes['type']){{$attributes['type']}}@endif"
        @if ($attributes['required']) required @endif id="{{ $id }}" name="{{ $name }}"
        placeholder="@if (isset($attributes['placeholder']) && $attributes['placeholder']) {{ $attributes['placeholder'] }} @else {{ ucwords(str_replace('_', ' ', $name ?? '')) }} @endif"
        value="{{ $getOldValue($errorKey, $attributes->get('value')) }}"
        @if (isset($attributes['pattern'])) pattern="{{$attributes['pattern']}}" @endif
        @if (isset($attributes['title'])) title="{{$attributes['title']}}" @endif
        class="{{ $makeItemClass() . ' ' . $attributes['class'] ?? ' ' }}  @if ($errors->first($name)) is-invalid @endif">
@overwrite
