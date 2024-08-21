<x-default-layout :title="$post->title">
    <div class="space-y-10 md:space-y-16">
        <x-post :$post />
    @auth
        <form action="{{ route('posts.comment', ['post'=> $post]) }}" method="POST" class="px-5 py-3 rounded my-7">
            @csrf
            <div class="flex h-12">
                <input class="w-full px-5 rounded-lg bg-slate-50 text-slate-900 focus:outline focus:outline-2 focus:outline-indigo-500" type="text" name="comment" placeholder="Ecrire un commentaire... " autocomplete="off">
                <button class="flex items-center justify-center w-12 ml-4 bg-indigo-700 rounded-full shrink-0 text-indigo-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                    </svg>
                </button>
            </div>
             @error('comment')
                <p class="mt-2 ml-4 text-sm text-red-600">{{ $message }}</p>
             @enderror
        </form>
    @endauth
    <div class="space-y-8">
        @foreach ($post->comments as $comment )
            <div class="flex p-6 mb-4 rounded-lg bg-slate-100">
                <img class="object-cover w-10 h-10 rounded-full sm:w-12 sm:h-12" src="{{ Gravatar::get($comment->user->email) }}" alt="image de profil de {{ $comment->user->name }}">
                <div class="flex flex-col ml-6">
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <h2 class="text-2xl font-bold text-slate-900">{{ $comment->user->name }}</h2>
                </div>
                <p class="mt-4 text-slate-800 sm:leading-loose">{{ $comment->content }}</p>
                <time class="ml-6 text-xs text-slate-400" datetime="$comment->created_at">@datetime($comment->created_at)</time>
            </div>
            </div>
        @endforeach
    </div>
</x-default-layout>

{{-- 
 w-10 => width : 40px,
 h-10 => heigt : 40px,
 object-cover => forcer l'image en carée
 rounded-full => border-raduis: 50px
 sm:w-12 => taille small
 text-2xl => text grand
 font-bold => bold
 flex flex-col => column
 flex flex-row => ligne
 text-xs : text petit
 bg-slate-100 => backgroundColor: 
--}}