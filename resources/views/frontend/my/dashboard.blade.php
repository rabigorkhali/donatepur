@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <style>
        #map {
            height: 400px;
        }
    </style>
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to <strong>The Place of Hopes</strong>. "Let's join together on our mission to help those in need." </p>
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_campaign ?? 0 }}</h3>
                    <p>Total Campaigns</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('my.campaigns.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ priceToNprFormat($total_collection ?? 0) }}</h3>
                    <p>Total Donation Received</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('my.donations.received.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ priceToNprFormat($net_collection ?? 0) }}</h3>
                    <p>Withdrawable Amount</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('my.withdrawals.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ priceToNprFormat($total_donation_made ?? 0) }}</h3>
                    <p>Total Donation Given</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('my.donations.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
    <div class="row">

        <section class="col-lg-12 col-md-12 connectedSortable ui-sortable">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Your campaign's visitors.
                    </h3>
                </div>

                <div class="card-body">
                    <div id="map"></div>
                </div>


            </div>
        </section>


    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        /* print current */
        
        /*end  print current */
        // Function to initialize the map
        function initMap() {

             let allLocations=<?php echo $locationArray; ?>;
            // Latitude and Longitude for the initial map center
            var latitude = 27.7172;
            var longitude = 85.3240;

            // Create a map object and set the initial view
            var map = L.map('map').setView([latitude, longitude], 6);

            // Add the OpenStreetMap tiles layer to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Optionally, you can add markers or other elements to the map here
            allLocations.forEach(function(innerArray) {
                L.marker([innerArray.latitude, innerArray.longitude]).addTo(map);
            });
            
        }

        // Call the initMap function to initialize the map when the page loads
        window.onload = initMap;
    </script>

@stop
