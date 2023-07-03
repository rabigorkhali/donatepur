@extends('adminlte::page')

@section('title', $page_title)


@section('content_header')
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ $page_title }}
            </h2>
        </header>
    </section>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="{{url('/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a >Campaigns</a></li>
        </ol>
    </nav>
@stop

@section('content')
    {{-- With buttons --}}
    <x-adminlte-datatable id="table7" :heads="$heads" head-theme="light" theme="" :config="$config" striped
        hoverable with-buttons />

    {{-- With buttons + customization --}}
    @php
        $config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
                  <"row" <"col-12" tr> >
                  <"row" <"col-sm-12 d-flex justify-content-start" f> >';
        $config['paging'] = false;
        $config['lengthMenu'] = [10, 50, 100, 500];
    @endphp

@stop

@section('css')

@stop

@section('js')

    <script></script>
@stop
