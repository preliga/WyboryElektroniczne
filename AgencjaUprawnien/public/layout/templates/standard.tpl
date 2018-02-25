<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agencja Uprawnień</title>

    {$scriptLoader->includeAllCSS()}

    {if file_exists("$file.css")}
        <link rel="stylesheet" href="/{$file}.css">
    {/if}

    {$scriptLoader->includeAllJS()}
</head>

<body>
<div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block home-link">
    Agencja Uprawnień
</div>

<div class="page">
    {if file_exists("$file.tpl")}
        {include file="{$file}.tpl"}
    {/if}
</div>

<!-- App -->
<script data-main="/scripts/app/js/app" src="/scripts/lib/require.js"></script>

</body>

</html>









