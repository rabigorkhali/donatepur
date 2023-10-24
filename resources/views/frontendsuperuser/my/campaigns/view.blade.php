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
            <li class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item "><a href="{{ url('/mysuperuser/campaigns') }}">Campaigns</a></li>
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
                                <td>{{ $campaignDetail?->category?->title??'N/A' }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Created Date</th>
                                <td>{{ ($campaignDetail->created_at)?$campaignDetail->created_at->format('Y-m-d'):'N/A' }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Start Date</th>
                                <td>{{ $campaignDetail->start_date }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Goal Amount</th>
                                <td>{{ priceToNprFormat($campaignDetail->goal_amount) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">End Date</th>
                                <td>{{ $campaignDetail->end_date }}</td>
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
                                <th style="width:20%;">Verification Status</th>
                                <td>{{ ucfirst($campaignDetail->campaign_status) }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Campaign Status</th>
                                <td>{{ ($campaignDetail->campaign_status)?'Active':'Inactive'; }}</td>
                            </tr>
                            <tr>
                                <th style="width:20%;">Description</th>
                                <td>
                                    <textarea id="description" rows="20" readonly style="width: 100%;"> {{ $campaignDetail->description }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th> <a href="{{ route('my.campaigns.list') }}" rel="noopener" 
                                    class="btn btn-default float-left mb-4"><i class="fas fa-backward"></i> Back</a></th>
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

@stop
