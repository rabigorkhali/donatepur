<div class="preloader flex-column justify-content-center align-items-center">

    {{-- Preloader logo --}}
    <img src="{{ asset('/public/uploads') . '/' . imageName(setting('site.logo')) }}"
         class="{{ config('adminlte.preloader.img.effect', 'animation__shake') }}"
         alt="{{ config('adminlte.preloader.img.alt', 'AdminLTE Preloader Image') }}"
         width="{{ config('adminlte.preloader.img.width', 60) }}"
         height="{{ config('adminlte.preloader.img.height', 60) }}">

</div>
