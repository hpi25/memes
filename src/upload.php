<?php declare(strict_types=1);

const UPLOAD_DIR = __DIR__ . '/../uploads';

function validate_payload(): bool
{
    if (!isset($_POST['submit'])) return false;

    if (
        !in_array(
            strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION)),
            ['jpg', 'jpeg', 'png', 'webp', 'gif']
        )
    ) {
        echo "Ungültiges Dateiformat. Versuche JPG, PNG, GIF oder WebP.\n";
        return false;
    }

    if ($_FILES['fileToUpload']['size'] > 15000000) {
        echo "Dein Meme darf maximal 15 MB groß sein.\n";
        return false;
    }

    if (getimagesize($_FILES['fileToUpload']['tmp_name']) === false) {
        return false;
    }

    return true;
}

if (!validate_payload()) {
    echo 'Ungültiger Upload. Da scheint dein Meme ja doch nicht so lustig gewesen zu sein...';
    return;
}

move_uploaded_file(
    $_FILES["fileToUpload"]["tmp_name"],
    UPLOAD_DIR . '/' . random_int(0, PHP_INT_MAX) . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION)
);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Diogenes</title>
    <meta charset="utf-8">
</head>
<body>

<h1>Lade ein Meme hoch</h1>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Wähle ein Meme aus:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Hochladen" name="submit">
</form>

</body>
</html>

