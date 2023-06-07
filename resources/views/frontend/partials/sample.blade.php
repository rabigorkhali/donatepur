<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.header')

<body>
    <div class="page-wrapper">
        @include('frontend.partials.loader')
        @include('frontend.partials.navbar')
        {{-- put here section --}}

        {{-- end  put here section --}}
        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
</body>

</html>
