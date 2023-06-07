<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.header')
<body>
    <div class="page-wrapper">
        @include('frontend.partials.loader')
        @include('frontend.partials.navbar')
        {{-- put here section --}}
        <!-- start of hero -->
        <section class="hero hero-slider-wrapper hero-slider-s1">
            <div class="hero-slider">
                <div class="slide">
                    <img src="images/KXa4pn47bUnY.jpg" alt="" class="slider-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col col-xs-12 slide-caption">
                                <h1>We can’t do it alone without your support</h1>
                                <p>Help us to eradicate poverty around the world and save the million of lives from
                                    unwanted
                                    demises. Millions of innocent lives we lost every year for malnutritions.</p>
                                <a href="#" class="btn theme-btn">Join us</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slide row">
                    <img src="images/RRsQ2uTTLwzD.jpg" alt="" class="slider-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col col-xs-12 slide-caption">
                                <h1>We can’t do it alone without your support</h1>
                                <p>Help us to eradicate poverty around the world and save the million of lives from
                                    unwanted
                                    demises. Millions of innocent lives we lost every year for malnutritions.</p>
                                <a href="#" class="btn theme-btn">Join us</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                    @foreach ($topCauses as $topCausesKey => $topCausesDatum)
                        <div class="col col-md-4 col-xs-6">
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
                                    <p>{{ substr($topCausesDatum->description, 0, 100) }}. </p>
                                    <a href="#" class="btn theme-btn-s3">Donate</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div> <!-- end row -->
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
                                <span class="counter" data-count="12">00</span>
                            </div>
                            <h3>Years of Experience</h3>
                        </div>
                    </div>

                    <div class="col col-sm-3 col-xs-6">
                        <div class="grid">
                            <div class="circle-data">
                                <span class="counter" data-count="14">00</span>
                            </div>
                            <h3>Thousands Volunteers</h3>
                        </div>
                    </div>

                    <div class="col col-sm-3 col-xs-6">
                        <div class="grid">
                            <div class="circle-data">
                                <span class="counter" data-count="23">00</span>
                            </div>
                            <h3>Worldwide Offices</h3>
                        </div>
                    </div>

                    <div class="col col-sm-3 col-xs-6">
                        <div class="grid">
                            <div class="circle-data">
                                <span class="counter" data-count="97">00</span>
                            </div>
                            <h3>Assisting Organizations</h3>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end fun-fact -->


        <!-- start urgent-causes-section -->
        <section class="urgent-causes-section section-padding">
            <div class="container">
                <div class="row section-title">
                    <div class="col col-md-8 col-md-offset-2">
                        <h2>Urgent Causes</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                    </div>
                </div> <!-- end section-title -->

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="urgent-causes-inner urgent-causes-slider carousel-dots-with-nav">
                            <div class="cause">
                                <div class="img-holder">
                                    <img src="images/QN8UUHkWDueA.jpg" alt="" class="img img-responsive">
                                </div>
                                <div class="cause-details-wrapper">
                                    <div class="case-title">
                                        <span class="tag">Feauted</span>
                                        <h3>Boston Kindergarten Science Lab</h3>
                                        <span class="remaning-day">01 day remaining</span>
                                    </div>
                                    <div class="causes-details">
                                        <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                            dolore
                                            magna aliqua. Ut enim ad minim veniam, quis nostrud exercita tion ullamco
                                            laboris.
                                        </p>
                                        <div class="donation">
                                            <h4>Donation</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-s2 " data-percent="85"></div>
                                            </div>
                                            <div class="goal-raised">
                                                <div class="raised">
                                                    <h5>Raised</h5>
                                                    <span>$41,089</span>
                                                </div>
                                                <div class="goal">
                                                    <h5>Goal</h5>
                                                    <span>$50,000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn theme-btn">Donate now</a>
                                    </div>
                                </div>
                            </div> <!-- end cause -->

                            <div class="cause">
                                <div class="img-holder">
                                    <img src="images/QN8UUHkWDueA.jpg" alt="" class="img img-responsive">
                                </div>
                                <div class="cause-details-wrapper">
                                    <div class="case-title">
                                        <span class="tag">Feauted</span>
                                        <h3>Boston Kindergarten Science Lab</h3>
                                        <span class="remaning-day">01 day remaining</span>
                                    </div>
                                    <div class="causes-details">
                                        <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                            dolore
                                            magna aliqua. Ut enim ad minim veniam, quis nostrud exercita tion ullamco
                                            laboris.
                                        </p>
                                        <div class="donation">
                                            <h4>Donation</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-s2 " data-percent="85"></div>
                                            </div>
                                            <div class="goal-raised">
                                                <div class="raised">
                                                    <h5>Raised</h5>
                                                    <span>$41,089</span>
                                                </div>
                                                <div class="goal">
                                                    <h5>Goal</h5>
                                                    <span>$50,000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn theme-btn">Donate now</a>
                                    </div>
                                </div>
                            </div> <!-- end cause -->

                            <div class="cause">
                                <div class="img-holder">
                                    <img src="images/QN8UUHkWDueA.jpg" alt="" class="img img-responsive">
                                </div>
                                <div class="cause-details-wrapper">
                                    <div class="case-title">
                                        <span class="tag">Feauted</span>
                                        <h3>Boston Kindergarten Science Lab</h3>
                                        <span class="remaning-day">01 day remaining</span>
                                    </div>
                                    <div class="causes-details">
                                        <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                            dolore
                                            magna aliqua. Ut enim ad minim veniam, quis nostrud exercita tion ullamco
                                            laboris.
                                        </p>
                                        <div class="donation">
                                            <h4>Donation</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-s2 " data-percent="85"></div>
                                            </div>
                                            <div class="goal-raised">
                                                <div class="raised">
                                                    <h5>Raised</h5>
                                                    <span>$41,089</span>
                                                </div>
                                                <div class="goal">
                                                    <h5>Goal</h5>
                                                    <span>$50,000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn theme-btn">Donate now</a>
                                    </div>
                                </div>
                            </div> <!-- end cause -->
                        </div> <!-- end urgent-causes-inner -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end urgent-causes-section -->

        <!-- start volunteers-->
        <section class="volunteers section-padding">
            <div class="container">
                <div class="row section-title">
                    <div class="col col-md-8 col-md-offset-2">
                        <h2>Featured Volunteers</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                    </div>
                </div> <!-- end section-title -->

                <div class="row volunteers-grids">
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/J1UkIxXc6Jcn.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Dylan rhodes</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/NnML1DavI792.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Ashley jean</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/6c6QowZnG2oq.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Elle Taylor</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/Z4fldBdHr07j.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Bucky Barnes</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/6DWL9JIUbG0i.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Maria Johnson</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/lCcv2AjVN9vh.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Tim Burton</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/XBHl1KHpb8DP.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Anna heather</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3 col-xs-4">
                        <div class="grid">
                            <div class="img-holder">
                                <img src="images/zzp9Oawv0vIQ.jpg" alt="" class="img img-responsive">
                            </div>
                            <div class="volunteers-details">
                                <h4><a href="#">Bobby Caldwel</a></h4>
                                <span class="volunteers-post">CEO, ENVATO</span>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->

                <div class="row">
                    <div class="all-volunteers">
                        <a href="#" class="btn theme-btn">All Volunteers</a>
                    </div>
                </div>
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
