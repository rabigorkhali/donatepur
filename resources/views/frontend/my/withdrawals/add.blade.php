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
            <li class="breadcrumb-item "><a href="{{ url('/my/withdrawls') }}">Withdrawals</a></li>
            <li class="breadcrumb-item active"><a>Request</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <form method="post" action="{{ route('my.withdrawals.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                @php $formInputName='campaign_id'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}" value="{{ old($formInputName) }}" label="Campaigns"
                    label-class="" data-placeholder="Select Campaign...">
                    @foreach ($campaigns as $campaignsDatum)
                        <option value="{{ $campaignsDatum->id }}" @if (old($formInputName) == $campaignsDatum->campaign_id) selected @endif>
                            {{ $campaignsDatum->title }}
                        </option>
                    @endforeach
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif

            </div>
            <div class="col-md-6">
                @php $formInputName='user_payment_gateway_id'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}" value="{{ old($formInputName) }}"
                    label="Payment Gateway" label-class="" data-placeholder="Select Payment Gateway...">
                    @foreach ($paymentGateways as $paymentGatewaysDatum)
                        <option value="{{ $paymentGatewaysDatum->id }}" @if (old($formInputName) == $paymentGatewaysDatum->campaign_id) selected @endif>
                            {{ $paymentGatewaysDatum->payment_gateway_name }}
                        </option>
                    @endforeach
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif

            </div>
        </div>
        <div class="flex items-center gap-4">
            <x-adminlte-button label="Primary" type="submit" theme="primary" label="Request" icon="fas fa-save" />
        </div>
    </form>
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
