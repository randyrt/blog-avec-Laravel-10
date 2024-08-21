<x-default-layout :title="$post->exists() ? 'Modifier un post' : 'Créer un post'">
  <form action="{{$post->exists() ? route('admin.posts.update', ['post' => $post])  : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($post->exists())
      @method('PATCH')
    @endif
    <div class="space-y-12">
      <div class="pb-12 border-b border-gray-900/10">
         <p class="mt-2 text-2xl leading-6 text-gray-600"><strong>Allons-y, c'est le moment de prouver au monde votre talent d'écrivain</p></strong> 
        <h1 class="mt-3 text-base font-semibold leading-7 text-gray-900">
         {{ $post->exists() ? 'Modifier un post': 'Créer un post' }}
        </h1>
       
      <div class="mt-10 space-y-8 md:w-2/3">
            <x-input name="title" label="Titre" :value="$post->title" />
            <x-input name="slug" label="slug" help="Laisse le champ vide pour une valeur automatique, mais si une valeur est reseignée, ce sera le slug" :value="$post->slug"/>
            <x-textarea name='content' label='contenu du post'>{{ $post->content }}</x-textarea>
            <x-input name="thumbnail" label="Image de couverture" type='file' :value="$post->thumbnail" />
            <x-select name="category_id" label='catégorie' :list='$categories' :value="$post->category_id"/>
            <x-select name="tag_ids" label='Etiquettes' :list='$tags' multiple help="Cliquer sur le champ et choisissez une ou plusieurs etiquettes"
            :value="$post->tags"/>
       </div>
      </div>
    </div>

    <div class="flex items-center justify-end mt-6 gap-x-6">
        <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          {{ $post->exists ? 'Mettre à jour' : 'créer' }}
        </button>
    </div>
  </form>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
      new TomSelect('select[multiple]', { plugins: {remove_button: { title: 'supprimer'}}, placeholder: 'Vuillez selectionner '});
</script>
</x-default-layout> 