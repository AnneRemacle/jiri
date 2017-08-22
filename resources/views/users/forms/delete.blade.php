<form action="{{ route('admin.deleteUser', ['id' => $user->id]) }}" method="POST" class="form-delete">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}

    <div class="form-group">
        <button type="submit" class="btn btn-primary delete-button">Supprimer l'utilisateur</button>
    </div>
</form>
