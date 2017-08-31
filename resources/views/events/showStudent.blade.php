@extends( "layouts.template" )

@section( "title", $event->course_name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">{{ $student->name }}</p>
                        <ul>
                            @foreach( $student->meetings->where("event_id", $event->id) as $meeting)
                                {{ $meeting->user->name }}
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
