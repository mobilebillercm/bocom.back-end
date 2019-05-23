<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Salut {{ $user->firstname.' ' . $user->lastname }},
    <br>
    Vous avez demander la reconfiguration de votre mot de passe
    <br>
    Veuillez cliquer sur lien ci-dessous ou copier le dans la barre d'adresse de votre navigateur preferer pour choisir votre nouveau mot de passe.

    <br>

    <a href="{{$url}}">Choisir un nouveau mot de passe</a>

    <br><br>
    {{$url}}

    <br/>
</div>

</body>
</html>