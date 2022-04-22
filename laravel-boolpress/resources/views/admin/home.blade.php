@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        Ciao, {{$user->name}} #{{$user->id}}

                        <br>
                        <br>
                        <div>Oggi è il {{$today}}</div>
                        <div>
                            @if($days == 0)
                                Oggi è l'ultimo del mese
                            @else
                                Alla fine del mese mancano {{$days}} giorni
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection