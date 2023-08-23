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
                <h1>{{$pageDetails->title}}</h1>
            </div>
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>{{ $pageDetails->title ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- end page-title-wrapper -->


        <!-- start causes-single-wrapper -->
        <section class="causes-single-wrapper section-padding" style="padding:0px;">
            <div class="container">
                <div class="row content">
                    <div class="col col-md-12">
                        <div class="causes-single">
                            {{-- <div class="img-holder">
                                <img src="{{ asset('/public/uploads') . '' . $pageDetails->image }}" alt
                                    class="img img-responsive">
                            </div> --}}
                            <div class="causes-list-box">
                                <div class="inner-details">
                                    <p>
                                        {!! $pageDetails->body !!}
                                    </p>
                                    {{-- <ul>
                                        <h2>Updates</h2>
                                        <li><i class="fa fa-check"></i> Aspernatur aut odit aut fugit</li>
                                        <li><i class="fa fa-check"></i> Nventore veritatis et quasi architecto</li>
                                        <li><i class="fa fa-check"></i> Con se quuntur magni dolores</li>
                                    </ul> --}}
                                </div> <!-- end inner-details -->
                            </div> <!-- end causes-list-box -->
                        </div> <!-- end causes-single -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end causes-single-wrapper -->

        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
</body>

</html>
