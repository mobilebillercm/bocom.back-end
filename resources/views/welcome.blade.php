@extends('layouts.app')
@section('title', 'BOCOM Petroleum sa')
@section('commonsection')
    <div class="overlay"></div>

    <div class="container">

        <div class="row">
            <div class="main_home">
                <div class="home_text">
                    <div class="main_home">
                        <br />
                        <h1 class="text-white" style="font-size: x-large;">NOS STATIONS</h1>

                        <div class="row">

                            <div class="col-md-12">
                                <ul class="list-group menu-transaction" style="width: 100%;">
                                    <li class="list-group-item">
                                        <a  href="{{url('wallet/topups/')}}"
                                            onclick="alert('En cours d\'implementation'); return false;">Recharger mon Compte</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a  href="{{url('wallet/topups/subaccounts/')}}"
                                            onclick="alert('En cours d\'implementation'); return false;">Un de mes sous Comptes</a>
                                    </li>
                                </ul>
                            </div>

                        </div>


                    </div>




                </div>




            </div>

        </div><!--End off row-->
    </div><!--  End off container -->
@endsection
