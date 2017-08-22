{!! Form::open( [ "route" => ["events.delete", $event], "method" => "DELETE" ] )!!}
    <div class="form-group">
        {!! Form::submit("Supprimer l'évènement", ["class" => "btn btn-danger delete-button"]) !!}
    </div>
{!! Form::close() !!}
