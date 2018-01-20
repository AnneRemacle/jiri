@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Events - Créer un évènement</div>

                <div class="panel-body">
                    @include("events.forms.create")
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
