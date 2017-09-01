{!! Form::model($student->performances->where("event_id", $event->id)->first(), ["route" => ["performances.update", $student->performances->where("event_id", $event->id)->first()], "class" => "form-inline form", "method" => "PUT"] ) !!}
    <div class="form-group">
        {{ Form::label("manual_score", "Note finale de la délibération", ["class" => "form-label"]) }}
        {{ Form::text("manual_score", $student->performances->where("event_id", $event->id)->first()->manual_score, ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Enregistrer</button>
    </div>

{!! Form::close() !!}
