{!! Form::model($user, ["route" => ["users.update", $user], "class" => "form col-sm-8 col-md-offset-2", "method" => "PUT"] ) !!}

    <div class="form-group">
        {{ Form::label("name", "Nom", ["class" => "form-label"]) }}
        {{ Form::text("name", null, ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("company", "Entreprise", ["class" => "form-label"]) }}
        {{ Form::text("company", null, ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("email", "Email", ["class" => "form-label"]) }}
        {{ Form::email("email", null, ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("password", "Mot de passe", ["class" => "form-label"]) }}
        {{ Form::password("password", ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("password_confirmation", "Confirmer le mot de passe", ["class" => "form-label"]) }}
        {{ Form::password("password_confirmation", ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>

{!! Form::close() !!}
