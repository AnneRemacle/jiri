{!! Form::open( ["route" => ["students.addOrStore", $event], "class" => "form col-sm-8"] ) !!}

    <div class="form-group">
        {{ Form::label("name", "Nom", ["class" => "form-label"]) }}
        {{ Form::text("name", null, ["placeholder" => "John Snow"], ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("email", "Email", ["class" => "form-label"]) }}
        {{ Form::text("email", null, ["placeholder" => "john@snow.be"], ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>

{!! Form::close() !!}
