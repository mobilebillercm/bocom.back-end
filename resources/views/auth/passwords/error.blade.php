@extends('layouts.app')
@section('title', 'BOCOM Petroleum sa/Home')
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

                            <br><br><br>

                            <div class="col-md-12 alert-danger">
                                <h4>Something Went Wrong !!!</h4>
                                {{$message}}
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
