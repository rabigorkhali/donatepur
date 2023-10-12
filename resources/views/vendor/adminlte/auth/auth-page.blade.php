@extends('adminlte::master')
{{--  @include('frontend.partials.header')
@include('frontend.partials.navbar') 
@include('frontend.partials.navbar') --}}
<style>
    body::before {
        content: "";
        background-image: url('https://media.istockphoto.com/id/507276910/photo/group-of-happy-gypsy-indian-children-desert-village-india.jpg?b=1&s=612x612&w=0&k=20&c=YQExmcfn4ZL-OEdx81Epowoxlokcv5v89Rfb621YcFM=');
        /* Replace 'your-image-url.jpg' with the actual URL or path to your background image */
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        /* Set the opacity to 20% (0.2) */
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
        /* Ensure the background is behind the content */
        pointer-events: none;
        /* Allow clicks to pass through the background */
    }
</style>
@php($dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home'))

@if (config('adminlte.use_route_url', false))
    @php($dashboard_url = $dashboard_url ? route($dashboard_url) : '')
@else
    @php($dashboard_url = $dashboard_url ? url($dashboard_url) : '')
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
    <div class="@if ($auth_type == 'register') mt-150 @endif {{ $auth_type ?? 'login' }}-box">

        {{-- Logo --}}
        {{--         <div class="{{ $auth_type ?? 'login' }}-logo">
            <a href="{{ $dashboard_url }}">

                @if (config('adminlte.auth_logo.enabled', false))
                    <img src="{{ asset(config('adminlte.auth_logo.img.path')) }}"
                         alt="{{ config('adminlte.auth_logo.img.alt') }}"
                         @if (config('adminlte.auth_logo.img.class', null))
                            class="{{ config('adminlte.auth_logo.img.class') }}"
                         @endif
                         @if (config('adminlte.auth_logo.img.width', null))
                            width="{{ config('adminlte.auth_logo.img.width') }}"
                         @endif
                         @if (config('adminlte.auth_logo.img.height', null))
                            height="{{ config('adminlte.auth_logo.img.height') }}"
                         @endif>
                @else
                    <img src="{{ asset(config('adminlte.logo_img')) }}"
                         alt="{{ config('adminlte.logo_img_alt') }}" height="50">
                @endif

                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}

            </a>
        </div> --}}

        {{-- Card Box --}}
        <div class="row">

            <div class="col-sm-12 col-md-12 btn btn-block btn-flat ">
                <a href="{{ url('/') }}"><img src="{{ asset('/public/uploads') . '/' . imageName(setting('site.logo')) }}"
                        height="100">
                </a>
            </div>
            <div class="col-sm-12 col-md-12 ">
                <a href="{{ url('/') }}" class="btn btn-block btn-flat btn-secondary mb-2 mt-4">
                    <span class="fas fa-globe"></span>
                    Visit Homepage
                </a>
            </div>
        </div>
        <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

            {{-- Card Header --}}

            @hasSection('auth_header')
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    @include('adminlte::message-group')
                    <h3 class="card-title float-none text-center">
                        @yield('auth_header')
                    </h3>
                </div>
            @endif

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                @yield('auth_body')
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                    @yield('auth_footer')
                </div>
            @endif

        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop

{{-- @include('frontend.partials.footer') --}}
