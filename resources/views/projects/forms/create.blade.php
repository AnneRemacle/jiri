{!! Form::open( ["route" => ["projects.addOrStore", $event], "class" => "form"] ) !!}

    <div class="form-group">
        {{ Form::label("name", "Nom du projet", ["class" => "form-label"]) }}
        {{ Form::text("name", null, ["placeholder" => "CV à la manière de…", "class" => "form-control form-control__text", "list" => "names"]) }}
        <datalist id="names">
            @foreach($projects as $project)
                <option value="{{ $project->name }}">
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        {{ Form::label("weight", "Pondération", ["class" => "form-label"]) }}
        {{ Form::text("weight", null, ["class" => "form-control form-control__text"]) }}
    </div>

    <div class="form-facultative">
        <p class="form-facultative__intro">
            Si le projet ne se trouve pas dans la liste, veuillez compléter cette partie du formulaire
        </p>
        <div class="form-group">
            {{ Form::label("description", "Description du travail", ["class" => "form-label"]) }}
            {{ Form::textarea("description", null, ["placeholder" => "Un super cool projet", "class" => "form-control form-control__area", "list" => "descriptions"]) }}
            <datalist id="descriptions">
                @foreach($projects as $project)
                    <option value="{{ $project->description }}">
                @endforeach
            </datalist>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary col-sm-2">Ajouter</button>
    </div>

{!! Form::close() !!}
