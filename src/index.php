<?php
$files = array_diff(scandir(__DIR__ . '/uploads'), ['.', '..', '.gitkeep', ".DS_Store"]);

// look ma no react javascript
function Meme(string $file): string
{
    // const fuck_that = useState(await fetch('/api/v0/users/unknown/uploads/all'));

    // "i want XSS"
    // "we have XSS at home"
    // XSS at home:
    $file = htmlspecialchars($file);

    // files should be named <something>.<username>.<ext>
    $hiroshima = explode('.', $file);
    $user = htmlspecialchars($hiroshima[count($hiroshima) - 2]);

    return "
        <div class='meme'>
            <img src='/uploads/$file' loading='lazy' alt='A meme'>
            <span>$user</span>
        </div>
    ";
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <title>Diogenes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="fuckthis.css">
</head>
<body>
<header>
    <h1>Memes!</h1>

    <p>Lade deine Memes auf <a href="/upload">/upload</a> hoch.</p>

    <noscript>
        Hallo freundliche*r NoScript-Benutzer*in! <br>
        Hier gibt es kein JavaScript, viel Spaß beim Browsen!
    </noscript>
</header>

<main>
    <?php
    if (count($files) < 1) {
        echo "Keine Memes da, D:";
        return;
    }

    echo implode("\n", array_map(fn($file) => Meme($file), $files))
    ?>
</main>

<img id="banner" src="header.jpg" alt="graphic design is my passion">

<footer>
    <p>
        Built with&nbsp;
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">FuckingVanillaPHPJS, the new framework by Vercel</a>&nbsp;
        and ❤️ outside of Potsdam.
    </p>

    <a href="https://github.com/hpi25/memes">Quellcode</a>
</footer>
</body>
</html>
