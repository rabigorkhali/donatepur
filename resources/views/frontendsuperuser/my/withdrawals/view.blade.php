@extends('adminlte::page')

@section('title', $page_title)


@section('content_header')

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ $page_title }}
            </h2>
        </header>
    </section>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="{{ url('/mysuperuser/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ url('/mysuperuser/withdrawals') }}">Withdrawals</a></li>
            <li class="breadcrumb-item active"><a>Detail</a></li>
        </ol>

    </nav>

@stop

@section('content')
    <div class="invoice p-3 mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:20%">Title:</th>
                                <td>{{ $campaignDetail->title }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Category:</th>
                                <td>{{ $campaignDetail?->category?->title ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Payment Details:</th>
                                <td>
                                    <table border="2">
                                        <tr>
                                            <th>Service</th>
                                            <th>Mobile Number</th>
                                            @if ($withdrawalDetails?->userPaymentGateway?->payment_gateway_name == 'Bank')
                                                <th>Bank Name</th>
                                                <th>Bank Account Number</th>
                                                <th>Bank Address</th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>{{ $withdrawalDetails?->userPaymentGateway?->payment_gateway_name }}</td>
                                            <td>{{ $withdrawalDetails?->userPaymentGateway?->mobile_number }}</td>
                                            @if ($withdrawalDetails?->userPaymentGateway?->payment_gateway_name == 'Bank')
                                                <td>{{ $withdrawalDetails->userPaymentGateway->bank_name }}</td>
                                                <td>{{ $withdrawalDetails?->userPaymentGateway?->bank_account_number }}</td>
                                                <td>{{ $withdrawalDetails?->userPaymentGateway?->bank_address }}</td>
                                            @endif
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Goal Amount</th>
                                <td>{{ numberPriceFormat($campaignDetail->goal_amount) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Total Donation Amount Collected</th>
                                <td>{{ numberPriceFormat($campaignDetail->summary_total_collection) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Withdrawable Amount</th>
                                <td>{{ numberPriceFormat($campaignDetail->net_amount_collection) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Applicable Service charge</th>
                                <td>{{ numberPriceFormat($campaignDetail->summary_service_charge_amount) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Number of Donation</th>
                                <td>{{ $campaignDetail->total_number_donation }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Start Date</th>
                                <td>{{ $campaignDetail->start_date->format('Y-m-d') }}</td>
                            </tr>

                            <tr>
                                <th style="width:20%;">End Date</th>
                                <td>{{ $campaignDetail->end_date->format('Y-m-d') }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Address</th>
                                <td>{{ $campaignDetail->address }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Country</th>
                                <td>{{ ucfirst($campaignDetail->country) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Video Url</th>
                                <td>{{ $campaignDetail->video_url ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Cover Image</th>
                                <td>
                                    <a href="{{ asset('public/uploads/' . $campaignDetail->cover_image) }}" target="_blank">
                                        <img class="img-thumbnail" style="height:100px"
                                            src="{{ asset('public/uploads/' . giveImageName($campaignDetail->cover_image, 'medium')) }}"
                                            height="50">
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th style="width:20%;">Withdrawal Status</th>
                                <td>{{ ucwords(str_replace('-', ' ', $withdrawalDetails->withdrawal_status)) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Status</th>
                                <td>{{ $campaignDetail->status ? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Description</th>
                                <td>
                                    <textarea rows="20" readonly style="width: 100%;"> {{ $campaignDetail->description }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th> <a href="{{ route('my.withdrawals.list') }}" rel="noopener"
                                        class="btn btn-default float-left mb-4"><i class="fas fa-backward"></i> Back</a>
                                </th>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>



        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

    <script>
        $('#description').summernote({
            height: 400, // set editor height
            width: 1140, // set editor height
            focus: true
        });
    </script>
@stop
