{!! Form::open( ["route" => "events.store", "class" => "form col-sm-8"] ) !!}

    <div class="form-group">
        {{ Form::label("course_name", "Nom du cours", ["class" => "form-label"]) }}
        {{ Form::text("course_name", null, ["placeholder" => "Design Web", "class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("academic_year", "Année académique", ["class" => "form-label"]) }}
        {{ Form::text("academic_year", null, ["placeholder" => "2016-2017", "class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("exam_session", "Session d'examen", ["class" => "form-label"]) }}
        {{ Form::select('exam_session', ['1' => '1', '2' => '2'], '2', ["placeholder" => "Choisissez une session", "class" => "form-control"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("user_id", "Professeur responsable", ["class" => "form-label"]) }}
        {{ Form::select('user_id', $users->pluck("name","id"), null, ["class" => "form-control"]) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary col-sm-2">Ajouter</button>
    </div>

{!! Form::close() !!}
