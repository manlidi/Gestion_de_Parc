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
        Votre demande de {{ $contenu['demandetype'] }} ayant pour objet <span style="color: red;">{{ $contenu['demande'] }}</span> a été rejeté.
        Veuillez écrire à l'Administrateur du site pour avoir plus d'éclaircissement!
    </p>
    <p> Merci !</p>
</body>

</html>
