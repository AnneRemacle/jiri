{!! Form::open( ["route" => ["students.addOrStore", $event], "class" => "form"] ) !!}
    <div class="form-group">
        {{ Form::label("email", "Email", ["class" => "form-label"]) }}
        {{ Form::text("email", null, ["placeholder" => "john@snow.be", "class" => "form-control form-control__text", "list" => "emails"]) }}
        <datalist id="emails">
            @foreach($students as $student)
                <option value="{{ $student->email }}">
            @endforeach
        </datalist>
    </div>

    <div class="form-facultative">
        <p class="form-facultative__intro">
            Si l'étudiant ne se trouve pas dans la liste, veuillez compléter cette partie du formulaire
        </p>
        <div class="form-group">
            {{ Form::label("name", "Nom", ["class" => "form-label"]) }}
            {{ Form::text("name", null, ["placeholder" => "John Snow", "class" => "form-control form-control__text", "list" => "names"]) }}
            <datalist id="names">
                @foreach($students as $student)
                    <option value="{{ $student->name }}">
                @endforeach
            </datalist>
        </div>

    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary col-sm-2">Ajouter</button>
    </div>

{!! Form::close() !!}
