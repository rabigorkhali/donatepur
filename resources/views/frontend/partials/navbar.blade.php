<header id="header" class="header">
    <div
        class="header-nav navbar-fixed-top header-dark navbar-white navbar-transparent bg-transparent-1 navbar-sticky-animated animated-active">
        <div class="header-nav-wrapper">
            <div class="container">
                <nav id="menuzord-right" class="menuzord default no-bg">
                    <a class="menuzord-brand pull-left flip" href="{{ url('/') }}"><img
                            src="{{ asset('uploads') . '/' . imageName(setting('site.logo')) }}" alt=""></a>
                    <ul class="menuzord-menu">
                        <li class="{{ frontendActiveButton('fontendDefaultPage') }}"><a
                                href="{{ route('fontendDefaultPage') }}">Home</a></li>
                        
                        @if (Auth::guard('frontend_users')->user())
                            <li class="{{ frontendActiveButton('my.dashboard') }}"><a href="{{ route('my.dashboard') }}">My Account</a>
                            </li>
                        @endif
                        <li class=""><a href="{{ route('my.campaigns.create') }}">Raise Fund</a></li>
                        <li class=""><a href="{{ route('fontendDefaultPage') }}">Donate</a></li>
                        {{-- <li><a href="#">Get Involved</a>
                            <ul class="dropdown">
                                <li><a href="html/2016/charitypress-html/demo/page-fundraise.html">Fundraise</a></li>
                                <li><a href="html/2016/charitypress-html/demo/page-donate.html">Donate</a></li>
                                <li><a href="html/2016/charitypress-html/demo/page-run-a-race.html">Run a Race</a></li>
                                <li><a href="html/2016/charitypress-html/demo/page-campaign.html">Campaign</a></li>
                                <li><a href="html/2016/charitypress-html/demo/page-philanthropy.html">Philanthropy</a>
                                </li>
                            </ul>
                        </li> --}}

                        @if (Auth::guard('frontend_users')->user())
                            <li class="{{ frontendActiveButton('logout') }}"><a
                                    href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endif

                        @if (!Auth::guard('frontend_users')->user())
                            <li class="{{ frontendActiveButton('login') }}"><a href="{{ route('login') }}">Login</a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
