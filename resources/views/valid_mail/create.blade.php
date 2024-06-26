@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Email Autorisé</h1>

    <form action="{{ route('valid_mail.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <select name="role" id="role" class="form-control" required>
                <option value="medium_employer">Medium Employer</option>
                <option value="super_employer">Super Employer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
