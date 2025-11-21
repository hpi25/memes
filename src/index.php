<?php declare(strict_types=1);
include "memes.php";

$memes = get_memes();

// look ma no react javascript
function Meme(array $meme): string
{
    $url = $meme["url"];
    $user = $meme["user"];

    return "
        <div class='meme'>
            <img src=$url' loading='lazy' alt='A meme'>
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

    <p>Lade deine Memes in der Telegram-Gruppe hoch.</p>

    <noscript>
        Hallo freundliche*r NoScript-Benutzer*in! <br>
        Hier gibt es kein JavaScript, viel Spaß beim Browsen!
    </noscript>
</header>

<main>
    <?php echo implode("\n", array_map(fn($meme) => Meme($meme), $memes)) ?>
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
