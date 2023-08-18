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
                        <li class=""><a href="{{ route('my.campaigns.create') }}">Raise Fund</a></li>
                        <li class="{{ frontendActiveButton('campaignList') }}"><a
                                href="{{ route('campaignList') }}">Donate</a></li>
                        @if (Auth::guard('frontend_users')->user())
                            <li><a href="#">My Account (Hi, {{explode(' ',Auth::guard('frontend_users')->user()->full_name)[0]??'-'}})</a>
                                <ul class="dropdown">
                                    <li class="{{ frontendActiveButton('logout') }}"><a
                                            href="{{ route('logout') }}">Logout</a>
                                    </li>
                                    <li class="{{ frontendActiveButton('my.dashboard') }}"><a
                                            href="{{ route('my.dashboard') }}">Dashboard</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (!Auth::guard('frontend_users')->user())
                            <li class="{{ frontendActiveButton('login') }}"><a
                                    href="{{ route('login') }}">Login/Create Account</a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
