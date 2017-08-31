{!! Form::open(["route" => ["users.addOrStore", $event]]) !!}
    <div class="form-group">
        {!! Form::label("email", "email") !!}
        {!! Form::email("email", null, ["list" => "students"]) !!}
        <datalist id="students">
            @foreach($event->users as $jury)
                <option value={{ $jury->email }}>
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        {!! Form::label("name", "name") !!}
        {!! Form::text("name", null, ["list" => "names"]) !!}
        <datalist id="names">
            @foreach($event->users as $jury)
                <option value="{{ $jury->name }}">
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        {!! Form::label("company", "company") !!}
        {!! Form::text("company", null, ["list" => "companies"]) !!}
        <datalist id="companies">
            @foreach($event->users as $jury)
                <option value="{{ $jury->company }}">
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        {!! Form::label("password", "password") !!}
        {!! Form::password("password", null) !!}
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>
{!! Form::close() !!}
