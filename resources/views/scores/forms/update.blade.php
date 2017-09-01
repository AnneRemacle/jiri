{!! Form::model($implementation->scores->where("meeting_id", $meeting->id), ["route" => ["scores.update", $implementation->scores->where("meeting_id", $meeting->id)->first()], "class" => "form col-sm-8", "method" => "PUT"] ) !!}

    <div class="form-group">
        {{ Form::label("score", "Note", ["class" => "form-label"]) }}
        {{ Form::text("score", $implementation->scores->where("meeting_id", $meeting->id)->first()->score, ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        {{ Form::label("comment", "Commentaire", ["class" => "form-label"]) }}
        {{ Form::text("comment", $implementation->scores->where("meeting_id", $meeting->id)->first()->comment, ["class" => "form-control form-control__text"]) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Ajouter</button>
    </div>

{!! Form::close() !!}
