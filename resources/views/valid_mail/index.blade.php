@extends('base')

@section('content')
<div class="container">
    <h1>Emails Autorisés</h1>

    <a href="{{ route('valid_mail.create') }}" class="btn btn-primary">Ajouter un Email Autorisé</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($validMails as $validMail)
                <tr>
                    <td>{{ $validMail->email }}</td>
                    <td>{{ $validMail->role }}</td>
                    <td>
                        <form action="{{ route('valid_mail.destroy', $validMail) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
