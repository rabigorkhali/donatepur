@extends('frontend.master')
@section('header')
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
@endsection
@section('title', 'Home')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-stellar-background-ratio="0.5"
            data-bg-img="{{ asset('/public/uploads') . '/' . $campaignDetails->cover_image }}"
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
                                    <div class="form-group mb-20">
                                        <label><strong>Payment Gateway/Mode</strong></label> <br>
                                        @foreach ($paymentGateways as $keyPaymentGateways => $datumPaymentGateways)
                                            <label class="radio-inline">
                                                <input required id="payment_gateway"
                                                    onchange="paymentGateway('{{ $datumPaymentGateways->slug }}')"
                                                    type="radio" @if (!old('payment_gateway') && $datumPaymentGateways->slug == 'khalti') checked @endif
                                                    @if (old('payment_gateway') == $datumPaymentGateways->slug) checked @endif
                                                    value="{{ $datumPaymentGateways->slug }}" name="payment_gateway">
                                                {{ $datumPaymentGateways->name }}
                                            </label>
                                        @endforeach
                                        @if ($errors->first('payment_gateway'))
                                            <span
                                                class="text-danger display-block">{{ $errors->first('payment_gateway') }}</span>
                                        @endif
                                    </div>
                                </div>
                                {{-- ONLY FOR ESEWA --}}
                                <form id="esewaPaymentForm" class="esewa-donation-form"
                                    action="https://uat.esewa.com.np/epay/main" method="POST">
                                    @csrf
                                    <input value="0" name="tAmt" id="esewaTotalAmount" type="hidden">
                                    <input value="0" name="amt" id="esewaAmount" type="hidden">
                                    <input value="0" name="txAmt" id="esewaTaxAmount" type="hidden">
                                    <input value="0" name="psc" id="esewaProductServiceCharge" type="hidden">
                                    <input value="0" name="pdc" id="esewaProductDeliveryCharge" type="hidden">
                                    <input value="EPAYTEST" name="scd" type="hidden" id="esewaMerchantSecretCode">
                                    <input value="785#$%#$#09nb" name="pid" type="hidden"
                                        id="esewaUniqueProductKey">
                                    <input value="{{ route('esewaSuccess') }}?q=su" id="esewaSuccessUrl" type="hidden"
                                        name="su">
                                    <input value="{{ route('esewaFailure') }}?q=fu" id="esewaFailureUrl" type="hidden"
                                        name="fu">
                                </form>
                                {{-- END ONLY FOR ESEWA --}}

                                {{-- KHALTI --}}
                                <form id="khaltiDonateForm" class="khalti-donate-form"
                                    action="{{ route('getDonation') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="bank" name="payment_gateway_dynamic">
                                    <div class="row">
                                        <input type="hidden" name="campaign_id" value="{{ $campaignDetails->id }}">

                                        <div class="col-sm-12 @if ($errors->first('fullname')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Full Name</strong></label>
                                                <input id="khaltiFullname" required type="text" maxlength="100"
                                                    name="fullname" min="7"
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
                                                <label><strong>Mobile Number</strong></label>
                                                <input required id="khaltiMobileNumber" type="text" maxlength="15"
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
                                                <label><strong>Country</strong></label>
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
                                                <label><strong>Address</strong></label>
                                                <input required id="khaltiAddress" type="text" maxlength="100"
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
                                                <label><strong>Email</strong></label>
                                                <input required id="khaltiEmail" required type="email"
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
                                                <label><strong>Amount (Rs.)</strong></label>
                                                <input required id="khaltiDonationAmount" type="number" min="10"
                                                    max="1000000" value="{{ old('amount') }}" placeholder="1000"
                                                    name="amount" class="form-control">
                                                @if ($errors->first('amount'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('amount') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('description')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Description</strong></label>
                                                <textarea rows="6" id="khaltiDescription" name="description" class="form-control" value="description"
                                                    placeholder="Description">{{ old('description') }}</textarea>
                                                @if ($errors->first('description'))
                                                    <span
                                                        class="text-danger display-block">{{ $errors->first('description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <a class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30"
                                                    data-loading-text="Please wait..." id="khaltiDonateBtn">Donate with
                                                    Khalti</a>

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
                                                <label>Account Name: </label>{{ setting('bank.bank_account_name') }}<br>
                                                <label>Account No: </label>{{ setting('bank.bank_account_number') }}</br>
                                                <label>Bank Name: </label>{{ setting('bank.bank_name') }}</br>
                                                <label>QR: </label><br> <img height="100"
                                                    src="{{ asset('/public/uploads') . '/' . setting('bank.bank_qr') }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 @if ($errors->first('fullname')) has-error @endif">
                                            <div class="form-group mb-20">
                                                <label><strong>Full Name</strong></label>
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
                                                <label><strong>Mobile Number</strong></label>
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
                                                <label><strong>Country</strong></label>
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
                                                <label><strong>Address</strong></label>
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
                                                <label><strong>Email</strong></label>
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
                                                <label><strong>Amount (Rs.)</strong></label>
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
                                                        transaction.)</strong></label>
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
                                                <label><strong>Description</strong></label>
                                                <textarea required rows="6" id="description" name="description" class="form-control" value="description"
                                                    placeholder="Description">{{ old('description') }}</textarea>
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

                                                <a class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30 d-none"
                                                    data-loading-text="Please wait..." id="EsewaDonateBtn">Donate with
                                                    Esewa</a>

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
            function paymentGateway(value) {
                $('.khalti-donate-form').addClass('d-none');
                $('.offline-donate-form').addClass('d-none');

                if (value == 'bank') {
                    $("input[type='radio'][name='payment_gateway'][value='bank']").prop("checked", true);
                    $('.offline-donate-form').removeClass('d-none');
                } else if (value == 'khalti') {
                    $("input[type='radio'][name='payment_gateway'][value='khalti']").prop("checked", true);
                    $('.khalti-donate-form').removeClass('d-none');

                } else if (value == 'esewa') {
                    $("input[type='radio'][name='payment_gateway'][value='esewa']").prop("checked", true);
                    $('.esewa-donate-form').addClass('d-none');
                }
            }
        </script>

        <script>
            $(document).ready(function() {

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
                    paymentGateway($('input[name="payment_gateway"]:checked').val());
                }

                /* hover */
                let $mousemoveKhalti = $('#khaltiDonateBtn');
                let $mouseMoveBank = $('#offlineDonateBtn');
                $mousemoveKhalti.hover(function(event) {
                    paymentGateway($('input[name="payment_gateway"]:checked').val());
                });
                $mouseMoveBank.hover(function(event) {
                    paymentGateway($('input[name="payment_gateway"]:checked').val());
                });
                /* hover */

            });
        </script>

        {{-- BANK OFFLINE --}}
        <script>
            $("#offlineDonateBtn").click(function() {

                /* check validation */
                const form = document.getElementById("offlineDonateForm");
                if (!form.checkValidity()) {
                    // Display validation messages
                    console.log(form.elements);
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
            var price = 0;
            var public_key = "{{ env('KHALTI_PUBLIC_KEY') }}";
            var app_url = "{{ env('APP_URL') }}";
            var app_name = "{{ env('APP_NAME') }}";
            var config = {
                // replace the publicKey with yours
                "publicKey": public_key,
                "productIdentity": "{{ $campaignDetails->id }}",
                "productName": '{{ $campaignDetails->slug }}',
                "productUrl": "{{ route('campaignDetailPage', $campaignDetails->slug) }}",
                "paymentPreference": [
                    "KHALTI",
                    "EBANKING",
                    "MOBILE_BANKING",
                    "CONNECT_IPS",
                    "SCT",
                ],
                "eventHandler": {
                    onSuccess(payload) {
                        $.ajax({
                            url: app_url + '/payment/khalti/verfication',
                            type: 'GET',
                            data: {
                                amount: payload.amount,
                                trans_token: payload.token,
                                form_data: $("#khaltiDonateForm").serializeArray(),
                                campaign_id: "{{ $campaignDetails->id }}",
                                donor_id: "{{ $campaignDetails->id }}",
                            },
                            success: function(responseSuccess) {
                                $("#preloader").hide();
                                if (responseSuccess.type == 'error') {
                                    Swal.fire('Error!', responseSuccess.msg, 'error');
                                } else {
                                    Swal.fire('success!', responseSuccess.msg, 'success');
                                }
                                let currentUrl = window.location.href;
                                currentUrl = currentUrl.split("#")[0]
                                $('html, body').animate({
                                    scrollTop: $("#donors").offset().top
                                }, 1000);
                            },
                            error: function(error) {
                                $("#preloader").hide();
                                console.log(error);
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
            var checkout = new KhaltiCheckout(config);
            var btn = document.getElementById('khaltiDonateBtn');
            btn.onclick = function() {
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
                    if (khaltiMobileNumber.length > 15 || khaltiMobileNumber.length <= 6) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Mobile number should be between 6 and  15 characters.', 'error');
                    }
                    if (!khaltiCountry.length) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Country field is required.', 'error');
                    }
                    if (khaltiAddress.length > 100 || khaltiAddress.length < 5) {
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
                    if (khaltiDonationAmount == '' || khaltiDonationAmount < 10 || khaltiDonationAmount > 1000000) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Donation amount should be between Rs. 10 and Rs. 1,000,000.', 'error');
                    }
                    if (khaltiDonationAmount < 10) {
                        showKhaltiForm = false;
                        Swal.fire('Error!', 'Amount must be greater or equals to Rs.10.', 'error');
                    }
                    if (showKhaltiForm) {
                        $("#preloader").show();
                        checkout.show({
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
