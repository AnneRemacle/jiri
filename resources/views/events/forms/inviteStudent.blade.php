{!! Form::open(["route" => ["events.addOrStoreStudent", $event]]) !!}
    <div class="form-group">
        {!! Form::label("email", "email") !!}
        {!! Form::email("email", null, ["list" => "students"]) !!}
        <datalist id="students">
            @foreach($students as $student)
                <option value={{ $student->email }}>
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        {!! Form::label("name", "name") !!}
        {!! Form::text("name", null, ["list" => "names"]) !!}
        <datalist id="names">
            @foreach($students as $student)
                <option value="{{ $student->name }}">
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>
{!! Form::close() !!}
