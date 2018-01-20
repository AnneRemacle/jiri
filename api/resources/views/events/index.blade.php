@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Events <a href="{{ route("events.create") }}">Créer un évènement</a></div>

                <div class="panel-body">
                    <ul>
                        @foreach($events as $event)
                            <li>
                                {{ $event->course_name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
