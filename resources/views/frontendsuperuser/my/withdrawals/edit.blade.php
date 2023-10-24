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
            <li class="breadcrumb-item "><a href="{{ url('/mysuperuser/campaigns') }}">Campaigns</a></li>
            <li class="breadcrumb-item active"><a>Edit</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <form method="post" action="{{ route('my.campaigns.update', $campaignDetail->id) }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-md-6">
                @php $formInputName='title'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}"
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class=" " />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='goal_amount'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" label="Goal Amount (Rs.)"
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class=" " min="1000" type="number" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='start_date'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='date' class="  "
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='end_date'; @endphp
                <x-adminlte-input required name="{{ $formInputName }}" type='date' class="  "
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='campaign_category_id'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}"
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}" label="Campaign Category"
                    label-class="" data-placeholder="Select Campaign Category...">
                    @foreach ($campaignCategories as $campaignCategoriesDatum)
                        <option value="{{ $campaignCategoriesDatum->id }}"
                            @if ($campaignDetail->$formInputName == $campaignCategoriesDatum->title) selected @endif>
                            {{ $campaignCategoriesDatum->title }}</option>
                    @endforeach
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
                    label="{{ ucfirst($formInputName) }}"
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='country'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}"
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}" label="Country" label-class=""
                    data-placeholder="Select Country...">
                    <option value="nepal" @if ($campaignDetail->$formInputName == 'nepal') selected @endif>Nepal</option>
                    <option value="india" @if ($campaignDetail->$formInputName == 'india') selected @endif>India</option>
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-6">
                @php $formInputName='video_url'; @endphp
                <x-adminlte-input name="{{ $formInputName }}" type='textbox' class="  "
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}"
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                @php $formInputName='cover_image'; @endphp
                <x-adminlte-input name="{{ $formInputName }}" type='file' accept="image/*" class="  " value=""
                    placeholder="{{ ucfirst($formInputName) }}" fgroup-class="" />
                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
                <a href="{{ asset('public/uploads/' . $campaignDetail->cover_image) }}" target="_blank">
                    <img class="img-thumbnail" style="height:100px"
                        src="{{ asset('public/uploads/' . giveImageName($campaignDetail->cover_image, 'medium')) }}"
                        height="50">
                </a>
            </div>
            <div class="col-md-6">
                @php $formInputName='status'; @endphp
                <x-adminlte-select2 required name="{{ $formInputName }}"
                    value="{{ old($formInputName, $campaignDetail->$formInputName) }}" label="Status" label-class=""
                    data-placeholder="Select Status">
                    <option value="1" @if ($campaignDetail->$formInputName == 1) selected @endif>Active</option>
                    <option value="0" @if ($campaignDetail->$formInputName == 0) selected @endif>Inactive</option>
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12 mt-2">
                @php $formInputName='description'; @endphp
                <x-adminlte-text-editor
                    label="Descriptions (Mentioning your personal bank account/payment gateway detail is strictly prohibited.)"
                    maxlength="1" minlength="100" required rows="20" label-class="" cols="10"
                    name="{{ $formInputName }}" value="">
                    {{ old($formInputName, $campaignDetail->$formInputName) }}
                    </x-adminlte-textarea>
                    @if ($errors->has($formInputName))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first($formInputName) }}</strong>
                        </span>
                    @endif
            </div>
            <div class="flex items-center gap-4 mb-2">
                <x-adminlte-button label="Primary" type="submit" theme="primary" label="Save" icon="fas fa-save" />
                <a href="{{ route('my.withdrawals.list') }}" class="btn btn-default">
                    <i class="fas fa-backward"></i> Back </a>
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
            width: 1140, // set editor height
            focus: true
        });
    </script>
@stop
