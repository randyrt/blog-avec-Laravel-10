<x-default-layout title="Mon compte">
     <form action="{{ route('home') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
          <div class="pb-12 border-b border-gray-900/10">
            <h1 class="text-base font-semibold leading-7 text-gray-900">Mot de passe</h1>
            <p class="mt-1 text-sm leading-6 text-gray-600">Ici, vous pouvez modifier votre mot de passe en un clin d'oeil</p>

            <div class="mt-10 space-y-8 md:w-2/3">
                <x-input id="passwordInput1" type="password" name="current_password" label="Mot de passe actuel" />
                <x-input id='passwordInput2' type="password" name="password" label="Nouveau mot de passe" />
                <x-input id='passwordInput3' type="password" name="password_confirmation" label="Confirmation du nouveau mot de passe" />
                 <x-checkbox label='Montrer les mot de passe'></x-checkbox>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-end mt-6 gap-x-6">
            <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Modifier</button>
        </div>
     </form>
</x-default-layout> 