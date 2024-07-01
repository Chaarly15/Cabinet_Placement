@vite('resources/css/header.css')
<div class="header">
    <div class="user">
        <div class="shrink-0 flex items-center">
            <a href="{{ route('cabinet-de-placement.index') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>
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
                @if (Auth::user()->role === 'student')
                    <p>Bienvenue, {{ Auth::user()->etudiant->nom_etude }}</p>
                @elseif (Auth::user()->role === 'super_employer')
                    <p>Bienvenue, {{ Auth::user()->employer->nom }}</p>
                @elseif (Auth::user()->role === 'medium_employer')
                    <p>Bienvenue, {{ Auth::user()->employer->nom }}</p>
                @endif
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
