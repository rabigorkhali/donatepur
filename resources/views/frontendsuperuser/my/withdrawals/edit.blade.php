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
            <li class="breadcrumb-item active"><a>Request</a></li>
        </ol>
    </nav>
@stop

@section('content')
    <form method="post" action="{{ route('mysuperuser.withdrawals.update', $withdrawalDetail->id) }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                @php $formInputName='campaign_id'; @endphp
                <x-adminlte-select2 id="{{ $formInputName }}" required name="{{ $formInputName }}"
                    value="{{ old($formInputName) }}" label="Campaigns (Note: Only completed campaigns will be listed.)"
                    label-class="" data-placeholder="Select Campaign...">
                    <option value="none" selected>Select Campaign</option>
                    @foreach ($campaigns as $campaignsDatum)
                        <option value="{{ $campaignsDatum->id }}" @if ($withdrawalDetail->campaign_id == $campaignsDatum->id) selected @endif>
                            {{ $campaignsDatum->title }}
                        </option>
                    @endforeach
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif

            </div>
            <div class="col-md-6">
                @php $formInputName='user_payment_gateway_id'; @endphp
                <x-adminlte-select2 id="user_payment_gateway_id" required name="{{ $formInputName }}"
                    value="{{ old($formInputName) }}" label="Payment Gateway" label-class=""
                    data-placeholder="Select Payment Gateway...">
                    @foreach ($paymentGateways as $paymentGatewaysDatum)
                        <option data-bank-account-number="{{ $paymentGatewaysDatum->bank_account_number }}"
                            data-bank-name="{{ $paymentGatewaysDatum->bank_name }}"
                            data-payment-gateway-name="{{ $paymentGatewaysDatum->payment_gateway_name }}"
                            data-mobile-number="{{ $paymentGatewaysDatum->mobile_number }}"
                            value="{{ $paymentGatewaysDatum->id }}" @if ($withdrawalDetail->user_payment_gateway_id == $paymentGatewaysDatum->id) selected @endif>
                            {{ $paymentGatewaysDatum->payment_gateway_name }}
                            @if (strtolower($paymentGatewaysDatum->payment_gateway_name) == 'bank')
                                ({{ $paymentGatewaysDatum->bank_name }})
                            @else
                                ({{ $paymentGatewaysDatum->mobile_number }})
                            @endif
                        </option>
                    @endforeach
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif

            </div>
            <div class="col-md-6">
                @php $formInputName='withdrawal_status'; @endphp
                <x-adminlte-select2 id="{{ $formInputName }}" required name="{{ $formInputName }}"
                    value="{{ old($formInputName) }}" label="Withdrawal Status"
                    label-class="" data-placeholder="Select Status...">
                    <option value="none" selected>Select Status</option>
                    @foreach ($campaigns as $campaignsDatum)
                    <option value="pending" @if ($withdrawalDetail->withdrawal_status == 'pending') selected @endif >Pending</option>
                    <option value="reviewing" @if ($withdrawalDetail->withdrawal_status == 'reviewing') selected @endif >Reviewing</option>
                    <option value="processing" @if ($withdrawalDetail->withdrawal_status == 'processing') selected @endif >Processing</option>
                    <option value="rejected" @if ($withdrawalDetail->withdrawal_status == 'rejected') selected @endif >Rejected</option>
                    <option value="approved" @if ($withdrawalDetail->withdrawal_status == 'approved') selected @endif >Approved</option>
                    <option value="completed" @if ($withdrawalDetail->withdrawal_status == 'completed') selected @endif >Completed</option>
                       
                    @endforeach
                </x-adminlte-select2>

                @if ($errors->has($formInputName))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first($formInputName) }}</strong>
                    </span>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-none" id="campaign_details_div">
                <div class="table-responsive">
                    <hr>
                    <table class="table">
                        <tbody>
                            <tr>
                                <h5 class="ml-2">Campaign Details</h5>
                            </tr>

                            <tr>
                                <th style="width:20%">Goal Amount:</th>
                                <td class="campaign-data" id="goal_amount">N/A</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Total Donation Amount:</th>
                                <td class="campaign-data" id="summary_total_collection">N/A</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Net Donation Amount:</th>
                                <td class="campaign-data" id="net_amount_collection">N/A</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Applicable Service charge:</th>
                                <td class="campaign-data" id="summary_service_charge_amount">N/A</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Total Donors:</th>
                                <td class="campaign-data" id="total_number_donation">N/A</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Start Date:</th>
                                <td class="campaign-data" id="start_date">N/A</td>
                            </tr>
                            <tr>
                                <th style="width:20%">End Date:</th>
                                <td class="campaign-data" id="end_date">N/A</td>
                            </tr>
                            <tr>
                                <th style="width:20%">Campaign Status:</th>
                                <td class="campaign-data" id="end_date">Completed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 d-none" id="payment_details_div">
                <div class="table-responsive">
                    <hr>

                    <table class="table">
                        <tbody>
                            <tr>
                                <h5 class="ml-2">Payment Details</h5>

                            </tr>
                            <tr>
                                <th style="width:20%">Type:</th>
                                <td id="info_payment_type">
                                    N/A
                                </td>
                            </tr>
                            <tr>
                                <th style="width:20%">Mobile Number:</th>
                                <td id="info_payment_mobile_number">
                                    N/A
                                </td>
                            </tr>
                            <tr class="bank-attr">
                                <th style="width:20%">Bank Name:</th>
                                <td id="info_bank_name">
                                    N/A
                                </td>
                            </tr>
                            <tr class="bank-attr">
                                <th style="width:20%">Bank Account Number:</th>
                                <td id="info_bank_account_number">
                                    N/A
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex items-center gap-4 mb-2">
                <x-adminlte-button label="Primary" type="submit" theme="primary" label="Update Request" icon="fas fa-save" />
            </div>
        </div>


    </form>

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

        $(document).ready(function() {
            $('#campaign_id').trigger('change');

            function getCompaignDetails(campaignId) {

                let fetchUrl = "{{ url('/mysuperuser/campaigns-summary/') }}" + '/' + campaignId;
                $.ajax({
                    url: fetchUrl, // Replace with the API endpoint URL
                    type: 'GET',
                    dataType: 'json', // The expected data type in the response
                    success: function(data) {
                        $('#goal_amount').text(data.campaign.goal_amount);
                        $('#summary_total_collection').text(data.campaign.summary_total_collection);
                        $('#net_amount_collection').text(data.campaign.net_amount_collection);
                        $('#summary_service_charge_amount').text(data.campaign
                            .summary_service_charge_amount);
                        $('#total_number_donation').text(data.campaign.total_number_donation);
                        $('#start_date').text(data.campaign.start_date_format);
                        $('#end_date').text(data.campaign.end_date_format);
                        $('#campaign_details_div').removeClass('d-none');
                        $('#payment_details_div').removeClass('d-none');

                    },
                    error: function(xhr, status, error) {
                        // This function will be called if there's an error in the request
                        // Handle the error here
                        console.error(error);
                    }
                });
            }

            $('#campaign_id').change(function() {
                let campaignId = $('#campaign_id').val();
                $('#campaign_details_div').addClass('d-none');
                $('#payment_details_div').addClass('d-none');
                if (campaignId !== 'none') {
                    getCompaignDetails(campaignId);
                }
                $('#info_bank_name').text($('#user_payment_gateway_id option:selected').data('bank-name'));
                $('#info_payment_mobile_number').text($('#user_payment_gateway_id option:selected').data(
                    'mobile-number'));
                $('#info_bank_account_number').text($('#user_payment_gateway_id option:selected').data(
                    'bank-account-number'));
                $('#info_payment_type').text($('#user_payment_gateway_id option:selected').text().trim());
                let selectedPaymentGateway = $('#user_payment_gateway_id option:selected').data(
                    'payment-gateway-name').trim();
                if (selectedPaymentGateway == 'Bank' || selectedPaymentGateway ==
                    'Bank (National/International)') {
                    $('.bank-attr').show();
                } else {
                    $('.bank-attr').hide();
                }
            });

            $('#user_payment_gateway_id').change(function() {
                let campaignId = $('#campaign_id').val();

                if (campaignId !== 'none') {
                    getCompaignDetails(campaignId);
                    $('#info_bank_name').text($('#user_payment_gateway_id option:selected').data(
                        'bank-name'));
                    $('#info_payment_mobile_number').text($('#user_payment_gateway_id option:selected')
                        .data('mobile-number'));
                    $('#info_bank_account_number').text($('#user_payment_gateway_id option:selected').data(
                        'bank-account-number'));
                    $('#info_payment_type').text($('#user_payment_gateway_id option:selected').text()
                        .trim());
                    $('#info_payment_type').text($('#user_payment_gateway_id option:selected').text()
                        .trim());
                    let selectedPaymentGateway = $('#user_payment_gateway_id option:selected').data(
                        'payment-gateway-name').trim();
                    if (selectedPaymentGateway == 'Bank' || selectedPaymentGateway ==
                        'Bank (National/International)') {
                        $('.bank-attr').show();
                    } else {
                        $('.bank-attr').hide();
                    }
                }
            });

        });
        setTimeout(function() {
            // Your function code goes here
            console.log('Function executed after the delay');
            $('#campaign_id').trigger('change');

        }, 1000); // 3000 milliseconds = 3 seconds
        $(document).ajaxComplete(function() {});
    </script>
@stop
