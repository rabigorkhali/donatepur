@extends('adminlte::page')

@section('title', 'Change Password')


@section('content_header')
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Change Password') }}
            </h2>
        </header>
    </section>
@stop

@section('content')
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                @php $formInputName='current_password'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type="password"  value=""
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class=" " />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @php $formInputName='password'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='password' class="  "
                    label="{{ ucfirst($formInputName) }}" value="" placeholder="{{ ucfirst($formInputName) }}"
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @php $formInputName='password_confirmation'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='password' class="  " value=""
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

        </div>

        <div class="flex items-center gap-4">
            <x-adminlte-button label="Primary" type="submit" theme="primary" label="Save" icon="fas fa-save" />
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')

    <script></script>
@stop
