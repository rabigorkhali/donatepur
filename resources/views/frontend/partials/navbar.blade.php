        <!-- Start header -->
        <header class="site-header header-style1">

            <!-- start topbar -->
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-8 col-md-7 col-sm-6 info">
                            <ul>
                                <li><i class="fi flaticon-envelope-of-white-paper"></i> {{setting('site.site_email')}}</li>
                                <li><i class="fi flaticon-cellphone"></i> {{setting('site.mobile_number')}} </li>
                            </ul>
                        </div>
                        <div class="col col-lg-4 col-md-5 col-sm-6">
                            <div class="social-follow-donate">
                                {{-- <div class="social-follow">
                                    <span>Follow us</span>
                                    <ul class="social-links">
                                        <li><a href="{{setting('site.twitter_url')}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="{{setting('site.facebook_url')}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    </ul>
                                </div> --}}
                                <div class="donate">
                                    <a href="#"><i class="fi flaticon-money-4"></i> Donate</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div> <!-- end container -->
            </div>
            <!-- end topbar -->

            <!-- navigation -->  
            <nav class="navigation navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/')}}"><img height="50" src="{{asset('uploads').'/'.setting('site.logo')}}" alt=""></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navigation-menu-holder navbar-right">
                        <button class="close-navbar"><i class="fa fa-close"></i></button>
                        <ul class="nav navbar-nav">
                            {{-- <li class="sub-menu">
                                <a href="#">Home</a>
                                <ul>
                                    <li class="current"><a href="index.html">Home style 1</a></li>
                                    <li><a href="index-2.html">Home style 2</a></li>
                                    <li><a href="index-3.html">Home style 3</a></li>
                                </ul>
                            </li> --}}
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/page/about-us')}}">About</a></li>
                            <li><a href="{{url('page/how-it-works')}}">How it works?</a></li>
                            
            
                            <li><a href="{{ url('/contact-us')}}">Contact Us</a></li>
                        </ul>
                    </div><!-- end of nav-collapse -->


{{--                     <div class="search-mini-cart">
                        <div class="search header-search-area">
                            <a href="#" class="open-btn">
                                <i class="fi flaticon-magnifying-glass"></i>
                            </a>
                            <div class="header-search-form">
                                <form class="form" method="POST" action="SaveWeb2zip-order.php">
                                    <div>
                                        <input type="text" class="form-control" placeholder="Search here">
                                    </div>
                                    <button type="submit" class="btn"><i class="fi flaticon-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="mini-cart-wrapper">
                            <div class="mini-cart-btn">
                                <a href="#">
                                    <i class="fi flaticon-paper-bag"></i>
                                    <span class="item-count">21</span>
                                </a>
                            </div>
                            <ul class="mini-cart">
                                <li class="item">
                                    <div class="product-img">
                                        <img src="images/O878lTIDZvkg.jpg" alt="">
                                    </div>
                                    <div class="product-details">
                                        <h6>Name of the product</h6>
                                        <p>$255.5</p>
                                        <a href="#"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product-img">
                                        <img src="images/RrWJdj4xoND8.jpg" alt="">
                                    </div>
                                    <div class="product-details">
                                        <h6>Name of the product</h6>
                                        <p>$155.5</p>
                                        <a href="#"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </li>
                                <li class="minicart-price-total">
                                    <div class="price-total">
                                        <span class="label-price-total">Subtotal</span>
                                        <div class="price-total-w">
                                            <span>$255.5</span>
                                        </div>
                                    </div>
                
                                    <div class="checkout-btn">
                                        <a class="btn theme-btn">Proceed to checkout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div><!-- end of container -->
            </nav> <!-- end navigation -->
        </header>
        <!-- end of header -->
