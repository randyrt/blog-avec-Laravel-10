<x-auth-layout title="inscription" :action="route('register')" submitMessage='Inscription' >
    <x-input name="name" label="Nom complet" />
    <x-input name="email" label="Adresse email" type="email" />
    <x-input name="password" label="Mot de passe" type="password"/>
    <x-input name="password_confirmation" label="Confirmer le mot de passe" type="password" />
</x-auth-layout>