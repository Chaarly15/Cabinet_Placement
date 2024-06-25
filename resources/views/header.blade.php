<div class="header">
    <div class="user">
        @guest
            <div class="singup">
                <a href="{{route('etudiants.create')}}">créer un compte</a>
            </div>
            <div class="login">
                <a href="{{route('login')}}">se connecter</a>
            </div>
        @endguest

        @auth
            @if (Auth::user()->role === 'student')
                <p>{{ Auth::user()->role }}</p>
            @elseif (Auth::user()->role === 'super_employer')
                <p>{{ Auth::user()->role }}</p>
            @elseif (Auth::user()->role === 'medium_employer')
                <p>{{ Auth::user()->role }}</p>
            @endif
            <div name="name">
                Bienvenue, {{ Auth::user()->etudiant->nom_etude }}
            </div>
            <div class="update">
                <a href="{{route('etudiants.edit')}}">Modifier Profile</a>
            </div>
            <form action="{{route('logout')}}" method="post">
                @csrf

                <button>se deconnecter</button>
            </form>
        @endauth
    </div>
</div>
