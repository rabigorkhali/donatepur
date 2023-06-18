@extends('adminlte::components.form.input-group-component')

{{-- Set errors bag internallly --}}

@php($setErrorsBag($errors ?? null))

{{-- Set input group item section --}}

@section('input_group_item')

    {{-- Input --}}
    {{-- {{$attributes}} to take values given in component --}}
    <input type="@if($attributes['type']){{$attributes['type']}}@endif"
        @if ($attributes['required']) required @endif id="{{ $id }}" name="{{ $name }}"
        value="{{ $getOldValue($errorKey, $attributes->get('value')) }}"
        class="{{ $makeItemClass() . ' ' . $attributes['class'] ?? ' ' }} @if ($errors->first($name)) is-invalid @endif">
@overwrite
