{!! Form::open(["route" => "events.store"]) !!}
    <div class="form-group">
        {{ Form::label("Nom") }}
        {{ Form::text("course_name") }}
    </div>

    <div class="form-group">
        {{ Form::label("Année académique") }}
        {{ Form::text("academic_year") }}
    </div>

    <div class="form-group">
        {{ Form::label("Session") }}
        {{ Form::text("exam_session") }}
    </div>

    {{ Form::submit("Créer") }}
{!! Form::close()!!}
