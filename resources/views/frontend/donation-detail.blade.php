<!DOCTYPE html>
<html lang="en">
@section('header')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
@endsection
@include('frontend.partials.header')

<style>
    /* Custom styles for the form */
    .form-container {
        background-color: #f9f9f9;
        padding: 20px;
        margin-top: 50px;
        border-radius: 4px;
    }

    .form-container h2 {
        margin-top: 0;
        margin-bottom: 20px;
    }

    .form-container label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-container input[type=text],
    .form-container input[type=email],
    .form-container input[type=number],
    .form-container textarea,
    .form-container select {
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-container input[type=file] {
        margin-top: 8px;
    }

    .form-container textarea {
        height: 120px;
        resize: vertical;
    }

    .form-container select {
        height: 40px;
    }

    .form-container input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        float: right;
    }

    .form-container input[type=submit]:hover {
        background-color: #45a049;
    }
</style>

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
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/') }}">Causes</a></li>
                        <li>{{ $campaignDetails->title ?? '' }}</li>

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
                                <img src="{{ asset('uploads') . '/' . $campaignDetails->cover_image }}" alt
                                    class="img img-responsive">
                            </div>
                            <div class="causes-list-box">
                                <div class="title">
                                    <h3>{{ $campaignDetails->title }}</h3>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-s1"
                                            data-percent="{{ calculatePercentageMaxTo100($campaignDetails->total_collection, $campaignDetails->goal_amount) }}">
                                        </div>
                                    </div>
                                    <h4>Raised: <span>Rs.{{ $campaignDetails->total_collection ?? 0 }}</span> / Rs.
                                        {{ $campaignDetails->goal_amount ?? 0 }}</h4>
                                </div>
                                <div class="inner-details">
                                    <p>
                                        {{ $campaignDetails->description }}
                                    </p>
                                    {{-- <ul>
                                        <h2>Updates</h2>
                                        <li><i class="fa fa-check"></i> Aspernatur aut odit aut fugit</li>
                                        <li><i class="fa fa-check"></i> Nventore veritatis et quasi architecto</li>
                                        <li><i class="fa fa-check"></i> Con se quuntur magni dolores</li>
                                    </ul> --}}

                                    <div class="form-container">
                                        <h2>Charity Form</h2>
                                        <form action="{{ route('getDonation') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="campaign_id"
                                                value="{{ $campaignDetails->id }}">
                                            <label for="fullname">Name:</label>
                                            <input type="text" id="fullname" name="fullname" required>

                                            <label for="address">Address:</label>
                                            <input type="text" id="address" name="address" required>

                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" required>

                                            <label for="amount">Amount (Rs):</label>
                                            <input type="number" id="amount"  min='0' name="amount" required>

                                            <label for="payment_receipt">Payment Receipt (Rs):</label>
                                            <input type="file" id="payment_receipt" name="payment_receipt"
                                                accept="image/*">
                                                <div style="display:none;">
                                                    <label for="honeypot">Email</label>
                                                    <input type="honeypot" name="honeypot" id="honeypot">
                                                </div>
                                            <label for="description">Description:</label>
                                            <textarea id="description" name="description" rows="4" required maxlength="500"></textarea>


                                            <input type="submit" value="Submit">
                                        </form>
                                    </div>

                                </div> <!-- end inner-details -->
                            </div> <!-- end causes-list-box -->
                        </div> <!-- end causes-single -->
                    </div> <!-- end col -->


                    <div class="col col-md-3 sidebar-wrapper">
                        <div class="sidebar">

                            <div class="widget recent-post">
                                <h3>Donors</h3>
                                @foreach ($topDonors as $datumDonors)
                                    <div>
                                        <h4><a href="#">{{ $datumDonors->fullname }}</a></h4>
                                        <a href="#"
                                            class="date">{{ $datumDonors->created_at->format('F j, Y') }}
                                        </a> <br>
                                        <i class="fa fa-map-marker"></i> {{ $datumDonors->address }}
                                    </div>
                                @endforeach

                            </div>
                        </div> <!-- end sidebar -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end causes-single-wrapper -->

        @include('frontend.partials.footer')
    </div>
    @include('frontend.partials.script')
    <script>
        let success = "{{ session('successDonation') }}";
        if (success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your offline donation has been received. The world need more people like you. Thanks for joining our mission.',
                confirmButtonText: 'OK'
            });
        }
        
    </script>
</body>

</html>
