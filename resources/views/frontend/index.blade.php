@extends('frontend.master')
@section('title', 'Home')
@section('content')
    <!-- Start main-content -->
    <div class="main-content">
        <!-- SLIDER -->
        <section id="home">
            <div class="container-fluid p-0">
                <!-- Slider Revolution Start -->
                <div class="rev_slider_wrapper">
                    <div class="rev_slider" data-version="5.0">
                        <ul>
                            <!-- SLIDE 1 -->
                            @foreach ($sliderBanners as $sliderBannersKey => $sliderBannersDatum)
                                <li data-index="rs-1" data-transition="slidingoverlayhorizontal" data-slotamount="default"
                                    data-easein="default" data-easeout="default" data-masterspeed="default"
                                    data-thumb="{{ asset('uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-small') }}"
                                    data-rotate="0" data-saveperformance="off" data-title="Wow Factor" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{ asset('uploads') . '/' . imageName($sliderBannersDatum->cover_image, '-cropped') }}"
                                        alt="" data-bgposition="center center" data-bgfit="cover"
                                        data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- LAYER NR. 1 -->
                                    <div class="tp-caption NotGeneric-Title tp-resizeme text-uppercase" id="rs-1-layer-1"
                                        data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']"
                                        data-y="['top','top','top','top']" data-voffset="['150','150','170','168']"
                                        data-fontsize="['72','72','64','48']" data-lineheight="['100','90','60','60']"
                                        data-width="none" data-height="none" data-whitespace="nowrap"
                                        data-transform_idle="o:1;"
                                        data-transform_in="x:-50px;opacity:0;s:500;e:Power1.easeInOut;"
                                        data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;" data-start="500"
                                        data-splitin="chars" data-splitout="none" data-basealign="slide"
                                        data-responsive_offset="on" data-elementdelay="0.03"
                                        style="z-index: 5; white-space: nowrap; font-size: 40px; line-height: 40px;">
                                        {{ $sliderBannersDatum->title }}
                                    </div>
                                    <!-- LAYER NR. 2 -->
                                    <div class="tp-caption NotGeneric-SubTitle tp-resizeme text-uppercase" id="rs-1-layer-2"
                                        data-x="['left','left','left','left']" data-hoffset="['55','55','55','55']"
                                        data-y="['top','top','top','top']" data-voffset="['160','160','160','160']"
                                        data-width="none" data-height="none" data-whitespace="nowrap"
                                        data-transform_idle="o:1;"
                                        data-transform_in="x:-50px;opacity:0;s:500;e:Power1.easeInOut;"
                                        data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;" data-start="500"
                                        data-splitin="chars" data-splitout="none" data-basealign="slide"
                                        data-responsive_offset="on" data-elementdelay="0.03"
                                        style="z-index: 6; white-space: nowrap; color: rgba(255, 255, 255, 0.50);">
                                        {{ $sliderBannersDatum->sub_title ?? '' }}
                                    </div>
                                    <!-- LAYER NR. 3 -->
                                    <div class="tp-caption Photography-Textblock tp-resizeme" id="rs-1-layer-3"
                                        data-x="['left','left','left','left']" data-hoffset="['55','55','55','55']"
                                        data-y="['top','top','top','top']" data-voffset="['250','250','250','250']"
                                        data-width="380" data-height="150" data-whitespace="normal"
                                        data-transform_idle="o:1;"
                                        data-transform_in="x:-50px;opacity:0;s:500;e:Power1.easeInOut;"
                                        data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;" data-start="500"
                                        data-splitin="chars" data-splitout="none" data-basealign="slide"
                                        data-responsive_offset="on" data-elementdelay="0.01"
                                        style="z-index: 7; min-width: 380px; max-width: 380px; max-width: 180px; max-width: 180px; white-space: normal; font-size: 15px; line-height: 25px;">
                                        {{ substr($sliderBannersDatum->description, 0, 150) }}....
                                    </div>
                                    <!-- LAYER NR. 4 -->
                                    <div class="tp-caption BigBold-Button rev-btn text-uppercase" id="rs-1-layer-4"
                                        data-x="['left']" data-hoffset="['50']" data-y="['top']" data-voffset="['350']"
                                        data-width="none" data-height="none" data-whitespace="nowrap"
                                        data-transform_idle="o:1;"
                                        data-transform_in="x:-50px;opacity:0;s:500;e:Power1.easeInOut;"
                                        data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;" data-start="1000"
                                        data-splitin="none" data-splitout="none" data-basealign="slide"
                                        data-responsive_offset="on" data-responsive="on"
                                        style="z-index: 8; white-space: nowrap;text-transform:left;border-color:rgba(255, 255, 255, 0.25);outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">
                                        <a
                                            href="{{ $sliderBannersDatum->go_to_link }}">{{ $sliderBannersDatum->btn_text }}</a>
                                            <i
                                            style="font-size: .8rem; vertical-align: middle;"
                                            class="fa fa-arrow-circle-right text-white ml-5"></i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end .rev_slider -->
                </div>
                <!-- end .rev_slider_wrapper -->
                <script>
                    $(document).ready(function(e) {
                        $(".rev_slider").revolution({
                            sliderType: "standard",
                            sliderLayout: "fullscreen",
                            dottedOverlay: "none",
                            delay: 3000,
                            navigation: {
                                keyboardNavigation: "on",
                                keyboard_direction: "horizontal",
                                mouseScrollNavigation: "on",
                                onHoverStop: "off",
                                touch: {
                                    touchenabled: "on",
                                    swipe_threshold: 75,
                                    swipe_min_touches: 1,
                                    swipe_direction: "horizontal",
                                    drag_block_vertical: false
                                },
                                bullets: {
                                    enable: true,
                                    hide_onmobile: true,
                                    style: "zeus",
                                    hide_onleave: true,
                                    direction: "vertical",
                                    h_align: "bottom",
                                    v_align: "center",
                                    h_offset: 30,
                                    v_offset: 0,
                                    space: 10,
                                    tmp: ''
                                },
                                thumbnails: {
                                    style: "gyges",
                                    enable: true,
                                    width: 60,
                                    height: 60,
                                    min_width: 60,
                                    wrapper_padding: 0,
                                    wrapper_color: "#000000",
                                    wrapper_opacity: "0",
                                    tmp: '<span class="tp-thumb-img-wrap">  <span class="tp-thumb-image"></span></span>',
                                    visibleAmount: 10,
                                    hide_onmobile: true,
                                    hide_onleave: true,
                                    direction: "horizontal",
                                    span: false,
                                    position: "inner",
                                    space: 10,
                                    h_align: "left",
                                    v_align: "bottom",
                                    h_offset: 30,
                                    v_offset: 30
                                }
                            },
                            responsiveLevels: [1240, 1024, 778, 480],
                            gridwidth: [1170, 1024, 778, 480],
                            gridheight: [600, 768, 960, 720],
                            lazyType: "none",
                            parallax: {
                                origo: "slidercenter",
                                speed: 1000,
                                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                                type: "scroll"
                            },
                            shadow: 0,
                            spinner: "off",
                            stopLoop: "on",
                            stopAfterLoops: 0,
                            stopAtSlide: -1,
                            shuffle: "off",
                            autoHeight: "off",
                            hideThumbsOnMobile: "off",
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            debugMode: false,
                            fallbacks: {
                                simplifyAll: "off",
                                nextSlideOnWindowFocus: "off",
                                disableFocusListener: false
                            }
                        });
                    });
                </script>
                <!-- Slider Revolution Ends -->
            </div>
        </section>
        {{-- END SLIDER --}}

        <!-- Section: Featured Projects  -->
        @if ($featuredCauses->count())

            <section>
                <div class="container">
                    <div class="section-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="font-weight-300 m-0">What we can do?</h5>
                                <h2 class="mt-0 text-uppercase font-28">Featured <span
                                        class="text-theme-colored font-weight-400">Projects</span> <span
                                        class="font-30 text-theme-colored">.</span></h2>
                                <div class="icon">
                                    <i class="fa fa-hospital-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="owl-carousel-3col" data-dots="true">
                                    @foreach ($featuredCauses as $featuredCausesKey => $featuredCausesDatum)
                                        <div class="item mb-10">
                                            <div class="image-box-thum">
                                                <img height="239" class="img-fullwidth" alt=""
                                                    src="{{ asset('uploads') . '/' . imageName($featuredCausesDatum->cover_image) }}">
                                            </div>
                                            <div class="image-box-details bg-lighter p-15 pt-20 pb-sm-20">
                                                <h3 class="title mt-0 mb-5"><a
                                                        href="#">{{ $featuredCausesDatum->title }}</a></h3>
                                                <div class="project-meta mb-10 font-12">
                                                    <span class="mr-10"><i class="fa fa-tags"></i> <a rel="tag"
                                                            href="#">{{ $featuredCausesDatum->category->title }}</a></span>
                                                </div>
                                                <p class="desc mb-10">
                                                    {{ substr($featuredCausesDatum->description, 0, 140) }}...</p>
                                                <div class="progress-item mt-0">
                                                    <div class="progress mb-10">
                                                        <div data-percent="{{ calculatePercentageMaxTo100($featuredCausesDatum->summary_total_collection, $featuredCausesDatum->goal_amount) }}"
                                                            class="progress-bar"><span class="percent">0</span></div>
                                                    </div>
                                                </div>
                                                <ul class="list-inline project-conditions text-center bg-deep m-0 p-10">
                                                    <li class="current-fund">
                                                        <strong>{{ calculatePercentageMaxTo100($featuredCausesDatum->summary_total_collection, $featuredCausesDatum->goal_amount) }}%</strong>funded
                                                    </li>
                                                    <li class="target-fund">
                                                        <strong>{{ priceToNprFormat($featuredCausesDatum->goal_amount) }}</strong>target
                                                    </li>
                                                    <li class="remaining-days">
                                                        <strong>{{ getDaysDiffByToday($featuredCausesDatum->end_date) }}</strong>days
                                                        to go
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
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
                            @foreach ($topDonors as $topDonorsKey => $topDonorsDatum)
                                <div class="item text-center">
                                  <img alt="" src="{{ $topDonorsDatum['profile_pic']??''}}">
                                  <div class="donor-details bg-white">
                                      <h4 class="m-0 pt-10 text-theme-colored">{{ $topDonorsDatum['name']??''}}</h4>
                                      <p class="font-12 pb-10">Donated : {{ priceToNprFormat($topDonorsDatum['amount']??'')}}<br>Rank : {{ $topDonorsKey}}</p>

                                  </div>
                                </div>
                                @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Divider: Funfact -->
        <section class="divider parallax layer-overlay overlay-white-8"
            data-bg-img="{{ asset('frontend/images/bg/bg2.jpg') }}" data-parallax-ratio="0.7">
            <div class="container pt-90 pb-90">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-smile text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom" data-value="{{$total_donars}}"
                                    data-animation-duration="1500">0</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Happy Donators</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-rocket text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom" data-value="{{$total_campaign}}"
                                    data-animation-duration="1500">0</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Successful Campaigns</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-add-user text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom" data-value="{{$total_public_users}}"
                                    data-animation-duration="1200">0</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Total Users</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-cash text-black-light mt-20 font-48 pull-left flip"></i>
                            <div class="ml-60">
                                <h2 class="animate-number text-theme-colored mt-0 font-48 line-bottom" data-value="{{$total_collection}}"
                                    data-animation-duration="1500">Rs.</h2>
                                <div class="clearfix"></div>
                                <h4 class="font-14">Total Collection</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Latest Projects  -->
        <section>
            <div class="container">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="font-weight-300 m-0">What we can do?</h5>
                            <h2 class="mt-0 text-uppercase font-28">Latest <span
                                    class="text-theme-colored font-weight-400">Projects</span> <span
                                    class="font-30 text-theme-colored">.</span></h2>
                            <div class="icon">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="row">
                        @foreach ($recentCauses as $recentCausesKey => $recentCausesDatum)

                        <div class="col-xs-12 col-sm-6 col-md-4 mb-30">
                            <div class="image-box-thum">
                                <img height="239" class="img-fullwidth" alt=""
                                    src="{{ asset('uploads') . '/' . imageName($recentCausesDatum->cover_image) }}">
                            </div>
                            <div class="image-box-details bg-lighter p-15 pt-20 pb-sm-20">
                                <h3 class="title mt-0 mb-5"><a href="#">{{ $recentCausesDatum->category->title }}</a></h3>
                                <div class="project-meta mb-10 font-12">
                                    <span class="mr-10"><i class="fa fa-tags"></i> <a rel="tag"
                                            href="#">{{ $recentCausesDatum->category->title }}</a></span>
                                </div>
                                <p class="desc mb-10">
                                    {{ substr($recentCausesDatum->description, 0, 140) }}...</p>
                                <div class="progress-item mt-0">
                                    <div class="progress mb-10">
                                        <div data-percent="{{ calculatePercentageMaxTo100($recentCausesDatum->summary_total_collection, $recentCausesDatum->goal_amount) }}"
                                            class="progress-bar"><span class="percent">0</span></div>
                                    </div>
                                </div>
                                <ul class="list-inline project-conditions text-center bg-deep m-0 p-10">
                                    <li class="current-fund">
                                        <strong>{{ calculatePercentageMaxTo100($recentCausesDatum->summary_total_collection, $recentCausesDatum->goal_amount) }}%</strong>funded
                                    </li>
                                    <li class="target-fund">
                                        <strong>{{ priceToNprFormat($recentCausesDatum->goal_amount) }}</strong>target
                                    </li>
                                    <li class="remaining-days">
                                        <strong>{{ getDaysDiffByToday($recentCausesDatum->end_date) }}</strong>days
                                        to go
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="col-md-12">
                            <div class="text-center">
                                <a class="btn btn-default btn-lg" href="#">Show More Projects</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- Divider: testimonials -->
        <section class="bg-light">
            <div class="container pb-0">
                <h3 class="mt-0 line-bottom mb-30"><span class="font-weight-300">Clients </span> Testimonials</h3>
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <div class="owl-carousel-2col boxed" data-dots="true">
                            @foreach($testimonials as $testimonialsKey => $testimonialsDatum)
                            <div class="item">
                                <div class="testimonial pt-10">
                                    <div class="thumb pull-left mb-0 mr-0 pr-20">
                                        <img width="75" class="img-circle" alt=""
                                            src="{{ asset('uploads') . '/' . imageName($testimonialsDatum->profile_picture,'-cropped') }}">
                                    </div>
                                    <div class="ml-100 ">
                                        <h4 class="mt-0 font-weight-300">{{$testimonialsDatum->message}}</h4>
                                        <p class="author mt-20">- <span class="text-black-333">{{$testimonialsDatum->name}},</span>
                                            <small><em>{{$testimonialsDatum->designation}}</em></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container pb-30">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel-6col clients-logo text-center">
                                @foreach($partners as $partnersKey => $partnersDatum)
                                <div class="item"> <a href="#"><img class="img-responsive"
                                            src="{{ asset('uploads') . '/' . imageName($partnersDatum->logo,'-cropped') }}" alt=""></a>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end main-content -->
@endsection
