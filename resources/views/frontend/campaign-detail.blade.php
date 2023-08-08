@extends('frontend.master')
@section('title', 'Home')
@section('content')
    @dump($campaignDetails->start_date)
    @dump($campaignDetails->end_date)
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-stellar-background-ratio="0.5"
            data-bg-img="{{ asset('uploads') . '/' . $campaignDetails->cover_image }}"
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
                                                src="{{ asset('uploads') . '/' . $campaignDetails->cover_image }}">
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
                                            <ul class="list-inline clearfix mt-20 mb-20">
                                                <li class="pull-left flip pr-0">Raised: <span
                                                        class="font-weight-700">{{ priceToNprFormat($campaignDetails->summary_total_collection) }}</span>
                                                </li>
                                                <li class="text-theme-colored pull-right flip pr-0">Goal: <span
                                                        class="font-weight-700">{{ priceToNprFormat($campaignDetails->goal_amount) }}</span>
                                                </li>
                                            </ul>
                                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10"
                                                href="#donationForm" onclick="scrollToElement('donationForm')">Donate
                                                Now</a>
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

                                    <a href="#donationForm" onclick="scrollToElement('donationForm')"
                                        class="btn btn-theme-colored mt-20">Donate Now</a>
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

        <section id="donationForm" class="divider parallax"
            data-bg-img="{{ asset('uploads') . '/' . $campaignDetails->cover_image }}" data-parallax-ratio="0.7"
            style="background-image: url('{{ asset('uploads') . '/' . $campaignDetails->cover_image }}'); background-position: 50% 76px;">
            <div class="container pt-0 pb-0">
                <div class="row">
                    <div class="col-md-8">
                        <div class="bg-light-transparent p-40">
                            <h3 class="mt-0 line-bottom">Make a Donation<span class="font-weight-300"> Now!</span></h3>
                            <form action="{{ route('getDonation') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 @if ($errors->first('payment_mode')) has-error @endif">
                                        <div class="form-group mb-20 ">
                                            <input type="hidden" value="{{ $campaignDetails->slug }}"
                                                name="campaign_slug">
                                            <label><strong>Payment Type</strong></label> <br>
                                            <label class="radio-inline  ">
                                                <input onchange="paymentTypeChange('online')" type="radio"
                                                    @if (old('payment_mode') == 'online' || !old('payment_mode')) checked @endif value="online"
                                                    name="payment_mode">
                                                Online
                                            </label>
                                            <label class="radio-inline">
                                                <input onchange="paymentTypeChange('offline')" type="radio"
                                                    value="offline" name="payment_mode"
                                                    @if (old('payment_mode') == 'offline') checked @endif>
                                                Offline
                                            </label>
                                            @if ($errors->first('payment_mode'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('payment_mode') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-12 online  @if (old('payment_mode') == 'offline') d-none @endif @if ($errors->first('payment_gateway')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Payment Gateway</strong></label> <br>


                                            @foreach ($paymentGateways as $keyPaymentGateways => $datumPaymentGateways)
                                                <label class="radio-inline">
                                                    <input type="radio" @if (!old('payment_gateway') && $datumPaymentGateways->slug == 'khalti') checked @endif
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

                                    <div class="col-sm-12 @if ($errors->first('fullname')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Full Name</strong></label>
                                            <input type="text" maxlength="100" name="fullname"
                                                value="{{ old('fullname') }}" placeholder="Rama Namaya"
                                                class="form-control">
                                            @if ($errors->first('fullname'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('fullname') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div
                                        class="col-sm-12 offline   @if (old('payment_mode') == 'online') d-none @endif  @if ($errors->first('mobile_number')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Mobile Number</strong></label>
                                            <input type="text" maxlength="15" name="mobile_number"
                                                value="{{ old('mobile_number') }}" placeholder="9841000000"
                                                class="form-control">
                                            @if ($errors->first('mobile_number'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('mobile_number') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 @if ($errors->first('country')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Country</strong></label>
                                            <select name="country" class="form-control">
                                                @foreach ($countries as $keyCountries => $datumCountries)
                                                    <option
                                                        @if (!old('country')) @if ($datumCountries->name == 'Nepal') selected @endif
                                                        @endif
                                                        @if (old('country') == strtolower($datumCountries->name)) selected @endif
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
                                            <input type="text" maxlength="200" value="{{ old('address') }}"
                                                name="address" placeholder="Tinkune-7,Kathmandu" class="form-control">
                                            @if ($errors->first('address'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-sm-12 @if ($errors->first('email')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Email</strong></label>
                                            <input type="email" value="{{ old('email') }}" name="email"
                                                placeholder="example@example.com" class="form-control">
                                            @if ($errors->first('email'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 @if ($errors->first('amount')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Amount (Rs.)</strong></label>
                                            <input type="text" min="10" max="500000"
                                                value="{{ old('amount') }}" placeholder="1000" name="amount"
                                                class="form-control">
                                            @if ($errors->first('amount'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('amount') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div
                                        class="col-sm-12 offline @if (old('payment_mode') == 'online') d-none @endif @if ($errors->first('payment_receipt')) has-error @endif">
                                        <div class="form-group mb-20">
                                            <label><strong>Payment Receipt</strong></label>
                                            <input type="file" name="payment_receipt" placeholder=""
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
                                            <textarea rows="6" name="description" class="form-control" value="description" placeholder="Description">{{ old('description') }} </textarea>
                                            @if ($errors->first('description'))
                                                <span
                                                    class="text-danger display-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-flat btn-dark btn-theme-colored mt-10 pl-30 pr-30"
                                                data-loading-text="Please wait...">Donate Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (count($topDonors))
            <section class="bg-lighter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-300 m-0">Happy Donate</h5>
                                        <h2 class="mt-0 text-uppercase font-28">Our <span
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
                                            <h4 class="m-0 pt-10 text-theme-colored">{{ $datumDonors['name'] }}</h4>
                                            <p class="font-12 pb-10">Donated :
                                                {{ priceToNprFormat($datumDonors['amount']) }}
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

@section('scripts')
    <script>
        function paymentTypeChange(value) {
            if (value == 'offline') {
                $('.offline').removeClass('d-none');
                $('.online').addClass('d-none');
            } else {
                $('.online').removeClass('d-none');
                $('.offline').addClass('d-none');
            }
        }
    </script>

    <script>
        /*         $(document).ready(function() {
                    const targetDate = new Date();
                    targetDate.setHours(targetDate.getHours() + 23);
                    targetDate.setMinutes(targetDate.getMinutes() + 59);
                    targetDate.setSeconds(targetDate.getSeconds() + 59);
                    let targetDateTimer = targetDate.getTime();

                    function updateTimer() {
                        const now = new Date("{{ $campaignDetails->start_date }}");
                        now.setHours(now.getHours() + 00);
                        now.setMinutes(now.getMinutes() + 00);
                        now.setSeconds(now.getSeconds() + 00);
                        let startTimer = now.getTime();

                        const timeDifference = targetDateTimer - startTimer;
                        console.log(targetDateTimer);
                        console.log(startTimer, 'sdfsdf');
                        console.log(timeDifference, 'sdfsdf');

                        if (timeDifference > 0) {
                            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                            const timerDisplay = `${days}D ${hours}H ${minutes}M ${seconds}S`;
                            $('#legacy-clock').text(timerDisplay);
                        } else {
                            $('#legacy-clock').text('This campaign has expired!');
                            clearInterval(timerInterval);
                        }
                    }

                    updateTimer();
                    const timerInterval = setInterval(updateTimer, 1000);
                }); */

        $(document).ready(function() {

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

                    const timerDisplay = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                    $('#legacy-clock').text(timerDisplay);
                } else {
                    $('#legacy-clock').text('Timer Expired!');
                    clearInterval(timerInterval);
                }
            }

            updateTimer();
            const timerInterval = setInterval(updateTimer, 1000);
        });
    </script>
@endsection
