{!! Form::open( ["route" => "user.create", "class" => "form"] ) !!}

    <div class="form-group">
        {{ Form::label("name", "Nom", ["class" => "form-label"]) }}
        {{ Form::text("name", null, ["placeholder" => "John Snow"], ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("company", "Entreprise", ["class" => "form-label"]) }}
        {{ Form::text("company", null, ["placeholder" => "Garde de nuit"], ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("email", "Email", ["class" => "form-label"]) }}
        {{ Form::email("email", null, ["placeholder" => "john@snow.be"], ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("password", "Mot de passe", ["class" => "form-label"]) }}
        {{ Form::password("password", null, ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>

{!! Form::close() !!}
