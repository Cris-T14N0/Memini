<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Álbum Partilhado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-green-50 to-white">
    <livewire:shared.show-shared-album :token="$token" />
    @livewireScripts
</body>
</html>
