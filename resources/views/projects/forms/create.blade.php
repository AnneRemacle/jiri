{!! Form::open( ["route" => "project.create", "class" => "form"] ) !!}

    <div class="form-group">
        {{ Form::label("name", "Nom du projet", ["class" => "form-label"]) }}
        {{ Form::text("name", null, ["placeholder" => "CV à la manière de…"], ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("description", "Description du travail", ["class" => "form-label"]) }}
        {{ Form::textarea("description", null, ["placeholder" => "Un super cool projet"], ["class" => "form-control form-control__area"]) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>

{!! Form::close() !!}
