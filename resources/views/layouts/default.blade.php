<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
     html, body {
        height: 100%;
        margin: 0;
        background-color: rgba(254, 254, 254, 0.8);
    }
    </style>
   
</head>
<body class="pt-10 pb-16 mb-10 antialiased md:pb-32" >
    {{-- Conteneur global --}}
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Header --}}
        <header class="flex flex-row justify-between space-x-5 text-slate-900">
            {{-- Logo --}}
            <a href="{{ route('index') }}">
               <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" color="violet" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                </svg>
            </a>
            {{-- Formulaire de recherche --}}
            <form action="{{ route('index') }}" class="flex items-center pb-3 pr-2 transition border-b text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900">
                @csrf
                <input id="search" value="{{ request()->search}}" class="w-full px-2 leading-none outline-none placeholder-slate-400" type="search" name="search" placeholder="Rechercher un article">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" color="violet" width="16" height="16" fill="currentColor" class="ml-2 bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </form>
            {{-- Navigation --}}
            <nav x-data="{ open: false }" x-cloak class="relative">
                <button
                    @click="open = !open"
                    @click.outside="if (open) open = false"
                    @class(['flex w-8 h-8 text-sm bg-white rounded-full  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2', 'md:hidden' => Auth::guest()])
                
                >   
                    @auth
                     <svg xmlns="http://www.w3.org/2000/svg" color="violet" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    {{--  <img class="w-8 h-8 rounded-full" src="{{ Gravatar::get(Auth::user()->email) }}" alt="image de profil"> --}}
                     @else
                        <svg xmlns="http://www.w3.org/2000/svg" color="violet" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                        </svg>
                     @endauth
                </button>
                <ul
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    tabindex="-1"
                    @class([
                        'bg-violet-600 absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none',
                        'md:hidden' => Auth()->guest()
                        ])
                >   
                @auth
                     <li><a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-violet-500">Mon compte</a></li>
                     @if (Auth::user()->isAdmin())
                    <li><a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-violet-500">Gestion des posts</a></li>
                     @endif
                     
                     <li><a href="{{ route('logout') }}" @click.prevent='$refs.logout.submit()' class="block px-4 py-2 text-sm text-gray-700 hover:bg-violet-500">Déconnexion</a></li> 
                     <form x-ref='logout' action="{{ route('logout') }}" method="post" class="hidden">
                        @csrf
                     </form>
                @else
                    <li><a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-indigo-700 hover:bg-gray-100">Connexion</a></li>
                    <li>
                        <a href="{{ route('register') }}" class="flex items-center px-4 py-2 text-sm font-semibold text-indigo-700 hover:bg-gray-100">
                            Inscription
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-1">
                                <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul> 
                @endauth
               {{--@guest sert caché ceci quand l'utilisateur est connecté --}}
                @guest
                    <ul class="hidden space-x-12 font-semibold text-indigo-700 md:flex">
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                    <li>
                        <a href="{{ route('register') }}" class="flex items-center text-indigo-700 group">
                            Inscription
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-1 transition-all group-hover:ml-2 group-hover:mr-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </li>
                </ul>
                @endguest
                
            </nav>
        </header>
        {{-- composant pour alert status --}}
        @if (session('status'))
            <div class="p-4 mt-10 rounded-md bg-green-50">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-900">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <main class="flex-grow mt-10 md:mt-12 lg:mt-16">
          {{ $slot }}
        </main>
    </div>

    {{-- Only for guest  
    @guest
        <x-footer/> 
    @endguest
    --}}
</body>
</html>