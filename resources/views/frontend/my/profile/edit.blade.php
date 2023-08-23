@extends('adminlte::page')

@section('title', 'Profile')


@section('content_header')

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's profile information") }}
            </p>
        </header>
    </section>
@stop

@section('content')
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-6">
                @php $formInputName='full_name'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" 
                    value="{{ old($formInputName, $user->$formInputName) }}" 
                    fgroup-class=" " />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='email'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='email' class="  "
                    label="{{ ucfirst($formInputName) }}" value="{{ old($formInputName, $user->$formInputName) }}"
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='username'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='textbox' class="  "
                    label="{{ ucfirst($formInputName) }}" value="{{ old($formInputName, $user->$formInputName) }}"
                     fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='country'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}"
                    value="{{ old($formInputName, $user->$formInputName) }}" label="Country" label-class=""
                    data-placeholder="Select Country...">
                    <option value="nepal" @if ($user->$formInputName == 'nepal') selected @endif>Nepal</option>
                    <option value="india" @if ($user->$formInputName == 'india') selected @endif>India</option>
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-6">
                @php $formInputName='address'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='textbox' class="  "
                    label="{{ ucfirst($formInputName) }}" value="{{ old($formInputName, $user->$formInputName) }}"
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='mobile_number'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='textbox' class="  "
                    value="{{ old($formInputName, $user->$formInputName) }}" 
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-6">
                @php $formInputName='mobile_number_secondary'; @endphp
                <x-adminlte-input name="{{ $formInputName }}" type='textbox' class="  "
                    value="{{ old($formInputName, $user->$formInputName) }}" 
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-6">
                @php $formInputName='landline_number'; @endphp
                <x-adminlte-input name="{{ $formInputName }}" type='textbox' class="  "
                    value="{{ old($formInputName, $user->$formInputName) }}" 
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='date_of_birth'; @endphp
                <x-adminlte-input name="{{ $formInputName }}" type='date' class="  "
                    value="{{ old($formInputName, $user->$formInputName) }}"
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='profile_picture'; @endphp
                <x-adminlte-input name="{{ $formInputName }}" type='file' accept="image/*" class="  " value=""
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
                <a href="{{ asset('public/uploads/' . $user->profile_picture) }}" target="_blank">
                <img class="img-thumbnail" style="height:100px"
                    src="{{ asset('public/uploads/' . giveImageName($user->profile_picture, 'medium')) }}" height="50">
                </a>
            </div>
            <div class="flex items-center gap-4 mb-2">
                <x-adminlte-button label="Primary" type="submit" theme="primary" label="Save" icon="fas fa-save" />
            </div>
        </div>

    </form>
@stop

@section('css')

@stop

@section('js')

    <script></script>
@stop
