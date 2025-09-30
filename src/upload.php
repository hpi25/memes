<?php declare(strict_types=1);

const UPLOAD_DIR = __DIR__ . '/uploads';

function validate_payload(): bool
{
    if (!isset($_POST['submit']) || !isset($_POST['user']) ) return false;

    if (
        !in_array(
            strtolower(pathinfo($_FILES['meme']['name'], PATHINFO_EXTENSION)),
            ['jpg', 'jpeg', 'png', 'webp', 'gif']
        )
    ) {
        echo "Ungültiges Dateiformat. Versuche JPG, PNG, GIF oder WebP.<br>";
        return false;
    }

    if ($_FILES['meme']['size'] > 15000000) {
        echo "Dein Meme darf maximal 15 MB groß sein.<br>";
        return false;
    }

    if (preg_match('/^[a-zA-Z0-9]{3,24}$/', $_POST['user']) !== 1) {
        echo "Dein Name muss der Regex <code>^[a-zA-Z0-9]{3,24}$</code> entsprechen!<br>";
        return false;
    }

    if ($_FILES['meme']['tmp_name'] === '') return false;

    if (getimagesize($_FILES['meme']['tmp_name']) === false) {
        return false;
    }

    return true;
}

if (isset($_POST['submit'])) {
    if (validate_payload()) {
        move_uploaded_file(
            $_FILES["meme"]["tmp_name"],
            UPLOAD_DIR . '/' . random_int(0, PHP_INT_MAX) . '.' . $_POST['user'] . '.' . pathinfo($_FILES['meme']['name'], PATHINFO_EXTENSION)
        );
    } else {
        echo 'Ungültiger Upload. Da scheint Dein Meme ja doch nicht so lustig gewesen zu sein...';
    }
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
    <h1>Meme-Upload</h1>

    <a href="/">zurück zu den Memes...</a>

    <noscript>
        Hallo freundliche*r NoScript-Benutzer*in! <br>
        Hier gibt es kein JavaScript, viel Spaß beim Browsen!
    </noscript>
</header>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="meme">
        Wähle Dein Meme aus: <br>
        <input type="file" name="meme" id="meme" required>
    </label>

    <label for="user">
        Dein Name: <br>
        <input type="text" name="user" id="user" required>

        <br>
        (darf nur alphanumerische Zeichen enthalten)
    </label>

    <input type="submit" value="Hochladen" name="submit">
</form>

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

