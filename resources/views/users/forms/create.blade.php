{!! Form::open(["route" => ["users.addOrStore", $event], "class" => "form"]) !!}
    <div class="form-group">
        {!! Form::label("email", "Email", ["class" => "form-label"]) !!}
        {!! Form::email("email", null, ["class" => "form-control form-control__text", "list" => "users"]) !!}
        <datalist id="users">
            @foreach($users as $jury)
                <option value={{ $jury->email }}>
            @endforeach
        </datalist>
    </div>

    <div class="form-facultative">
        <p class="form-facultative__intro">
            Si le jury ne se trouve pas dans la liste, veuillez compléter cette partie du formulaire
        </p>
        <div class="form-group">
            {!! Form::label("name", "Nom", ["class" => "form-label"]) !!}
            {!! Form::text("name", null, ["class" => "form-control form-control__text", "list" => "names"]) !!}
            <datalist id="names">
                @foreach($users as $jury)
                    <option value="{{ $jury->name }}">
                @endforeach
            </datalist>
        </div>

        <div class="form-group">
            {!! Form::label("company", "Entreprise", ["class" => "form-label"]) !!}
            {!! Form::text("company", null, ["class" => "form-control form-control__text", "list" => "companies"]) !!}
            <datalist id="companies">
                @foreach($users as $jury)
                    <option value="{{ $jury->company }}">
                @endforeach
            </datalist>
        </div>

        <div class="form-group">
            {!! Form::label("password", "Mot de passe", ["class" => "form-label"]) !!}
            {!! Form::password("password", ["class" => "form-control form-control__text"]) !!}
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary col-sm-2">Ajouter</button>
    </div>
{!! Form::close() !!}
