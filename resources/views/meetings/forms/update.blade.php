{!! Form::model($meeting, ["route" => ["meetings.update", $meeting], "class" => "col-sm-7", "method" => "PUT"]) !!}
    <div class="form-group">
        {!! Form::label("general_evaluation", "Évaluation globale de l'étudiant") !!}
        {!! Form::text("general_evaluation", $meeting->general_evaluation, ["class" => "form-control form-control__text"]) !!}
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
{!! Form::close() !!}
