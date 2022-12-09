<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3> {{ $contenu['titre'] }} </h3>
    <p>
        Bien à vous monsieur/madame  {{ $contenu['nom'] }}. <br>
        Le DPAF responsable de la Gestion du parc automobile vous invite à valider votre compte <a href="{{ $contenu['url'] }}">ici</a><br>
    </p>
    <a href="{{ $contenu['url'] }}" style="font-size: 20px;">Valider Compte</a>

    <p> Merci !</p>
</body>

</html>
