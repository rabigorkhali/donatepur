@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


    <form action="/submit-form" method="POST" class="form-horizontal">

        @csrf
        <x-adminlte-input name="iMail" type="email" placeholder="mail@example.com"/>

        {{-- Options with placeholder --}}
        <x-adminlte-options :options="['Option 1', 'Option 2', 'Option 3']" disabled="1" placeholder="Select an option..." />
        <!-- Form fields go here -->
        
        <x-adminlte-textarea name="taBasic" placeholder="Insert description..." required="required" />

        <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-check" />
    </form>


@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
