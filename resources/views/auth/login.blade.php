<x-auth-layout title="connexion" :action="route('login')" submitMessage='Connexion'>
    <x-input name="email" label="Adresse email" type="email" help="ex : randy@gmail.com"  />
    <x-input id="passwordInput1" name="password" label="Mot de passe" type="password" help="ex : randy12345"/>
    <x-checkbox label="Montrer/cacher le mot de passe"></x-checkbox>      
    <x-checkbox/>
</x-auth-layout> 