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
            <li class="breadcrumb-item "><a href="{{ url('/mysuperuser/payment-gateways') }}">Payment Gateway</a></li>
            <li class="breadcrumb-item active"><a>Detail</a></li>
        </ol>

    </nav>

@stop

@section('content')
    <div class="invoice p-3 mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:20%">Payment Gateway:</th>
                                <td>{{ $thisModelDetail?->payment_gateway_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Mobile Number</th>
                                <td>{{ $thisModelDetail->mobile_number }}</td>
                            </tr>
                            @if (strtolower($thisModelDetail?->payment_gateway_name) == 'bank' || strtolower($thisModelDetail?->payment_gateway_name) == 'bank (national/international)' )
                                <tr>
                                    <th style="width:20%">Bank Name:</th>
                                    <td>{{ $thisModelDetail?->bank_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%">Swift Code:</th>
                                    <td>{{ $thisModelDetail?->swift_code ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%">Bank Account Number:</th>
                                    <td>{{ $thisModelDetail?->bank_account_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th style="width:20%">Bank Address:</th>
                                    <td>{{ $thisModelDetail?->bank_address ?? 'N/A' }}</td>
                                </tr>
                            @endif

                            {{-- <tr>
                                <th style="width:20%;">Qr Code</th>
                                <td>
                                    <a href="{{ asset('public/uploads/' . $thisModelDetail->qr_code) }}" target="_blank">
                                        <img class="img-thumbnail" style="height:200"
                                            src="{{ asset('public/uploads/' . giveImageName($thisModelDetail->qr_code, 'medium')) }}"
                                            height="50">
                                    </a>
                                </td>
                            </tr> --}}

                            <tr>
                                <th style="width:20%;">Detail</th>
                                <td>
                                    <textarea rows="10" readonly style="width: 100%;"> {{ $thisModelDetail->detail }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th> <a href="{{ route('my.payment.gateways.list') }}" rel="noopener"
                                        class="btn btn-default float-left mb-4"><i class="fas fa-backward"></i> Back</a>
                                </th>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

    <script>
        $('#description').summernote({
            height: 400, // set editor height
            width: 1140, // set editor height
            focus: true
        });
    </script>
@stop
