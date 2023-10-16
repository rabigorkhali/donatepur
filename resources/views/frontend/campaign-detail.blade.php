@extends('frontend.master')
@section('header')
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
@endsection
@section('title', 'Home')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-stellar-background-ratio="0.5"
            data-bg-img="{{ asset('/public/uploads/static-images/images/banner-small.jpeg') }}"
            style="background-image: url(&quot;images/bg/bg1.jpg&quot;); background-position: 50% 61px;">
            <div class="container pt-100 pb-50">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">

                            <h3 class="title text-white">{{ $campaignDetails->title }}</h3>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>

            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-8 pb-sm-20">
                            <div class="causes maxwidth500 mb-sm-50">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thumb">
                                            <img class="img-fullwidth img-thumbnail" alt=""
                                                src="{{ asset('/public/uploads') . '/' . $campaignDetails->cover_image }}">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="causes-details clearfix">
                                            <h2 class="mt-0"><a href="#">JOIN OUR MISSION TO BE A HOPE OF SOMEONE IN
                                                    NEED.</a></h2>
                                            <p class="lead text-theme-colored">Your support will help others to find their
                                                hopes..</p>
                                            <p>Even the smallest acts of kindness and support can have a significant impact
                                                on someone's life. By coming together and joining your mission to help
                                                others, you can make a positive difference in the world.. </p>
                                            <ul class="list-inline clearfix mt-20 ">
                                                <li class="pull-left flip pr-0">Raised: <span
                                                        class="font-weight-700">{{ priceToNprFormat($campaignDetails->summary_total_collection) }}</span>
                                                </li>
                                                <li class="text-theme-colored pull-right flip pr-0">Goal: <span
                                                        class="font-weight-700">{{ priceToNprFormat($campaignDetails->goal_amount) }}</span>
                                                </li>

                                            </ul>
                                            <ul class="list-inline clearfix  mb-20">

                                                <li class="text-theme-colored pull-right flip pr-0">Views: <span
                                                        class="font-weight-700">{{ $campaignDetails->total_visits }}</span>
                                                </li>
                                                @if ($campaignDetails->total_number_donation)
                                                    <li class="pull-left flip pr-0">Donation Made By: <span
                                                            class="font-weight-700">{{ $campaignDetails->total_number_donation }}
                                                            beautiful @if ($campaignDetails->total_number_donation)souls
                                                            @else
                                                                soul @endif.</span>

                                                    </li>
                                                @endif

                                            </ul>

                                            @if ($campaignDetails->campaign_status == 'running')
                                                <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10"
                                                    href="#donationForm" onclick="scrollToElement('donationForm')">Donate
                                                    Now</a>
                                            @elseif (in_array($campaignDetails->campaign_status, ['completed', 'withdrawal-processing', 'withdrawn']))
                                                <a href="#"
                                                    class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Completed</a>
                                            @elseif($campaignDetails->end_date < date('Y-m-d'))
                                                <a href="#"
                                                    class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Expired
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">

                            <div class="target-information pb-sm-20 bg-light pr-0 pb-50 pl-0">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img width="200" class="img-circle" alt="" style="margin: 7px;"
                                            src="{{ asset('/public/uploads') . '/' . imageName($campaignDetails?->owner?->profile_picture, '-medium') }}">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <ul class="list-inline clearfix  mb-20">
                                            <li class="text-theme-colored ">Campaign By: <span
                                                    class="font-weight-700">{{ $campaignDetails->owner->full_name }}
                                                </span>
                                            </li>

                                            <li class="text-theme-colored ">Address: <span
                                                    class="font-weight-700">{{ $campaignDetails?->owner?->address ?? 'N/A' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-center">

                                    <h2
                                        class="bg-theme-colored text-white text-uppercase font-weight-600 p-10 pl-30 pr-30 mt-0">
                                        Target</h2>
                                    <h3 class="font-28 font-weight-300 font-opensans">
                                        {{ priceToNprFormat($campaignDetails->goal_amount) }}</h3>
                                    <div class="donate-piechart">
                                        <div class="piechart-block">
                                            <div class="piechart" data-barcolor="#ccc" data-trackcolor="#fff"
                                                data-percent="{{ calculatePercentageMaxTo100($campaignDetails->summary_total_collection, $campaignDetails->goal_amount) }}"
                                                data-linewidth="8">
                                                <span
                                                    class="percent text-white font-weight-700">{{ calculatePercentageMaxTo100($campaignDetails->summary_total_collection, $campaignDetails->goal_amount) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="legacy-clock" class="flip sm-text-center font-14 mt-10 pt-5 mb-sm-20"></div>

                                    @if ($campaignDetails->campaign_status == 'running')
                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10"
                                            href="#donationForm" onclick="scrollToElement('donationForm')">Donate
                                            Now</a>
                                    @elseif (in_array($campaignDetails->campaign_status, ['completed', 'withdrawal-processing', 'withdrawn']))
                                        <a href="#"
                                            class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Completed
                                            ON {{ $campaignDetails->end_date->format('Y-M-d') }}</a>
                                    @elseif ($campaignDetails->end_date < date('Y-m-d'))
                                        <a href="#"
                                            class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10 disabled">Expired
                                            ON {{ $campaignDetails->end_date->format('Y-M-d') }}</a>
                                    @endif

                                </div>

                            </div>

                            {{-- <h2 class="bg-theme-colored text-white text-uppercase font-weight-600 p-10 pl-30 pr-30 mt-10">
                                BY: {{ $campaignDetails->owner->full_name }} <img
                                    src="{{ asset('public/uploads/' . $campaignDetails->owner->profile_picture, '-medium') }}">
                            </h2> --}}
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <h2 class="mt-4"><a href="#"><u>STORY</u></a></h2>
                            <p> {!! $campaignDetails->description !!} </p>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if ($campaignDetails->campaign_status == 'running')
            <section id="donationForm" class="divider parallax"
                data-bg-img="{{ asset('/public/uploads') . '/' . $campaignDetails->cover_image }}"
                data-parallax-ratio="0.7"
                style="background-image: url('{{ asset('/public/uploads') . '/' . $campaignDetails->cover_image }}'); background-position: 50% 76px;">
                <div class="container pt-0 pb-0">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="bg-light-transparent p-40">

                                <h3 class="mt-0 line-bottom">Make a Donation<span class="font-weight-300"> Now!</span>
                                </h3>
                                <div class="@if ($errors->first('payment_gateway')) has-error @endif">
                                    {{ old('payment_gateway_dynamic'), 'thisisold' }}
                                    <div class="form-group mb-20">
                                        <label for="payment_gateway"><strong>Payment Gateway/Mode</strong></label>
                                        <select id="payment_gateway" onchange="paymentGateway()" name="payment_gateway"
                                            class="form-control" required>
                                            @foreach ($paymentGateways as $keyPaymentGateways => $datumPaymentGateways)
                                                @if ($datumPaymentGateways->slug != 'khalti')
                                                    <option value="{{ $datumPaymentGateways->slug }}"
                                                        @if (old('payment_gateway_dynamic') == $datumPaymentGateways->slug) selected @endif>
                                                        {{ $datumPaymentGateways->name }}
                                                    </option>
                                                @endif
                                                @if ($datumPaymentGateways->slug == 'khalti')
                                                    @php $khaltiPaymentSubCategory = 'khalti'; @endphp
                                                    @php $khaltiPaymentLabel = 'Khalti (Nepal Only)'; @endphp
                                                    <option value="{{ $khaltiPaymentSubCategory }}"
                                                        @if (old('payment_gateway_dynamic') == $khaltiPaymentSubCategory) selected @endif>
                                                        {{ $khaltiPaymentLabel }}
                                                    </option>

                                                    @php $khaltiPaymentSubCategory = 'ebanking-nepal'; @endphp
                                                    @php $khaltiPaymentLabel = 'Ebanking (Nepal Only)'; @endphp
                                                    <option value="{{ $khaltiPaymentSubCategory }}"
                                                        @if (old('payment_gateway_dynamic') == $khaltiPaymentSubCategory) selected @endif>
                                                        {{ $khaltiPaymentLabel }}
                                                    </option>

                                                    @php $khaltiPaymentSubCategory = 'mobile-banking-nepal'; @endphp
                                                    @php $khaltiPaymentLabel = 'Mobile Banking (Nepal Only)'; @endphp
                                                    <option value="{{ $khaltiPaymentSubCategory }}"
                                                        @if (old('payment_gateway_dynamic') == $khaltiPaymentSubCategory) selected @endif>
                                                        {{ $khaltiPaymentLabel }}
                                                    </option>
                                                    @php $khaltiPaymentLabel = 'Connect Ips (Nepal Only)'; @endphp
                                                    @php $khaltiPaymentSubCategory = 'connect-ips-nepal'; @endphp
                                                    <option value="{{ $khaltiPaymentSubCategory }}"
                                                        @if (old('payment_gateway_dynamic') == $khaltiPaymentSubCategory) selected @endif>
                                                        {{ $khaltiPaymentLabel }}
                                                    </option>

                                                    @php $khaltiPaymentSubCategory = 'sct-nepal'; @endphp
                                                    @php $khaltiPaymentLabel = 'SCT (Nepal Only)'; @endphp
                                                    <option value="{{ $khaltiPaymentSubCategory }}"
                                                        @if (old('payment_gateway_dynamic') == $khaltiPaymentSubCategory) selected @endif>
                                                        {{ $khaltiPaymentLabel }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->first('payment_gateway'))
                                            <span
                                                class="text-danger display-block">{{ $errors->first('payment_gateway') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- ONLY FOR ESEWA --}}
                                <form id="esewaDonateFormWithCustomFields" class="esewa-donate-form d-none"
                                    method="POST" action="{{ route('esewaPaymentInitiateV2') }}">
                                    {{-- ESEWA DWFAULT --}}
                                    <input value="0" name="tAmt" id="esewaTotalAmount" type="hidden">
                                    <input value="0" name="amt" id="esewaAmount" type="hidden">
                                    <input value="0" name="txAmt" id="esewaTaxAmount" type="hidden">
                                    <input value="0" name="psc" id="esewaProductServiceCharge" type="hidden">
                                    <input value="0" name="pdc" id="esewaProductDeliveryCharge" type="hidden">
                                    <input value="{{ getPaymentConfigs('esewa')['public_key'] ?? 'EPAYTEST' }}"
                                        name="scd" type="hidden" id="esewaMerchantSecretCode">
                                    <input
                                        value="campaignid_{{ $campaignDetails->id . '_' . microtime(true) . 'donatepur' . mt_rand(0, 99999999) }}"
                                        name="pid" type="hidden" id="esewaUniqueProductKey">
                                    <input value="{{ route('esewaSuccess') }}?q=su" id="esewaSuccessUrl" type="hidden"
                                        name="su">
                                    <input value="{{ route('esewaFailure') }}?q=fu&campaign={{ $campaignDetails->id }}"
                                        id="esewaFailureUrl" type="hidden" name="fu">
                                    {{-- END ESEWA DEFAULT --}}

                                    <input type="hidden" value="esewa" name="payment_gateway_dynamic">
                                    @csrf
                                    <input value="{{ $campaignDetails->id }}" name="campaign_id" type="hidden">

                                    <div class="row">
                                        <input type="hidden" name="campaign_id" value="{{ $campaignDetails->id }}">

                                        <div class="col-sm-12 @if ($errors->first('fullname') && old('payment_gateway_dynamic') == 'esewa') has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Full Name</strong><span class="text-danger">*</span></label>
                                                <input id="esewaFullname" required type="text" maxlength="100"
                                                    name="fullname" min="7"
                                                    value="{{ old('fullname') ?? Auth::guard('frontend_users')->user()?->full_name }}"
                                                    placeholder="Rama Namaya" class="form-control">
                                                @if ($errors->first('fullname') && old('payment_gateway_dynamic') == 'esewa')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('fullname') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12  @if ($errors->first('mobile_number') && old('payment_gateway_dynamic') == 'esewa') has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Mobile Number</strong><span
                                                        class="text-danger">*</span></label>
                                                <input required id="esewaMobileNumber" type="text" maxlength="15"
                                                    minlength="10" name="mobile_number"
                                                    value="{{ old('mobile_number') ?? Auth::guard('frontend_users')->user()?->mobile_number }}"
                                                    placeholder="9841000000" class="form-control">
                                                @if ($errors->first('mobile_number') && old('payment_gateway_dynamic') == 'esewa')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('mobile_number') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('country')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Country</strong><span class="text-danger">*</span></label>
                                                <select id="esewaCountry" required name="country" class="form-control">
                                                    @foreach ($countries as $keyCountries => $datumCountries)
                                                        <option
                                                            @if (!old('country')) @if ($datumCountries->name == 'Nepal') selected @endif
                                                            @endif
                                                            @if (strtolower(old('country') ?? Auth::guard('frontend_users')->user()?->country) == strtolower($datumCountries->name)) selected @endif
                                                            value="{{ strtolower($datumCountries->name) }}">{{ $datumCountries->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->first('country'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('country') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('address') && old('payment_gateway_dynamic') == 'esewa') has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Address</strong><span class="text-danger">*</span></label>
                                                <input required id="esewaAddress" type="text" maxlength="100"
                                                    value="{{ old('address') ?? Auth::guard('frontend_users')->user()?->address }}"
                                                    name="address" placeholder="Tinkune-7,Kathmandu"
                                                    class="form-control">
                                                @if ($errors->first('address') && old('payment_gateway_dynamic') == 'esewa')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('email') && old('payment_gateway_dynamic') == 'esewa') has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Email</strong><span class="text-danger">*</span></label>
                                                <input required id="esewaEmail" required type="email"
                                                    value="{{ old('email') ?? Auth::guard('frontend_users')->user()?->email }}"
                                                    name="email" placeholder="example@example.com"
                                                    class="form-control">
                                                @if ($errors->first('email') && old('payment_gateway_dynamic') == 'esewa')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('amount') && old('payment_gateway_dynamic') == 'esewa') has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Amount (Rs.)</strong><span
                                                        class="text-danger">*</span></label>
                                                <input onkeyup="" required onchange="" id="esewaDonationAmount"
                                                    type="number" min="10" max="100000"
                                                    value="{{ old('amount') }}" placeholder="1000" name="amount"
                                                    class="form-control">
                                                @if ($errors->first('amount') && old('payment_gateway_dynamic') == 'esewa')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('amount') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('description') && old('payment_gateway_dynamic') == 'esewa') has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Description</strong><span
                                                        class="text-danger">*</span></label>
                                                <textarea required minlength="15" maxlength="100" rows="6" id="esewaDescription" name="description"
                                                    class="form-control" value="description" placeholder="Description">{{ old('description') }}</textarea>
                                                @if ($errors->first('description') && old('payment_gateway_dynamic') == 'esewa')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <button type="submit"
                                                    class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30"
                                                    data-loading-text="Please wait..." id="esewaDonateBtn">Donate with
                                                    Esewa</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- END ONLY FOR ESEWA --}}

                                {{-- KHALTI --}}
                                <form id="khaltiDonateForm" class="khalti-donate-form"
                                    action="{{ route('getDonation') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }} <input type="hidden" value="khalti"
                                        name="payment_gateway_dynamic">
                                    <div class="row">
                                        <input type="hidden" name="campaign_id" value="{{ $campaignDetails->id }}">

                                        <div class="col-sm-12 @if ($errors->first('fullname') && old('payment_gateway_dynamic') == 'khalti') has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Full Name</strong><span class="text-danger">*</span></label>
                                                <input id="khaltiFullname" required type="text" maxlength="100"
                                                    name="fullname" min="7"
                                                    value="{{ old('fullname') ?? Auth::guard('frontend_users')->user()?->full_name }}"
                                                    placeholder="Rama Namaya" class="form-control">
                                                @if ($errors->first('fullname') && old('payment_gateway_dynamic') == 'khalti')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('fullname') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12  @if ($errors->first('mobile_number')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Mobile Number</strong><span
                                                        class="text-danger">*</span></label>
                                                <input required id="khaltiMobileNumber" type="text" maxlength="15"
                                                    minlength="10" name="mobile_number"
                                                    value="{{ old('mobile_number') ?? Auth::guard('frontend_users')->user()?->mobile_number }}"
                                                    placeholder="9841000000" class="form-control">
                                                @if ($errors->first('mobile_number') && old('payment_gateway_dynamic') == 'khalti')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('mobile_number') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('country')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Country</strong><span class="text-danger">*</span></label>
                                                <select id="khaltiCountry" required name="country" class="form-control">
                                                    @foreach ($countries as $keyCountries => $datumCountries)
                                                        <option
                                                            @if (!old('country')) @if ($datumCountries->name == 'Nepal') selected @endif
                                                            @endif
                                                            @if (strtolower(old('country') ?? Auth::guard('frontend_users')->user()?->country) == strtolower($datumCountries->name)) selected @endif
                                                            value="{{ strtolower($datumCountries->name) }}">{{ $datumCountries->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->first('country'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('country') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('address')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Address</strong><span class="text-danger">*</span></label>
                                                <input required id="khaltiAddress" type="text" maxlength="100"
                                                    value="{{ old('address') ?? Auth::guard('frontend_users')->user()?->address }}"
                                                    name="address" placeholder="Tinkune-7,Kathmandu"
                                                    class="form-control">
                                                @if ($errors->first('address') && old('payment_gateway_dynamic') == 'khalti')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('email')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Email</strong><span class="text-danger">*</span></label>
                                                <input required id="khaltiEmail" required type="email"
                                                    value="{{ old('email') ?? Auth::guard('frontend_users')->user()?->email }}"
                                                    name="email" placeholder="example@example.com"
                                                    class="form-control">
                                                @if ($errors->first('email') && old('payment_gateway_dynamic') == 'khalti')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('amount')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Amount (Rs.)</strong><span
                                                        class="text-danger">*</span></label>
                                                <input required id="khaltiDonationAmount" type="number" min="10"
                                                    max="1000000" value="{{ old('amount') }}" placeholder="1000"
                                                    name="amount" class="form-control">
                                                @if ($errors->first('amount') && old('payment_gateway_dynamic') == 'khalti')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('amount') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('description')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Description</strong><span
                                                        class="text-danger">*</span></label>
                                                <textarea required minlength="15" maxlength="100" rows="6" id="khaltiDescription" name="description"
                                                    class="form-control" value="description" placeholder="Description">{{ old('description') }}</textarea>
                                                @if ($errors->first('description') && old('payment_gateway_dynamic') == 'khalti')
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <a onclick="khaltiOnClick()"
                                                    class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30"
                                                    data-loading-text="Please wait..." id="khaltiDonateBtn">Donate</a>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- END KHALTI --}}


                                {{-- BANK --}}
                                <form id="offlineDonateForm" class="offline-donate-form d-none"
                                    action="{{ route('getDonation') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="bank" name="payment_gateway_dynamic">
                                    <div class="row">
                                        <input type="hidden" name="campaign_id" value="{{ $campaignDetails->id }}">
                                        <div class="col-md-12" style="border: 1px solid #000; margin: 10px;">
                                            <div class="form-group mb-20 ">
                                                <h4>Please transfer your donation amount in following bank details.</h4>
                                                <label>SWIFT CODE:
                                                </label>{{ getPaymentConfigs('bank')['swift_code'] ?? 'KMBLNPKA' }}<br>
                                                <label>Account Name:
                                                </label>{{ getPaymentConfigs('bank')['account_name'] ?? 'N/A' }}<br>
                                                <label>Account No:
                                                </label>{{ getPaymentConfigs('bank')['account_number'] ?? 'N?A' }}</br>
                                                <label>Bank Name:
                                                </label>{{ !empty(($paymentConfigs = getPaymentConfigs('bank'))['fullname']) ? $paymentConfigs['fullname'] : setting('bank.bank_name') }}</br>
                                                @if (getPaymentConfigs('bank')['qr_image'])
                                                    <label>QR: </label><br> <img height="100"
                                                        src="{{ asset('/public/uploads') . '/' . getPaymentConfigs('bank')['qr_image'] ?? setting('bank.bank_qr') }}">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('fullname')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Full Name</strong><span class="text-danger">*</span></label>
                                                <input required type="text" maxlength="100" name="fullname"
                                                    min="7"
                                                    value="{{ old('fullname') ?? Auth::guard('frontend_users')->user()?->full_name }}"
                                                    placeholder="Rama Namaya" class="form-control">
                                                @if ($errors->first('fullname'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('fullname') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12  @if ($errors->first('mobile_number')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Mobile Number</strong><span
                                                        class="text-danger">*</span></label>
                                                <input required id="mobileNumber" type="text" maxlength="15"
                                                    minlength="10" name="mobile_number"
                                                    value="{{ old('mobile_number') ?? Auth::guard('frontend_users')->user()?->mobile_number }}"
                                                    placeholder="9841000000" class="form-control">
                                                @if ($errors->first('mobile_number'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('mobile_number') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('country')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Country</strong><span class="text-danger">*</span></label>
                                                <select required name="country" class="form-control">
                                                    @foreach ($countries as $keyCountries => $datumCountries)
                                                        <option
                                                            @if (!old('country')) @if ($datumCountries->name == 'Nepal') selected @endif
                                                            @endif
                                                            @if (strtolower(old('country') ?? Auth::guard('frontend_users')->user()?->country) == strtolower($datumCountries->name)) selected @endif
                                                            value="{{ strtolower($datumCountries->name) }}">{{ $datumCountries->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->first('country'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('country') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('address')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Address</strong><span class="text-danger">*</span></label>
                                                <input required type="text" maxlength="100"
                                                    value="{{ old('address') ?? Auth::guard('frontend_users')->user()?->address }}"
                                                    name="address" placeholder="Tinkune-7,Kathmandu"
                                                    class="form-control">
                                                @if ($errors->first('address'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('email')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Email</strong><span class="text-danger">*</span></label>
                                                <input required type="email"
                                                    value="{{ old('email') ?? Auth::guard('frontend_users')->user()?->email }}"
                                                    name="email" placeholder="example@example.com"
                                                    class="form-control">
                                                @if ($errors->first('email'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('amount')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Amount (Rs.)</strong><span
                                                        class="text-danger">*</span></label>
                                                <input required id="donationAmount" type="number" min="10"
                                                    max="500000" value="{{ old('amount') }}" placeholder="1000"
                                                    name="amount" class="form-control">
                                                @if ($errors->first('amount'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('amount') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 @if ($errors->first('payment_receipt')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Payment Receipt (Screenshot of above
                                                        transaction.)</strong><span class="text-danger">*</span></label>
                                                <input required id="payment_receipt" accept=".jpg, .jpeg, .png, .pdf"
                                                    type="file" name="payment_receipt" placeholder=""
                                                    class="form-control">
                                                @if ($errors->first('payment_receipt'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('payment_receipt') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 @if ($errors->first('description')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Description</strong><span
                                                        class="text-danger">*</span></label>
                                                <textarea required minlength="15" maxlength="100" rows="6" id="description" name="description"
                                                    class="form-control" value="description" placeholder="Description">{{ old('description') }}</textarea>
                                                @if ($errors->first('description'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <a id="offlineDonateBtn" type="button"
                                                    class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30"
                                                    data-loading-text="Please wait...">Donate Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- END BANK --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if (count($topDonors))
            <section class="bg-lighter" id="donors">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-300 m-0">Thankful for the positivity and inspiration
                                            beautiful souls bring. Cheers to those selfless donors.</h5>
                                        <h2 class="mt-0 text-uppercase font-28">Top <span
                                                class="font-30 text-theme-colored">Donors.</span></h2>
                                        <div class="icon">
                                            <i class="fa fa-hospital-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-carousel-6col" data-nav="true">
                                @foreach ($topDonors as $datumDonors)
                                    <div class="item text-center">
                                        <img alt="" src="{{ $datumDonors['profile_pic'] }}">
                                        <div class="donor-details bg-white">
                                            <h4 class="m-0 pt-10 text-theme-colored">
                                                {{ $datumDonors['name'] ? $datumDonors['name'] : 'Anonymous' }}</h4>
                                            <p class="font-12">
                                                Donated : {{ priceToNprFormat($datumDonors['amount']) }}<br>
                                                Date :{{ $datumDonors['donation_date'] }}
                                            </p>
                                            <p class="font-12 pb-10">
                                            </p>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
@if ($campaignDetails->campaign_status == 'running')
    @section('scripts')
        <script>
            var checkoutKhalti = null;
            var paymentGatewayValue = null;
            var rawValues = null;
            var khaltiDonateBtn = null;
            var khaltiConfig = null;
        </script>
        <script>
            function paymentGateway(staticVal = '') {
                paymentGatewayValue = $('#payment_gateway').val();
                if (!staticVal) {
                    paymentGatewayValue = $('#payment_gateway').val();
                } else {
                    paymentGatewayValue = staticVal;
                }

                rawValues = paymentGatewayValue;
                $('.khalti-donate-form').addClass('d-none');
                $('.offline-donate-form').addClass('d-none');
                $('.esewa-donate-form').addClass('d-none');
                let validValuesKhalti = ['khalti', 'ebanking-nepal', 'mobile-banking-nepal', 'connect-ips-nepal', 'sct-nepal'];
                console.log(paymentGatewayValue, 'dsfsdfsdfsdf');
                if (paymentGatewayValue == 'bank') {
                    console.log('inside bank');
                    $('.offline-donate-form').removeClass('d-none');
                } else if (validValuesKhalti.includes(paymentGatewayValue)) {
                    console.log('inside khalti');
                    /* khalti types */
                    paymentGatewayValue = paymentGatewayValue.toUpperCase().replace('-NEPAL', '').replace('-', '_');
                    /*end khalti types  */
                    $('.khalti-donate-form').removeClass('d-none');
                } else if (paymentGatewayValue == 'esewa') {
                    console.log('inside esewa');
                    $('.esewa-donate-form').removeClass('d-none');
                    esewaDataMappingWithourSessionSet();
                }

            }
        </script>

        <script>
            function scrollToAnyError() {
                let ifAnyError = "{{ $errors->any() }}";
                if (ifAnyError == 1) {

                    Swal.fire({
                        title: 'Invalid data given!',
                        text: "Please look at the form you submitted.",
                        icon: "error",
                        showCancelButton: false
                    }).then((result) => {
                        let donationAmount = document.getElementById("donationAmount");
                        if ($('#payment_gateway').val() == 'bank') {
                            donationAmount.scrollIntoView({
                                behavior: "smooth"
                            });
                        }
                        if (result.isConfirmed) {
                            let donateFormElement = document.getElementById("khaltiDonationAmount");
                            if ($('#payment_gateway').val() == 'khalti') {
                                donateFormElement.scrollIntoView({
                                    behavior: "instant"
                                });
                            }

                            let donationAmount = document.getElementById("donationAmount");
                            if ($('#payment_gateway').val() == 'bank') {
                                donationAmount.scrollIntoView({
                                    behavior: "instant"
                                });
                            }


                            let esewaDonationAmount = document.getElementById("esewaDonationAmount");
                            if ($('#payment_gateway').val() == 'esewa') {
                                esewaDonationAmount.scrollIntoView({
                                    behavior: "instant"
                                });
                            }
                        }
                    });



                }
            }

            $(document).ready(function() {
                $(window).scroll(function() {
                    paymentGateway($('#payment_gateway').val());
                });

                $('#donationForm').submit(function() {
                    $("#preloader").show();
                });
                // Set your target end date and time (year, month - 1, day, hour, minute, second)
                const targetDate = new Date("{{ $campaignDetails->end_date }}");
                targetDate.setHours(targetDate.getHours() + 23);
                targetDate.setMinutes(targetDate.getMinutes() + 59);
                targetDate.setSeconds(targetDate.getSeconds() + 59);
                let targetDateTimer = targetDate.getTime();

                function updateTimer() {
                    const now = new Date();
                    const timeDifference = targetDate - now;

                    if (timeDifference > 0) {
                        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                        const timerDisplay = `${days}d ${hours}h ${minutes}m ${seconds}s remaining`;
                        $('#legacy-clock').text(timerDisplay);
                    } else {
                        $('#legacy-clock').text('Timer Expired!');
                        clearInterval(timerInterval);
                    }
                }
                updateTimer();
                const timerInterval = setInterval(updateTimer, 1000);
                const oldPaymentGateway = "{{ old('payment_gateway_dynamic') }}";
                paymentGateway(oldPaymentGateway);
                if (!oldPaymentGateway) {
                    paymentGateway($('#payment_gateway').val());
                }

                /* hover */
                let $mousemoveKhalti = $('#khaltiDonateBtn');
                let $mouseMoveBank = $('#offlineDonateBtn');
                let $mouseMoveEsewa = $('#esewaDonateBtn');
                $mousemoveKhalti.hover(function(event) {
                    paymentGateway($('#payment_gateway').val());
                });
                $mouseMoveBank.hover(function(event) {
                    paymentGateway($('#payment_gateway').val());
                });
                $mouseMoveEsewa.hover(function(event) {
                    paymentGateway($('#payment_gateway').val());
                });
                /* hover */
                scrollToAnyError();


            });
        </script>
        {{-- BANK OFFLINE --}}
        <script>
            $("#offlineDonateBtn").click(function() {
                /* check validation */
                const form = document.getElementById("offlineDonateForm");
                if (!form.checkValidity()) {
                    // Display validation messages
                    for (const element of form.elements) {
                        if (element.tagName === "INPUT" && !element.validity.valid) {
                            showKhaltiForm = false;
                            element.reportValidity();
                        }

                        if (element.tagName === "TEXTAREA" && !element.validity.valid) {
                            showKhaltiForm = false;
                            element.reportValidity();
                        }
                    }
                }
                /* end check validation */
                if (form.checkValidity()) {
                    $("#offlineDonateForm").submit();
                }
            });
        </script>
        {{-- BANK OFFLINE --}}

        {{-- FOR KHALTI --}}
        <script>
            function setupKhalti() {
                var price = 0;
                // var public_key = "{{ env('KHALTI_PUBLIC_KEY') }}";
                var public_key = "{{ getPaymentConfigs('khalti')['public_key'] ?? '' }}";
                var app_url = "{{ env('APP_URL') }}";
                var app_name = "{{ env('APP_NAME') }}";
                khaltiConfig = {
                    // replace the publicKey with yours
                    "publicKey": public_key,
                    "productIdentity": "{{ $campaignDetails?->id }}",
                    "productName": '{{ $campaignDetails?->slug }}',
                    "productUrl": "{{ route('campaignDetailPage', $campaignDetails?->slug) }}",
                    /* "paymentPreference": [
                        "KHALTI",
                        "EBANKING",
                        "MOBILE_BANKING",
                        "CONNECT_IPS",
                        "SCT",
                    ], */
                    paymentPreference: [paymentGatewayValue],
                    "eventHandler": {
                        onSuccess(payload) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-Token': '{{ csrf_token() }}'
                                }
                            });
                            $.ajax({
                                // url: app_url + '/payment/khalti/verfication',
                                url: "{{ getPaymentConfigs('khalti')['callback_url'] ?? '' }}",
                                type: 'GET',
                                data: {
                                    amount: payload.amount,
                                    trans_token: payload.token,
                                    form_data: $("#khaltiDonateForm").serializeArray(),
                                    campaign_id: "{{ $campaignDetails->id }}",
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(responseSuccess) {
                                    $("#preloader").hide();
                                    if (responseSuccess.type == 'error') {
                                        Swal.fire('Error!', responseSuccess.msg, 'error');
                                    } else {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: responseSuccess.msg,
                                            icon: 'success',
                                            showCancelButton: false
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                    }
                                    let currentUrl = window.location.href;
                                    currentUrl = currentUrl.split("#")[0]
                                    $('html, body').animate({
                                        scrollTop: $("#donors").offset().top
                                    }, 1000);
                                },
                                error: function(error) {
                                    console.log(error, 'verification error');
                                    $("#preloader").hide();
                                    Swal.fire('Error!', 'Error. Please try again.', 'error');
                                },
                                complete: function() {
                                    // Hide the loader when the request is complete (regardless of success or error)
                                    $("#preloader").hide();
                                }

                            })

                        },
                        onError(error) {
                            console.log(error, 'iamhere');
                            $("#preloader").hide();
                            Swal.fire('Error!', 'Error. Please try again.', 'error');
                        },
                        onClose() {
                            $("#preloader").hide();
                        }
                    }
                };
                checkoutKhalti = new KhaltiCheckout(khaltiConfig);
            }

            function khaltiOnClick() {
                setupKhalti();
                let showKhaltiForm = true;
                /* check validation */
                const form = document.getElementById("khaltiDonateForm");
                if (!form.checkValidity()) {
                    // Display validation messages
                    for (const element of form.elements) {
                        if (element.tagName === "INPUT" && !element.validity.valid) {
                            showKhaltiForm = false;
                            element.reportValidity();
                        }
                        if (element.tagName === "TEXTAREA" && !element.validity.valid) {
                            showKhaltiForm = false;
                            element.reportValidity();
                        }
                    }
                }
                /* end check validation */
                if (form.checkValidity()) {
                    event.preventDefault();
                    let khaltiFullname = $('#khaltiFullname').val().trim();
                    let khaltiMobileNumber = $('#khaltiMobileNumber').val().trim();
                    let khaltiCountry = $('#khaltiCountry').val().trim();
                    let khaltiAddress = $('#khaltiAddress').val().trim();
                    let khaltiEmail = $('#khaltiEmail').val().trim();
                    let khaltiDonationAmount = $('#khaltiDonationAmount').val().trim();
                    let khaltiDescription = $('#khaltiDescription').val().trim();
                    if (khaltiFullname.length < 6 && khaltiFullname.length > 100) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Fullname should be between 6 to 100 characters.', 'error');
                    }
                    if (khaltiMobileNumber.length > 15 ?? khaltiMobileNumber.length <= 6) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Mobile number should be between 6 and  15 characters.', 'error');
                    }
                    if (!khaltiCountry.length) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Country field is required.', 'error');
                    }
                    if (khaltiAddress.length > 100 ?? khaltiAddress.length < 5) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Address should be more than 5 characters.', 'error');
                    }

                    if (khaltiEmail.length > 100 && khaltiEmail.length < 6) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Email should be more than 5 characters.', 'error');
                    }
                    if (khaltiDescription.length < 15) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Description should be more than 15 characters.', 'error');
                    }
                    khaltiDonationAmount = parseInt(khaltiDonationAmount);
                    if (khaltiDonationAmount == '' ?? khaltiDonationAmount < 10 ?? khaltiDonationAmount > 1000000) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Donation amount should be between Rs. 10 and Rs. 1,000,000.', 'error');
                    }
                    if (khaltiDonationAmount < 10) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Amount must be greater or equals to Rs.10.', 'error');
                    }
                    if (showKhaltiForm) {
                        $("#preloader").show();
                        checkoutKhalti.show({
                            amount: khaltiDonationAmount * 100
                        });
                    }
                }
            }
        </script>
        {{-- END FOR KHALTI --}}

        {{-- LOCATION TRACCER --}}
        <script>
            // Get user's IP address
            fetch('https://api.ipify.org?format=json')
                .then(response => response.json())
                .then(data => {
                    // Get user's latitude and longitude using Geolocation API
                    navigator.geolocation.getCurrentPosition(
                        position => {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            /* save location */
                            let url = "{{ url('/save-location/') . '/' . $campaignDetails->id }}";
                            var postData = {
                                ip: data.ip,
                                campaign_id: "{{ $campaignDetails->id }}",
                                latitude: latitude,
                                longitude: longitude,
                                _token: "{{ csrf_token() }}"
                            };
                            $.ajax({
                                url: url,
                                method: "POST",
                                data: JSON.stringify(postData),
                                contentType: "application/json",
                                success: function(data) {
                                    console.log(data);
                                },
                                error: function(xhr, status, error) {
                                    console.log("An error occurred: " + error);
                                }
                            });
                            /* end save location */

                        },
                        error => {
                            /* save location */
                            let url = "{{ url('/save-location/') . '/' . $campaignDetails->id }}";
                            var postData = {
                                ip: data.ip,
                                campaign_id: "{{ $campaignDetails->id }}",
                                _token: "{{ csrf_token() }}"
                            };
                            $.ajax({
                                url: url,
                                method: "POST",
                                data: JSON.stringify(postData),
                                contentType: "application/json",
                                success: function(data) {
                                    console.log(data);
                                },
                                error: function(xhr, status, error) {
                                    console.log("An error occurred: " + error);
                                }
                            });
                            /* end save location */
                            console.error('Error getting location:', error);
                        }
                    );
                })
                .catch(error => {
                    console.error('Error getting IP:', error);
                });
        </script>
        {{-- END LOCATION TRACCER --}}
    @endsection
@endif
