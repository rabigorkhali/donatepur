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
                        <img src="{{ asset('/uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-cropped') }}"
                            alt="" class="slider-bg">
                        <div class="container">
                            <div class="row">
                                <div class="col col-xs-12 slide-caption">
                                    <h1>{{ $sliderBannersDatum->title }}</h1>
                                    <p>

                                        {{ substr($sliderBannersDatum->description, 0, 150) }}....
                                    </p>
                                    <a href="{{ $sliderBannersDatum->go_to_link }}"
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
                        <p>Discover our impactful causes that make a difference in people's lives.</p>
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
                                    <a href="{{ url('campaigns/' . $topCausesDatum->id) }}"> <img
                                            src="{{ asset('/uploads') . '/' . imageName($topCausesDatum->cover_image, '-cropped') }}"
                                            alt="" class="img img-responsive">
                                    </a>
                                    {{-- <img src="{{asset('uploads/').'/'.$topCausesDatum->cover_image}}" alt="" class="img img-responsive"> --}}
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
                                    @if ($topCausesDatum->end_date > date('Y-m-d'))
                                        <span class="remaining-days"><i
                                                class="fi flaticon-calendar-page-with-circular-clock-symbol"></i>
                                            {{ getDaysDiffByToday($topCausesDatum->end_date) }} days remaining</span>
                                    @else
                                        <span class="remaining-days"><i
                                                class="fi flaticon-calendar-page-with-circular-clock-symbol"></i>
                                            Completed</span>
                                    @endif

                                </div>
                                <div class="causes-details">
                                    <p>{{ substr($topCausesDatum->description, 0, 150) }}....<a
                                            href="{{ url('campaigns/' . $topCausesDatum->id) }}">See
                                            More</a> </p>
                                    <a href="{{ url('campaigns/' . $topCausesDatum->id) }}"
                                        class="btn theme-btn-s3">Donate</a>
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
                                <span class="counter" style="font-size:24px;">Nrs.
                                    {{ priceToNprFormat($total_collection) }}</span>
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
        @if ($topDonors->count())
            <section class="volunteers section-padding">
                <div class="container">
                    <div class="row section-title">
                        <div class="col col-md-8 col-md-offset-2">
                            <h2>Our Top Fantastic Donors</h2>
                            <p>{{ setting('site.top_donar_text') }}</p>
                        </div>
                    </div> <!-- end section-title -->

                    <div class="row volunteers-grids">
                        @foreach ($topDonors as $topDonorsKey => $topDonorsDatum)
                            @if ($topDonorsDatum?->publicUser)
                                <div class="col col-md-3 col-xs-4">
                                    <div class="grid">
                                        <div class="img-holder">

                                            <img src="{{ asset('/uploads') . '/' . imageName($topDonorsDatum?->publicUser?->profile_picture, '-cropped') }}"
                                                alt="" class="img img-responsive">
                                        </div>
                                        <div class="volunteers-details">
                                            <h4><a href="#">{{ $topDonorsDatum->fullname }}</a></h4>
                                            <span
                                                class="volunteers-post">{{ ucfirst(ltrim($topDonorsDatum->street_address . ',' . $topDonorsDatum->country, ',')) }}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col col-md-3 col-xs-4">
                                    <div class="grid">
                                        <div class="img-holder">

                                            <img src="https://via.placeholder.com/120x120?text=Image+Not+Available"
                                                alt="" class="img img-responsive">
                                        </div>
                                        <div class="volunteers-details">
                                            <h4><a href="#">{{ $topDonorsDatum->fullname }}</a></h4>
                                            <span
                                                class="volunteers-post">{{ ucfirst(ltrim($topDonorsDatum->street_address . ',' . $topDonorsDatum->country, ',')) }}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div> <!-- end row -->
                    {{-- <div class="row">
                        <div class="all-volunteers">
                            <a href="#" class="btn theme-btn">See All Heroes</a>
                        </div>
                    </div> --}}
                </div> <!-- end container -->
            </section>
        @endif

        <!-- end volunteers-->
        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
    <script>
        const successCallback = (position) => {
            console.log(position);
        };

        const errorCallback = (error) => {
            console.log(error);
        };

        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    </script>
</body>

</html>
