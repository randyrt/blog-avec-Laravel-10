<x-default-layout>
    <div class="space-y-10 md:space-y-16">
            @forelse ($posts as $post )
                <x-post :$post list /> 
            @empty
                <p class="text-center text-slate-400">Aucun resultat trouvé</p>
            @endforelse
    <div>
      {{ $posts->links() }}
    </div>        
    </div>
</x-default-layout>
         
       