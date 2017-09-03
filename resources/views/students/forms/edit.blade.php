{!! Form::model($student, ["route" => ["students.update", $student], "class" => "form col-sm-8 col-md-offset-2", "method" => "PUT"] ) !!}
    {{ Form::hidden($student->id, $student->id) }}

    <div class="form-group">
        {{ Form::label("name", "Nom", ["class" => "form-label"]) }}
        {{ Form::text("name", null, ["class" => "form-control form-control__text"]) }}
    </div>

    <div class="form-group">
        {{ Form::label("email", "Email", ["class" => "form-label"]) }}
        {{ Form::text("email", null, ["class" => "form-control form-control__text"]) }}
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>

{!! Form::close() !!}
