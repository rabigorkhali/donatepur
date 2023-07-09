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
            <li class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ url('/my/payment-gateways') }}">Payment Gateway</a></li>
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
                                <th style="width:20%">Name:</th>
                                <td>{{ $thisModelDetail?->parentPaymentGateway?->name ??'N/A' }}</td>
                            </tr>
 
                            <tr>
                                <th style="width:20%;">Mobile Number</th>
                                <td>{{ $thisModelDetail->mobile_number }}</td>
                            </tr>
                        
                            <tr>
                                <th style="width:20%;">Qr Code</th>
                                <td>
                                    <a href="{{ asset('uploads/' . $thisModelDetail->qr_code) }}" target="_blank">
                                        <img class="img-thumbnail" style="height:200"
                                            src="{{ asset('uploads/' . giveImageName($thisModelDetail->qr_code, 'medium')) }}"
                                            height="50">
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th style="width:20%;">Detail</th>
                                <td>
                                    <textarea rows="20" readonly style="width: 100%;"> {{ $thisModelDetail->detail }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th> <a href="{{ route('my.payment.gateways.list') }}" rel="noopener" 
                                    class="btn btn-default float-left mb-4"><i class="fas fa-backward"></i> Back</a></th>
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
