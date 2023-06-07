@include('frontend.partials.header')
<body>
    <div class="page-wrapper">
        <div class="preloader">
            <div>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        @include('frontend.partials.navbar')
        @yield('body')
        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
    @yield('scripts')
</body>
</html>
