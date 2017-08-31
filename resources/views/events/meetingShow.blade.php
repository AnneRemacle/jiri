@extends( "layouts.template" )

@section( "title", $meeting->student->name )
@include('layouts.header')
@section( "content" )
    <section class="container">
        <div class="row">
            <h2 class="page-header">{{ $meeting->student->name }}</h2>
            <ul>
                @foreach( $meeting->student->implementations->where("event_id", $event->id) as $implementation )
                    <li>{{ $implementation->project->name }} </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection


{{-- {{ $implementation->scores->where("meeting_id", $meeting->id)->first()["score"] }}/20 --}}
