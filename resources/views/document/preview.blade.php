<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Document</title>
    <style>
        @media print {
            body {
                display: none;
            }
        }

        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }

        body {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
</head>

<body>
    @php
        $fileUrl = asset('storage/' . $document->fichier);
        $fileType = pathinfo($fileUrl, PATHINFO_EXTENSION);
        $encodedFileUrl = urlencode($fileUrl);
    @endphp

    @if ($fileType == 'pdf')
        <iframe src="{{ $fileUrl }}#toolbar=0&navpanes=0&scrollbar=0"></iframe>
    @elseif ($fileType == 'doc' || $fileType == 'docx')
        <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url={{ $encodedFileUrl }}" width="100%"
            height="600"></iframe>
    @else
        <p>Format de document non pris en charge pour l'aperçu.</p>
    @endif

    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.onkeydown = function(e) {
            if (e.keyCode == 123 ||
                (e.ctrlKey && e.shiftKey && e.keyCode == 73) ||
                (e.ctrlKey && e.keyCode == 83)) {
                return false;
            }
        };
    </script>
</body>

</html>
