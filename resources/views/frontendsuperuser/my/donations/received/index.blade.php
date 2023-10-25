@extends('adminlte::page')

@section('title', $page_title)


@section('content_header')
<style>
    .dataTables_filter {
        display: none;
    }
</style>
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
            <li class="breadcrumb-item active"><a>{{$page_title}}</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="flex items-center gap-4 float-right mb-2">

    </div>
    {{-- With buttons --}}
        {{-- datatbles files donatepur/resources/views/vendor/adminlte/components/tool/datatable.blade.php --}}
        <form class="form-inline float-right">
            <div class="form-group mb-2">
                <span class="text-italic"> Search Filter: </span>
            </div>
            <div class="form-group md-sm-3 mb-2 ml-2">
                <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
            <div class="form-group md-sm-4 mb-2 ml-2">
                <select id="paymentGateway" class="form-control">
                    <option selected value="">Payment Gateway</option>
                    @foreach ($paymentGateways as $paymentGatewaysKey => $paymentGatewaysDatum)
                        <option value="{{ $paymentGatewaysDatum->name }}">{{ $paymentGatewaysDatum->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group md-sm-4 mb-2 ml-2">
                <select id="campaigns" class="form-control">
                    <option selected value="">Select Campaign</option>
                    @foreach ($campaigns as $campaignsKey => $campaignsDatum)
                        <option value="{{ $campaignsDatum->title }}">{{ $campaignsDatum->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group md-sm-4 mb-2 ml-2">
                <input type="date" id="startDate" class="form-control">
            </div>
            <div class="form-group md-sm-4 mb-2 ml-2">
                <input type="date" id="endDate" class="form-control">
            </div>
            <div class="form-group md-sm-4 mb-2 ml-2">
                <button class="btn btn-sm btn-info" onclick="clearFilters()">Clear Filters</button>
            </div>
        </form>
    <x-adminlte-datatable id="table7" :heads="$heads" head-theme="light" theme="" :config="$config" striped
        hoverable with-buttons />

    {{-- With buttons + customization --}}
    @php
        $config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
                  <"row" <"col-12" tr> >
                  <"row" <"col-sm-12 d-flex justify-content-start" f> >';
        $config['paging'] = true;
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
                    const deleteUrl = "{{ route('mysuperuser.payment.gateways.delete') }}" + '?id=' + dataId;
                    window.location.href = deleteUrl;
                    // location.reload();
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {


            $('#search').on('keyup', function() {
                applyFilters();
            });

            $('#paymentGateway').on('change', function() {
                applyFilters();
            });

            $('#startDate').on('change', function() {
                applyFilters();
            });

            $('#endDate').on('change', function() {
                applyFilters();
            });
            $('#campaigns').on('change', function() {
                applyFilters();
            });

            function applyFilters() {
                let searchValue = $('#search').val();
                let paymentGatewayValue = $('#paymentGateway').val();
                let startDateValue = $('#startDate').val();
                let endDateValue = $('#endDate').val();
                let campaignValue = $('#campaigns').val();

                let searchCondition = '';

                if (searchValue) {
                    searchCondition += '(?=.*' + $.fn.dataTable.util.escapeRegex(searchValue) + ')';
                }

                if (paymentGatewayValue) {
                    if (searchCondition) {
                        searchCondition += '.*';
                    }
                    searchCondition += '(?=.*' + $.fn.dataTable.util.escapeRegex(paymentGatewayValue) + ')';
                }


                if (campaignValue) {
                    if (searchCondition) {
                        searchCondition += '.*';
                    }
                    searchCondition += '(?=.*' + $.fn.dataTable.util.escapeRegex(campaignValue) + ')';
                }

                if (startDateValue) {
                    let columnIndex = 10;
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        var columnData = data[columnIndex]; // Assuming date is in column index 10
                        if (!columnData || columnData === '') {
                            return false; // Skip empty cells
                        }
                        var columnValue = new Date(columnData);
                        let startDateValue = $('#startDate').val();
                        let startDate = new Date(startDateValue);
                        return columnValue >= startDate;
                    });
                    currentTable.draw();
                }

                if (endDateValue) {
                    let columnIndex = 10;
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        var columnData = data[columnIndex]; // Assuming date is in column index 10
                        if (!columnData || columnData === '') {
                            return false; // Skip empty cells
                        }
                        var columnValue = new Date(columnData);
                        let endDateValue = $('#endDate').val();
                        let endDateTime = new Date(endDateValue);
                        return columnValue <= endDateTime;
                    });
                    currentTable.draw();
                }

                currentTable.search(searchCondition, true, false).draw();
            }
        });
    </script>
    <script></script>
@stop
