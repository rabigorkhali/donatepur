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
            <li class="breadcrumb-item "><a href="{{ url('/mysuperuser/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a>Campaigns</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="flex items-center gap-4 float-right mb-2">
        <a href="{{ route('mysuperuser.campaigns.create') }}" type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i>Add New</a>
    </div>
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
    <!-- Include SweetAlert CSS and JavaScript files -->

    <!-- JavaScript -->
    <script>
        function deleteBtn(dataId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    // Send request to delete route
                    const deleteUrl = "{{ route('mysuperuser.campaigns.delete') }}" + '?id=' + dataId;
                    window.location.href = deleteUrl;
                    // location.reload();
                }
            });
        }

        function forceWithdrawBtn(dataId) {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');

            const formattedDate = `${year}-${month}-${day}`;
            Swal.fire({
                title: 'Are you sure?',
                text: "You are force ending your campaign. Note: your campaign will be marked as completed on " +
                    formattedDate + " once you force withdraw.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Force end!'
            }).then((result) => {
                if (result.value) {
                    // Send request to delete route
                    const deleteUrl = "{{ route('mysuperuser.campaigns.forceWithdraw') }}" + '?id=' + dataId;
                    window.location.href = deleteUrl;
                    // location.reload();
                }
            });
        }
    </script>

    <script></script>
@stop
