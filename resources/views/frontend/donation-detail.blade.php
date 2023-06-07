<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.header')

<body class="cause-single-page">
    <div class="page-wrapper">
        @include('frontend.partials.loader')
        @include('frontend.partials.navbar')
        {{-- put here section --}}
        <!-- start page-title-wrapper -->
        <section class="page-title-wrapper">
            <div class="page-title">
                <h1>Single cause</h1>
            </div>
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="causes.html">Causes</a></li>
                        <li>single cause</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- end page-title-wrapper -->


        <!-- start causes-single-wrapper -->
        <section class="causes-single-wrapper section-padding">
            <div class="container">
                <div class="row content">
                    <div class="col col-md-9">
                        <div class="causes-single">
                            <div class="img-holder">
                                <img src="{{ asset('uploads') . '/' . $campaignDetails->cover_image }}" alt class="img img-responsive">
                            </div>
                            <div class="causes-list-box">
                                <div class="title">
                                    <h3>{{$campaignDetails->title}}</h3>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-s1" data-percent="55"></div>
                                    </div>
                                    <h4>Raised: <span>$52,872</span> / $70,000</h4>
                                </div>
                                <div class="inner-details">
                                    <p>
                                        {{$campaignDetails->description}}
                                    </p>
                                    <ul>
                                        <li><i class="fa fa-check"></i> Aspernatur aut odit aut fugit</li>
                                        <li><i class="fa fa-check"></i> Nventore veritatis et quasi architecto</li>
                                        <li><i class="fa fa-check"></i> Con se quuntur magni dolores</li>
                                    </ul>

                                    <div class="donation-form quick-donation-section">
                                        <form action="#" class="form">
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
                                                    <input type="radio" id="c3" name="c1" checked>
                                                    <label for="c3"><span class="check-icon"></span> <span
                                                            class="amount">$500</span></label>
                                                </div>
                                            </div>

                                            <div class="enter-amount">
                                                <input type="text" placeholder="-- Enter Amount --">
                                            </div>
                                            <div class="donate-btn">
                                                <button class="btn theme-btn" type="submit">Donate</button>
                                            </div>
                                        </form>
                                    </div> <!-- end donation-form -->
                                </div> <!-- end inner-details -->
                            </div> <!-- end causes-list-box -->
                        </div> <!-- end causes-single -->
                    </div> <!-- end col -->


                    <div class="col col-md-3 sidebar-wrapper">
                        <div class="sidebar">
                            <div class="widget search-widget">
                                <form action="#" class="form">
                                    <div>
                                        <input type="text" class="form-control" placeholder="Search here" required>
                                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="widget recent-post">
                                <h3>Recent post</h3>
                                <div>
                                    <h4><a href="#">Education program in Uganda</a></h4>
                                    <a href="#" class="date">November 26, 2016</a>
                                </div>
                                <div>
                                    <h4><a href="#">War kids in Syria</a></h4>
                                    <a href="#" class="date">November 26, 2016</a>
                                </div>
                                <div>
                                    <h4><a href="#">African water crisis : Children and women</a></h4>
                                    <a href="#" class="date">November 26, 2016</a>
                                </div>
                            </div>

                            <div class="widget recent-causes">
                                <h3>Recent causes</h3>
                                <div>
                                    <h4><a href="#">Blood Donation in virginia</a></h4>
                                    <p class="remaing-date">22 days remaing</p>
                                </div>
                                <div>
                                    <h4><a href="#">Boston orphanage opening</a></h4>
                                    <p class="remaing-date">22 days remaing</p>
                                </div>
                                <div>
                                    <h4><a href="#">Hair for cancer</a></h4>
                                    <p class="remaing-date">22 days remaing</p>
                                </div>
                            </div>

                            <div class="widget recent-events-widget">
                                <h3>Events nearby</h3>
                                <div class="event-list">
                                    <div class="event-pic">
                                        <a href="#"><img src="images/hD2wUssAmQwS.jpg" alt
                                                class="img img-responsive"></a>
                                    </div>
                                    <div class="event-info">
                                        <h4><a href="#">Towards Humanity</a></h4>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-calender"></i> 17 March, 2017</a></li>
                                            <li><a href="#"><i class="fa fa-map-marker"></i> 221B, Baker
                                                    Street</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end sidebar -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end causes-single-wrapper -->


        <!-- start causes-s2 -->
        <section class="causes-s2 related-causes">
            <div class="container">
                <div class="row section-title">
                    <div class="col col-xs-12">
                        <h2>Related Causes</h2>
                    </div>
                </div> <!-- end section-title -->

                <div class="row causes-s2-grids">
                    <div class="col col-lg-4 col-xs-6">
                        <div class="grid">
                            <div class="img-goal-raised">
                                <div class="img-holder">
                                    <img src="images/VFTLLhieVQUJ.jpg" alt class="img img-responsive">
                                </div>
                                <div class="goal-raised-meter">
                                    <div class="hrvr-center">
                                        <div class="meter-2" data-value="0.9">
                                            <span></span>
                                        </div>
                                        <div class="goal-raised">
                                            <div>
                                                <h4>Raised</h4>
                                                <span>$41,089</span>
                                            </div>
                                            <div>
                                                <h4>Goal</h4>
                                                <span>$50,000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="causes-info">
                                <h3><a href="#">Paint the Boston orphanage</a></h3>
                                <span class="remaining-days"><i
                                        class="fi flaticon-calendar-page-with-circular-clock-symbol"></i> 3 days
                                    remaining</span>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-xs-6">
                        <div class="grid">
                            <div class="img-goal-raised">
                                <div class="img-holder">
                                    <img src="images/ozEdN15k8RGW.jpg" alt class="img img-responsive">
                                </div>
                                <div class="goal-raised-meter">
                                    <div class="hrvr-center">
                                        <div class="meter-2" data-value="0.7">
                                            <span></span>
                                        </div>
                                        <div class="goal-raised">
                                            <div>
                                                <h4>Raised</h4>
                                                <span>$41,089</span>
                                            </div>
                                            <div>
                                                <h4>Goal</h4>
                                                <span>$50,000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="causes-info">
                                <h3><a href="#">Save water for thirsty people</a></h3>
                                <span class="remaining-days"><i
                                        class="fi flaticon-calendar-page-with-circular-clock-symbol"></i> 3 days
                                    remaining</span>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-4 col-xs-6">
                        <div class="grid">
                            <div class="img-goal-raised">
                                <div class="img-holder">
                                    <img src="images/boyQcykoi2zT.jpg" alt class="img img-responsive">
                                </div>
                                <div class="goal-raised-meter">
                                    <div class="hrvr-center">
                                        <div class="meter-2" data-value="0.5">
                                            <span></span>
                                        </div>
                                        <div class="goal-raised">
                                            <div>
                                                <h4>Raised</h4>
                                                <span>$41,089</span>
                                            </div>
                                            <div>
                                                <h4>Goal</h4>
                                                <span>$50,000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="causes-info">
                                <h3><a href="#">Flower sale for charity</a></h3>
                                <span class="remaining-days"><i
                                        class="fi flaticon-calendar-page-with-circular-clock-symbol"></i> 3 days
                                    remaining</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end causes-s2 -->

        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
</body>

</html>
