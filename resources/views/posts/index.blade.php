<x-default-layout>
    <div class="space-y-10 md:space-y-16">
            @forelse ($posts as $post )
                <x-post :$post list /> 
            @empty
                <p class="text-center text-purple-000">Aucun resultat trouvé</p>
            @endforelse
        <div class="px-10 py-10 my-20 rounded">
        {{ $posts->links() }}
        </div>        
    </div>
</x-default-layout>
         
       