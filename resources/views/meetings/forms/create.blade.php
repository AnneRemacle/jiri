{!! Form::open( ["route" => ["meetings.store", $event], "class" => "form col-sm-8"] ) !!}

    @foreach ($event->users as $jury)
        <fieldset id="jury-{{ $jury->id }}" class="jury-fieldset">
            <legend>{{ $jury->name }}</legend>
            <div class="form-group">
                <div class="form-group__sub form-group__third">
                    {{ Form::label($jury->id."-students", "Étudiant", ["class" => "form-label"]) }}
                    {{ Form::select($jury->id."-students", $event->students->pluck("name", "id"), null, ["class" => "form-control select-students", "placeholder" => "Choisissez un étudiant"]) }}
                </div>
            </div>
        </fieldset>
    @endforeach

    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>

{!! Form::close() !!}

<div class="hide toClone">
    <div class="form-group">
        <a class="delete-block" href="#">Supprimer</a>
        <p class="student-name"></p>
        <div class="form-group__sub form-group__third">
            {{ Form::label("from", "de", ["class" => "form-label"]) }}
            {{ Form::text("from", null, ["class" => "form-control flatpickr"]) }}
        </div>

        <div class="form-group__sub form-group__third">
            {{ Form::label("to", "à", ["class" => "form-label"]) }}
            {{ Form::text("to", null, ["class" => "form-control flatpickr"]) }}
        </div>
    </div>
</div>
