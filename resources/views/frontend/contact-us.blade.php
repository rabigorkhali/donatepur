<!DOCTYPE html>
<html lang="en">
@include('frontend.partials.header')
@section('header')
    <link href="{{ asset('css/hw6988xr5wVK.css"') }}' rel="stylesheet">
    <link href="{{ asset('css/dhOekHaJFcHo.css"') }}' rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/25TAGQy49wUu.css') }}" rel="stylesheet">

    <!-- Plugins for this template -->
    <link href="{{ asset('css/PcEFAJXYzFJ8.css') }}" rel="stylesheet">
    <link href="{{ asset('css/QAj80uqOeakW.css') }}" rel="stylesheet">
    <link href="{{ asset('css/P8blwPfivG48.css') }}" rel="stylesheet">
    <link href="{{ asset('css/FAe7vZtQp7Is.css') }}" rel="stylesheet">
    <link href="{{ asset('css/f59liuD2rXbX.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nN51oWxX6Tkp.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/KEb1lG2o7KpK.css') }}" rel="stylesheet">
@endsection

<body class="contact-page">
    <div class="page-wrapper">
        @include('frontend.partials.loader')
        @include('frontend.partials.navbar')
        {{-- put here section --}}
        <!-- start page-title-wrapper -->
        <section class="page-title-wrapper">
            <div class="page-title">
                <h1>Contact Us</h1>
            </div>
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="causes.html">Contact Us</a></li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- end page-title-wrapper -->

        <section class="contact-section-wrapper" id="contact">
            <div class="container contact-block">
                <div class="row">
                    <div class="col col-xs-12">
                        <h2>Contact us for any kind of query. We are available 24/7</h2>
                        <div class="contact-info">
                            <p>Welcome !

                                We are delighted that you've taken the time to visit our Contact Us page. Whether you have questions, feedback, or simply want to get in touch, we are here to assist you. Your satisfaction is our top priority, and we strive to provide excellent customer service.
                                
                                Feel free to reach out to us using any of the contact options provided. Our dedicated teams are ready to address your inquiries, support you with your orders, and assist you with any other needs you may have.
                                
                                We value your input and look forward to hearing from you. Thank you for choosing us, and we are excited to connect with you!
                                
                                Best regards,
                                The Donatepur Team</p>
                            <ul>
                                <li>
                                    <span class="icon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    Bhaktapur, <br>Nepal

                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="fa fa-phone-square"></i>
                                    </span>
                                    +977-9702236623
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    hello@donatepur.com
                                </li>

                                {{-- <li>
                                    <span class="icon">
                                        <i class="fa fa-map-o"></i>
                                    </span>
                                    <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3677.7898246149844!2d89.5601340147084!3d22.810250485060976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff901d89110f01%3A0x8dbefa2e360efc60!2z4Kaw4Kef4KeH4KayIOCmruCni-CnnA!5e0!3m2!1sbn!2sbd!4v1486012212575"
                                        class="view-map-btn map-link">View Location In Map</a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="contact-form">
                            <form class="form" id="contact-form" method="POST" action="{{route('frontendContactusCreate')}}"
                                novalidate="novalidate">
                                @csrf
                                <div style="display:none;">
                                    <label for="honeypot">Email</label>
                                    <input type="honeypot" name="honeypot" id="honeypot">
                                </div>
                                <div>
                                    <input type="text" required name="name" class="form-control" placeholder="Full Name">
                                </div>
                                <div>
                                    <input type="email" required name="email" class="form-control" placeholder="Email">
                                </div>
                                <div>
                                    <input type="text" required name="phone" class="form-control" placeholder="Phone no..">
                                </div>
                                <div>
                                    <textarea required class="form-control" name="message" placeholder="write"></textarea>
                                </div>
                                <div class="submit-btn">
                                    <div class="btn-wrapper">
                                        <button type="submit" class="btn theme-btn" data-text="Submit">Submit</button>
                                        <span id="loader"><img src="{{asset('frontend/images/EaH0FlyGCe51.gif')}}" alt="Loader"></span>
                                    </div>
                                </div>
                                <div class="col col-md-12 error-handling-messages">
                                    <div id="success">Thank you</div>
                                    <div id="error"> Error occurred while sending email. Please try again later.
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
</body>

</html>
