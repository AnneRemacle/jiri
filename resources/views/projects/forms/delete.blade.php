<form action="{{ route('admin.deleteProject', ['id' => $project->id]) }}" method="POST" class="form col-sm-8">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}

    <div class="form-group">
        <button type="submit" class="btn btn-primary delete-button">Supprimer le projet</button>
    </div>
</form>
