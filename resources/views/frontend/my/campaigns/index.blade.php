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
            <li class="breadcrumb-item "><a href="{{ url('/my/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a>Campaigns</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="flex items-center gap-4 float-right mb-2">
        <a href="{{ route('my.campaigns.create') }}" type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i>Add New
        </a>
    </div>

    {{-- With buttons --}}
    <x-adminlte-datatable id="table7" :heads="$heads" head-theme="light" theme="" :config="$config" striped
        hoverable with-buttons />

    {{-- With buttons + customization --}}
   

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
                    const deleteUrl = "{{ route('my.campaigns.delete') }}" + '?id=' + dataId;
                    window.location.href = deleteUrl;
                    // location.reload();
                }
            });
        }
    </script>

    <script></script>
@stop
