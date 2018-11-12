@extends('layouts.app')
@section('title', 'BOCOM Petroleum sa/Service Form')
@section('commonsection')
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="main_home">
                <div class="home_text">
                    <div class="main_home">

                        <style>
                            /* The container */
                            .containerradio {
                                display: block;
                                position: relative;
                                padding-left: 35px;
                                margin-bottom: 12px;
                                cursor: pointer;
                                font-size: 22px;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                -ms-user-select: none;
                                user-select: none;
                            }

                            /* Hide the browser's default radio button */
                            .containerradio input {
                                position: absolute;
                                opacity: 0;
                                cursor: pointer;
                            }

                            /* Create a custom radio button */
                            .checkmark {
                                position: absolute;
                                top: 0;
                                left: 0;
                                height: 20px;
                                width: 20px;
                                background-color: #ccc;
                                border-radius: 50%;
                            }

                            /* On mouse-over, add a grey background color */
                            .containerradio:hover input ~ .checkmark {
                                background-color: #b2b2b2;
                            }

                            /* When the radio button is checked, add a blue background */
                            .containerradio input:checked ~ .checkmark {
                                background-color: #4188b1;
                            }

                            /* Create the indicator (the dot/circle - hidden when not checked) */
                            .checkmark:after {
                                content: "";
                                position: absolute;
                                display: none;
                            }

                            /* Show the indicator (dot/circle) when checked */
                            .containerradio input:checked ~ .checkmark:after {
                                display: block;
                            }

                            /* Style the indicator (dot/circle) */
                            .containerradio .checkmark:after {
                                top: 7px;
                                left: 7px;
                                width: 6px;
                                height: 6px;
                                border-radius: 50%;
                                background: white;
                            }






                            a:hover {
                                text-decoration: none;
                                color: #0F8334;
                            }

                            /*---------------------------------------------*/
                            h1,h2,h3,h4,h5,h6 {
                                margin: 0px;
                            }

                            p {
                                font-family: "DejaVu Sans Light";
                                font-size: 14px;
                                line-height: 1.7;
                                color: #232323;
                                margin: 0px;
                            }

                            ul, li {
                                margin: 0px;
                                list-style-type: none;
                            }


                            /*---------------------------------------------*/
                            /*input {
                                outline: none;
                                border: none;
                            }*/

                            textarea {
                                outline: none;
                                border: none;
                            }

                            textarea:focus, input:focus, select:focus{
                                border-color: #0d0d0d !important;
                            }

                            input:focus::-webkit-input-placeholder { color:transparent; }
                            input:focus:-moz-placeholder { color:transparent; }
                            input:focus::-moz-placeholder { color:transparent; }
                            input:focus:-ms-input-placeholder { color:transparent; }



                            textarea:focus::-webkit-input-placeholder { color:#0d0d0d; }
                            textarea:focus:-moz-placeholder { color:#0d0d0d; }
                            textarea:focus::-moz-placeholder { color:#0d0d0d; }
                            textarea:focus:-ms-input-placeholder { color:#0d0d0d; }

                            input::-webkit-input-placeholder { color: #0d0d0d; }
                            input:-moz-placeholder { color: #0d0d0d; }
                            input::-moz-placeholder { color: #0d0d0d; }
                            input:-ms-input-placeholder { color: #0d0d0d; }


                            /*input[type="file"]::-webkit-input-placeholder { color: black; }
                            input[type="file"]:-moz-placeholder { color: black; }
                            input[type="file"]::-moz-placeholder { color: black; }
                            input[type="file"]:-ms-input-placeholder { color: black; }*/





                            textarea::-webkit-input-placeholder { color: #0d0d0d; }
                            textarea:-moz-placeholder { color: #0d0d0d; }
                            textarea::-moz-placeholder { color: #0d0d0d; }
                            textarea:-ms-input-placeholder { color: #0d0d0d; }

                            /*---------------------------------------------*/
                            button {
                                outline: none !important;
                                border: none;
                                background: transparent;
                            }

                            button:hover {
                                cursor: pointer;
                            }

                            iframe {
                                border: none !important;
                            }
                            .form-control-text{

                                padding: 2px 5px 2px 5px;
                                font-size: large;
                                border-radius: 5px;
                                height: 30px;

                            }
                            label{
                                color: #21769c;
                            }
                            .information-account{

                            }
                        </style>



                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-10">

                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <h4><b>{{$station->name}}</b></h4>
                                        <hr class="ligne">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="menu-link-color pull-right" href="{{url('/stations-images/' . $station->stationid. '/add-image')}}">
                                            Add Images
                                        </a>
                                        <a class="menu-link-color pull-right" href="{{url('/stations-contacts/' . $station->stationid. '/add-contacts')}}"
                                           style="margin-right: 15px;">
                                            Add Contacts
                                        </a>

                                        <a class="menu-link-color pull-right" href="{{url('/stations-petroleumproducts/' . $station->stationid. '/add-petroleumproducts')}}"
                                           style="margin-right: 15px;">
                                            Add Petroleum Product
                                        </a>

                                        <a class="menu-link-color pull-right" href="{{url('/stations-lubrifiants/' . $station->stationid. '/add-lubrifiants')}}"
                                           style="margin-right: 15px;">
                                            Add Lubrifiant
                                        </a>

                                        <a class="menu-link-color pull-right" href="{{url('/stations-services/' . $station->stationid. '/add-services')}}"
                                           style="margin-right: 15px;">
                                            Add Services
                                        </a>

                                        <a class="menu-link-color pull-right" href="{{url('/stations-paymentmethods/' . $station->stationid. '/add-paymentmethods')}}"
                                           style="margin-right: 15px;">
                                            Add Payment Method
                                        </a>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <br>
                                                <h5>Header</h5>
                                                <hr class="ligne">
                                            </div>

                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                Region: {{$station->region}}
                                            </li>
                                            <li class="list-group-item">
                                                Departement: {{$station->division}}
                                            </li>
                                            <li class="list-group-item">
                                                Arrondissement: {{$station->subdivision}}
                                            </li>
                                            <li class="list-group-item">
                                                Quartier: {{$station->quarter}}
                                            </li>
                                            <li class="list-group-item">
                                                Latitude: {{$station->latitude}}
                                            </li>
                                            <li class="list-group-item">
                                                Longitude: {{$station->longitude}}
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <br>
                                                <h5>Description</h5>
                                                <hr class="ligne">
                                            </div>

                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                Nom: {{$station->description}}
                                            </li>
                                            <li class="list-group-item">
                                                Boite Postale: {{$station->bp}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">

                                    <?php
                                    $petroleumproductids = json_decode($station->petroleumproducts);
                                    $petroleumproducts = [];
                                    foreach ($petroleumproductids as $petroleumproductid){
                                        $petroleumproduct = \App\PetroleumProduct::where('petroleumproductid', '=', $petroleumproductid)->get()[0];
                                        array_push($petroleumproducts, $petroleumproduct);
                                    }
                                    ?>

                                    @if(count($petroleumproductids) > 0)
                                         <div class="col-md-6">



                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <h5> Produit Petrolier</h5>
                                                    <hr class="ligne">
                                                </div>

                                            </div>

                                        <ul class="list-group">
                                            @foreach($petroleumproducts as $petroleumproduct)
                                                <li class="list-group-item">
                                                    <h4>{{$petroleumproduct->name}}</h4>
                                                    <span>{{$petroleumproduct->description}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <?php
                                    $serviceids = json_decode($station->services);
                                    $services = [];
                                    foreach ($serviceids as $serviceid){
                                        $service = \App\Service::where('serviceid', '=', $serviceid)->get()[0];
                                        array_push($services, $service);
                                    }
                                    ?>
                                    @if(count($serviceids) > 0)
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <h5>Services</h5>
                                                    <hr class="ligne">
                                                </div>

                                            </div>

                                        <ul class="list-group">
                                            @foreach($services as $service)
                                                <li class="list-group-item">
                                                    <h4>{{$service->name}}</h4>
                                                    <span>{{$service->description}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">

                                    <?php
                                    $lubrifiantids = json_decode($station->lubrifiants);
                                    $lubrifiants = [];
                                    foreach ($lubrifiantids as $lubrifiantid){
                                        $lubrifiant = \App\Lubrifiant::where('lubrifiantid', '=', $lubrifiantid)->get()[0];
                                        array_push($lubrifiants, $lubrifiant);
                                    }
                                    ?>
                                    @if(count($lubrifiantids) > 0)

                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <h5> Produit Lubrifiant</h5>
                                                    <hr class="ligne">
                                                </div>

                                            </div>
                                        <ul class="list-group">
                                            @foreach($lubrifiants as $lubrifiant)
                                                <li class="list-group-item">
                                                    <h4>{{$lubrifiant->name}}</h4>
                                                    <span>{{$lubrifiant->description}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <?php
                                    $paymentmethodids = json_decode($station->paymentmethods);
                                    $paymentmethods = [];
                                    foreach ($paymentmethodids as $paymentmethodid){
                                        $paymentmethod = \App\PaymentMethode::where('paymentmethodid', '=', $paymentmethodid)->get()[0];
                                        array_push($paymentmethods, $paymentmethod);
                                    }
                                    ?>
                                    @if(count($paymentmethodids) > 0)
                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <h5>Methode de Paiement Accepte</h5>
                                                    <hr class="ligne">
                                                </div>

                                            </div>

                                        <ul class="list-group">
                                            @foreach($paymentmethods as $paymentmethod)
                                                <li class="list-group-item">
                                                    <h4>{{$paymentmethod->name}}</h4>
                                                    <span>{{$paymentmethod->description}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <?php
                                    $contacts = json_decode($station->contacts);

                                    ?>
                                    @if(count($contacts) > 0)
                                        <div class="col-md-6">



                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <h5>Contacts</h5>
                                                    <hr class="ligne">
                                                </div>

                                            </div>

                                        <ul class="list-group">
                                            @foreach($contacts as $contact)
                                                <li class="list-group-item " >
                                                    <span>
                                                        <?php
                                                            $phones = json_decode($contact->phones)
                                                        ?>
                                                        Tel: {{join(', ', $phones)}} <br>
                                                    </span>
                                                    <span>
                                                        BP: {{$contact->bp}}<br>
                                                    </span>
                                                    <span>
                                                        Adresse: {{$contact->address}}<br>
                                                    </span>
                                                    <span>
                                                        Quartier: {{$contact->quarter}}<br>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                    @endif
                                    <?php
                                    $images = json_decode($station->images);

                                    ?>
                                    @if(count($images) > 0)
                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <h5>Images</h5>
                                                    <hr class="ligne">
                                                </div>

                                            </div>

                                        <ul class="list-group row">
                                            @foreach($images as $image)
                                                <li class="list-group-item col-md-4" >
                                                    <img src="{{url('stations/' . $image)}}" height="80" width="80"/>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div id="dropDownSelect1"></div>
                    </div>
                </div>
                <div class="home_btns m-top-40">
                </div>
            </div>
        </div><!--End off row-->
    </div><!--End off container -->
@endsection
