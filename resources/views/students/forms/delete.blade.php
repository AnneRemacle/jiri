{{ Form::open(["route" => ["students.delete", $student], "method" => "DELETE"]) }}
    <div class="form-group">
        <button type="submit" class="btn btn-danger delete-button">Supprimer l'étudiant</button>
    </div>
{{ Form::close() }}
