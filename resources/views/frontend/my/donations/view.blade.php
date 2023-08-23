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
            <li class="breadcrumb-item "><a href="{{ url('/my/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ url('/my/donations') }}">Donations</a></li>
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
                                <th style="width:20%">Campaign Details:</th>
                                <td>
                                    <strong style="color: #555;">Title: </strong>
                                    {{ $thisModelDetail->campaign->title }}<br>
                                    <strong style="color: #555;">Campaign Status: </strong>
                                    {{ ucfirst($thisModelDetail->campaign->campaign_status) }}<br>
                                    <strong style="color: #555;">Goal: </strong>
                                    {{ 'Rs.' . $thisModelDetail->campaign->goal_amount }}<br>
                                    <strong style="color: #555;">Collected: </strong>
                                    {{ 'Rs.' . $thisModelDetail->campaign->total_collection }}<br>
                                    <strong style="color: #555;">Start Date: </strong>
                                    {{ $thisModelDetail->campaign->start_date }}<br>
                                    <strong style="color: #555;">End Date: </strong>
                                    {{ $thisModelDetail->campaign->end_date }}<br>
                                    <strong style="color: #555;">Remaining Days to Expire: </strong>
                                    {{ getDaysDiffByTwoDate($thisModelDetail->campaign->start_date, $thisModelDetail->campaign->end_date) }}
                                    Days <br>

                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%">Payment Details:</th>
                                <td>
                                    <strong style="color: #555;">Payment Gateway: </strong>
                                    {{ $thisModelDetail->paymentGateway->name }}<br>
                                    <strong style="color: #555;">Transaction Date: </strong>
                                    {{ $thisModelDetail->created_at->format('Y-m-d H:i:s') }}<br>
                                    <strong style="color: #555;">Payment Status: </strong>
                                    {{ ucfirst($thisModelDetail->payment_status) }}<br>
                                    <strong style="color: #555;">Amount: </strong>
                                    {{ 'Rs.' . $thisModelDetail->amount }}<br>
                                    <strong style="color: #555;">Applicable Service Charge: </strong>
                                    {{ $thisModelDetail->service_charge_percentage . '%' }}<br>
                                    <strong style="color: #555;">Net Amount Beneficiary will receive: </strong>
                                    {{ 'Rs.' . $thisModelDetail->amount - ($thisModelDetail->amount * $thisModelDetail->service_charge_percentage) / 100 }}<br>
                                    <strong style="color: #555;">Transaction Id: </strong>
                                    {{ $thisModelDetail->transaction_id }}<br>
                                    <strong style="color: #555;">Mobile Number: </strong>
                                    {{ $thisModelDetail->mobile_number ?? 'N/A' }}<br>
                                    <strong style="color: #555;">Receipt: </strong>
                                    @if ($thisModelDetail->payment_receipt)
                                    <br>
                                        <a href="{{ asset('public/uploads/' . $thisModelDetail->payment_receipt) }}"
                                            target="_blank">
                                            <img class="img-thumbnail" style="height:50"
                                                src="{{ asset('public/uploads/' . $thisModelDetail->payment_receipt) }}"
                                                width="200">
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                    <br>

                                </td>
                            </tr>

                            <tr>
                                <th style="width:20%;">Donor Details</th>
                                <td>
                                    <strong style="color: #555;">Name: </strong>
                                    {{ $thisModelDetail->fullname }}<br>
                                    <strong style="color: #555;">Username: </strong>
                                    {{ $thisModelDetail->giver->username }}<br>
                                    <strong style="color: #555;">Email: </strong>
                                    {{ $thisModelDetail->email }}<br>
                                    <strong style="color: #555;">Mobile Number: </strong>
                                    {{ $thisModelDetail->mobile_number }}<br>
                                    <strong style="color: #555;">Address: </strong>
                                    {{ $thisModelDetail->address }}<br>
                                    <strong style="color: #555;">Country: </strong>
                                    {{ $thisModelDetail->country }}<br>

                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Receiver Details</th>
                                <td>
                                    <strong style="color: #555;">Name: </strong>
                                    {{ $thisModelDetail->receiver->full_name }}<br>
                                    <strong style="color: #555;">Username: </strong>
                                    {{ $thisModelDetail->receiver->username }}<br>
                                    <strong style="color: #555;">Email: </strong>
                                    {{ $thisModelDetail->receiver->email }}<br>
                                    <strong style="color: #555;">Mobile Number: </strong>
                                    {{ $thisModelDetail->receiver->mobile_number }}<br>
                                    <strong style="color: #555;">Address: </strong>
                                    {{ $thisModelDetail->receiver->address }}<br>
                                    <strong style="color: #555;">Country: </strong>
                                    {{ $thisModelDetail->receiver->country }}<br>

                                </td>
                            </tr>

                            <tr>
                                <th style="width:20%;">Is Anonymous?</th>
                                <td> <strong style="color: #555;">
                                        @if ($thisModelDetail->is_anonymous == 0)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </strong>
                                    <br>
                                    <span> Note: If it's yes, donor's identity will be hidden in our website.</span>
                                </td>
                            </tr>

                            <tr>
                                <th style="width:20%;">Is Verified?</th>
                                <td> <strong style="color: #555;">
                                        @if ($thisModelDetail->is_verified == 0)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </strong>
                                    <br>
                                </td>
                            </tr>

                            <tr>
                                <th style="width:20%;">Description</th>
                                <td>
                                    <textarea rows="10" readonly style="width: 100%;"> {{ $thisModelDetail->description }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th> <a href="{{ route('my.donations.list') }}" rel="noopener"
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
