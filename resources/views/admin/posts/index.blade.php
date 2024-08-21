<x-default-layout title="Gestion des posts">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
               <p class="mt-2 text-2xl text-gray-700"> <strong>Partie reservée à l'administration du blog</strong>.</p> 
               <h1 class="mt-4 text-base font-semibold leading-6 text-gray-900 "> Posts : </h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('admin.posts.create') }}" class="inline-flex px-3 py-2 text-sm font-semibold text-center text-white rounded-md shadow-sm bg-violet-600 hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Créer un post</a>
            </div>
        </div>
        <div class="flow-root mt-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Titre</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                          @foreach ( $posts as $post )
                                <tr class="even:bg-gray-50">
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-3">{{ $post->title }}</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <a href="{{ route('posts.show', ['post' => $post]) }}" class="inline-flex px-3 py-2 text-sm font-semibold text-center text-white bg-green-600 rounded-md shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">voir le post</a>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                   <a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="inline-flex px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">editer</a>
                                </td>
                                <td x-data class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-3">
                                     <a class="inline-flex px-3 py-2 text-sm font-semibold text-center text-white bg-red-600 rounded-md shadow-sm cursor-pointer hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                      @click.prevent='$refs.delete.submit()'>supprimer</a>
                                    <form x-ref="delete" action="{{ route('admin.posts.destroy', ['post'=> $post])}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                          @endforeach     
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <div class="px-10 py-10 my-20 rounded">
        {{ $posts->links() }}
      </div>
</x-default-layout>