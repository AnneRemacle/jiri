{!! Form::open( [ "route" => ["events.delete", $event], "method" => "DELETE", "class" => "form-inline form-delete-button" ] )!!}
    <div class="form-group">
        {!! Form::submit("Supprimer", ["class" => "btn btn-danger delete-button"]) !!}
    </div>
{!! Form::close() !!}
