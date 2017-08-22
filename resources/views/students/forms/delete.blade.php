<form action="{{ route('admin.deleteStudent', ['id' => $student->id]) }}" method="POST" class="form-delete">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}

    <div class="form-group">
        <button type="submit" class="btn btn-primary delete-button">Supprimer l'étudiant</button>
    </div>
</form>
