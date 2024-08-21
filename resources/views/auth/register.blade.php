<x-auth-layout title="inscription" :action="route('register')" submitMessage='Inscription' >
    <x-input name="name" label="Nom complet" help="ex : John Doe" />
    <x-input name="email" label="Adresse email" type="email" help="ex : johndoe@gmail.com" />
    <x-input id="passwordInput1"  name="password" label="Mot de passe" help="ex : johndoe-x-4679*" type="password"/>
    <x-input id="passwordInput2" name="password_confirmation" label="Confirmer le mot de passe" type="password" help="ex : johndoe-x-4679*" />
    <x-checkbox label="Montrer/cacher les mots de passe"></x-checkbox>
</x-auth-layout>