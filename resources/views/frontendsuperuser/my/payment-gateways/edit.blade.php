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
            <li class="breadcrumb-item "><a href="{{ url('/mysuperuser/payment-gateways') }}">Payment Gateways</a></li>
            <li class="breadcrumb-item active"><a>Edit</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <form method="post" action="{{ route('my.payment.gateways.store') }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                @dump($errors)
                @php $formInputName='payment_gateway_id'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}" value="{{ old($formInputName) }}"
                    label="Payment Gateway" label-class="" data-placeholder="Select Payment Gateway...">
                    @foreach ($parentPaymentGateways as $parentPaymentGatewaysDatum)
                        <option value="{{ $parentPaymentGatewaysDatum->id }}"
                            @if (old($formInputName) == $parentPaymentGatewaysDatum->id) selected @endif>{{ $parentPaymentGatewaysDatum->name }}
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
                @php $formInputName='mobile_number'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" value="{{ old($formInputName) }}"
                    fgroup-class=" " />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='qr_code'; @endphp
                <x-adminlte-input name="{{ $formInputName }}" type='file' accept="image/*" class="  " value=""
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif    
            </div>
            <div class="col-md-6">
                @php $formInputName='status'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}" value="{{ old($formInputName) }}" label="Status"
                    label-class="" data-placeholder="Select Status">
                    <option value="1" selected>Active</option>
                    <option value="0" @if (old($formInputName) == 0) selected @endif>Inactive</option>
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12 mt-2">
                @php $formInputName='detail'; @endphp
                <x-adminlte-textarea required label="Descriptions" maxlength="500" minlength="50" required rows="10"
                    label-class="" cols="10" name="{{ $formInputName }}" value="">
                    {{ old($formInputName) }}
                    </x-adminlte-textarea>
                    @if ($errors->has($formInputName))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first($formInputName) }}</strong>
                        </span>
                    @endif

            </div>
            <div class="flex items-center gap-4 mb-2">
                <x-adminlte-button label="Primary" type="submit" theme="primary" label="Create" icon="fas fa-save" />
            </div>
        </div>

    </form>
@stop

@section('css')

@stop

@section('js')

    <script>
        $('#description').summernote({
            height: 400, // set editor height
            width: 750, // set editor height
            focus: true
        });
    </script>
@stop
