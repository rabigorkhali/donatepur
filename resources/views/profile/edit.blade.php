@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>
    </section>
@stop

@section('content')
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-6">
                @php $formInputName='name'; @endphp

                <x-adminlte-input name="{{ $formInputName }}" class=" manual " label="{{ ucfirst($formInputName) }}"
                    value="{{ old($formInputName, $user->$formInputName) }}" placeholder="{{ ucfirst($formInputName) }}"
                    fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='email'; @endphp

                <x-adminlte-input name="{{ $formInputName }}" type='email' class="  "
                    label="{{ ucfirst($formInputName) }}" value="{{ old($formInputName, $user->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='username'; @endphp

                <x-adminlte-input name="{{ $formInputName }}" type='textbox' class="  "
                    label="{{ ucfirst($formInputName) }}" value="{{ old($formInputName, $user->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div>
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-adminlte-button label="Primary" type="submit" theme="primary" label="Save" icon="fas fa-save" />
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')
    <script></script>
@stop
