<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.header')
{{-- <style>
    .fun-fact .circle-data {
        max-width: 230px;
        max-height: 230px;
        line-height: 230px;
        border: 3px solid #fff;
        margin: 0 auto 25px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -o-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
    }
</style> --}}
<style>
    .section-padding {
    padding: 10px 0 20px;
}
    </style>

<body>
    <div class="page-wrapper">
        @include('frontend.partials.loader')
        @include('frontend.partials.navbar')
        {{-- put here section --}}
        <!-- start of hero -->
        <section class="hero hero-slider-wrapper hero-slider-s1">
            <div class="hero-slider">
                @foreach ($sliderBanners as $sliderBannersKey => $sliderBannersDatum)
                    <div class="slide">
                        <img src="{{ asset('uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-cropped') }}"
                            alt="" class="slider-bg">
                        <div class="container">
                            <div class="row">
                                <div class="col col-xs-12 slide-caption">
                                    <h1>{{ $sliderBannersDatum->title }}</h1>
                                    <p>
                                        {{ substr($sliderBannersDatum->description, 0, 150) }}....
                                    </p>
                                    <a href="{{ $sliderBannersDatum->url }}"
                                        class="btn theme-btn">{{ $sliderBannersDatum->btn_text }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
        <!-- end of hero slider -->
        <!-- start causes -->
        <section class="causes section-padding">
            <div class="container">
                <div class="row section-title">
                    <div class="col col-md-8 col-md-offset-2">
                        <h2>Top causes</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                    </div>
                </div> <!-- end section-title -->

                <div class="row content">
                    @php
                        $rowCount = 0;
                        $style = '';
                    @endphp

                    @foreach ($topCauses as $topCausesKey => $topCausesDatum)
                        @if ($rowCount == 3)
                            @php
                                $rowCount = 0;
                                $style = 'margin-top:15px;';
                            @endphp
                        @else
                            @php ++$rowCount @endphp
                        @endif
                        <div style="{{ $style }}" class="col col-md-4 col-xs-6">
                            <div class="grid">
                                <div class="img-holder">
                                    <img src="{{ asset('uploads') . '/' . imageName($topCausesDatum->cover_image, '-cropped') }}"
                                        alt="" class="img img-responsive">
                                    {{-- <img src="{{asset('uploads').'/'.$topCausesDatum->cover_image}}" alt="" class="img img-responsive"> --}}
                                </div>
                                <div class="goal-raised">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-s2 "
                                            data-percent="{{ calculatePercentageMaxTo100($topCausesDatum->total_collection, $topCausesDatum->goal_amount) }}">
                                        </div>
                                    </div>

                                    <div class="goal-raised-inner">
                                        <div class="raised">
                                            <h4>Raised: <span>Rs{{ $topCausesDatum->total_collection }}</span></h4>
                                        </div>
                                        <div class="goal">
                                            <h4>Goals: <span>Rs{{ $topCausesDatum->goal_amount }}</span></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="causes-title">
                                    <h3><a
                                            href="{{ url('campaigns/' . $topCausesDatum->id) }}">{{ $topCausesDatum->title }}</a>
                                    </h3>
                                    <span class="remaining-days"><i
                                            class="fi flaticon-calendar-page-with-circular-clock-symbol"></i>
                                        {{ getDaysDiffByToday($topCausesDatum->end_date) }} days remaining</span>
                                </div>
                                <div class="causes-details">
                                    <p>{{ substr($topCausesDatum->description, 0, 150) }}....<a href="">See
                                            More</a> </p>
                                    <a href="#" class="btn theme-btn-s3">Donate</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div> <!-- end container -->
        </section>
        <!-- end causes -->


        <!-- start fun-fact -->
        <section class="fun-fact parallax" data-bg-image="images/fun-fact-bg.jpg" data-speed="3">
            <div class="container">
                <div class="row content start-count">
                    <div class="col col-sm-3 col-xs-6">
                        <div class="grid">
                            <div class="circle-data">
                                <span class="counter" data-count="{{ $total_donars }}">1</span>
                            </div>
                            <h3>Total Donars</h3>
                        </div>
                    </div>

                    <div class="col col-sm-3 col-xs-6">
                        <div class="grid">
                            <div class="circle-data">
                                <span class="counter" data-count="{{ $total_campaign }}">0</span>
                            </div>
                            <h3>Total Campaign</h3>
                        </div>
                    </div>

                    <div class="col col-sm-3 col-xs-6">
                        <div class="grid">
                            <div class="circle-data">
                                <span class="counter"  style="font-size:24px;">Nrs. {{ convertToNepaliFormat($total_collection) }}</span>
                            </div>
                            <h3>Total Donation</h3>
                        </div>
                    </div>

                    <div class="col col-sm-3 col-xs-6">
                        <div class="grid">
                            <div class="circle-data">
                                <span class="counter" data-count="4">00</span>
                            </div>
                            <h3>Assisting Organizations</h3>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end fun-fact -->


        <!-- start volunteers-->
        <section class="volunteers section-padding">
            <div class="container">
                <div class="row section-title">
                    <div class="col col-md-8 col-md-offset-2">
                        <h2>Our Top Fantastic Donors</h2>
                        <p>{{ setting('site.top_donar_text') }}</p>
                    </div>
                </div> <!-- end section-title -->
                @if ($topDonors->count())
                    <div class="row volunteers-grids">
                        @foreach ($topDonors as $topDonorsKey => $topDonorsDatum)
                            <div class="col col-md-3 col-xs-4">
                                <div class="grid">
                                    <div class="img-holder">
                                        
                                        <img src="{{ asset('uploads') . '/' . imageName($topDonorsDatum->publicUser->profile_picture, '-cropped') }}"
                                            alt="" class="img img-responsive">
                                    </div>
                                    <div class="volunteers-details">
                                        <h4><a href="#">{{ $topDonorsDatum->fullname }}</a></h4>
                                        <span class="volunteers-post">{{ucfirst(ltrim($topDonorsDatum->street_address.','.$topDonorsDatum->country, ","))  }}
                                            </span>
                                        {{-- <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div> <!-- end row -->
                    {{-- <div class="row">
                        <div class="all-volunteers">
                            <a href="#" class="btn theme-btn">See All Heroes</a>
                        </div>
                    </div> --}}
                    @endif
            </div> <!-- end container -->
        </section>
        <!-- end volunteers-->


        <!-- start quick-donation-section -->
        <section class="quick-donation-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-md-10 col-md-offset-1">
                        <h2>Quick donation</h2>

                        <div class="donation-form">
                            <form action="SaveWeb2zip-order.php" class="form" method="POST">
                                <div>
                                    <select class="form-control">
                                        <option selected="" disabled=""> - Select Causes - </option>
                                        <option>Case 1</option>
                                        <option>Case 2</option>
                                        <option>Case 3</option>
                                        <option>Case 4</option>
                                    </select>
                                </div>
                                <div class="donate-list">
                                    <div class="box">
                                        <input type="radio" id="c1" name="c1">
                                        <label for="c1"><span class="check-icon"></span> <span
                                                class="amount">$100</span></label>
                                    </div>
                                    <div class="box">
                                        <input type="radio" id="c2" name="c1">
                                        <label for="c2"><span class="check-icon"></span> <span
                                                class="amount">$200</span></label>
                                    </div>
                                    <div class="box active">
                                        <input type="radio" id="c3" name="c1" checked="">
                                        <label for="c3"><span class="check-icon"></span> <span
                                                class="amount">$500</span></label>
                                    </div>
                                    <div class="box">
                                        <input type="radio" id="c4" name="c1">
                                        <label for="c4"><span class="check-icon"></span> <span
                                                class="amount">$1000</span></label>
                                    </div>
                                </div>

                                <div class="donate-as-anonymous">
                                    <input type="checkbox" id="d1">
                                    <label for="d1"> Donate as anonymous</label>
                                </div>

                                <div class="donate-btn">
                                    <button class="btn theme-btn" type="submit">Donate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        {{-- end  put here section --}}
        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
</body>

</html>
