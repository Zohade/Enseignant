<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Download</title>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <script>
        // Lancer le téléchargement automatiquement
        var downloadUrl = "{{ route('document.downloadFile', ['doc' => $docId]) }}";

        // Créer un élément invisible pour déclencher le téléchargement
        var link = document.createElement('a');
        link.href = downloadUrl;
        link.download = ''; // Le nom du fichier est déterminé par l'en-tête de réponse
        link.style.display = 'none';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    </script>
</body>

</html>
