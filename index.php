<?php
// PHP Error Mode (Entwicklungsumgebung)
error_reporting(E_ALL);
ini_set("display_errors", TRUE);

// Autoloader laden
// Mithilfe der $loader Variable können wir
// unseren Autoloader ansprechen und ggf. weitere
// Namensräume registrieren
$loader = require_once 'vendor/autoload.php';

use Symfony\Component\Filesystem\Filesystem;
use WebdevProject\Foo;

// In diesem Array speichern wir unsere Ausgaben
$output = array();

// Versuchen eine Klasse zu benutzen, die wir über den
// Composer installiert haben
try
{
    // Filesystem Test
    $fs = new Filesystem();

    // Neue txt Datei erzeugen
    $fs->touch('data/test.txt');

    $output[] = 'FileSystem Test erfolgreich!';
}catch (\IOException $e)
{
    $output[] = 'Filesystem Test fehlgeschlagen';
}

// Autoloader Test
if(class_exists('WebdevProject\\Foo'))
{
    // Testen ob der Autoloader unsere Testklasse
    // laden kann.
    $foo = new Foo();
    $output[] = $foo->output();
} else {
    $output[] = 'Autoloader Test fehlgeschlagen';
}

// HTML Ausgabe
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Datenbanken aber richtig</title>
</head>
<body>
    <table border="1">
        <thead>
        <tr>
            <th>Meldung</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($output as $msg): ?>
            <tr>
                <td><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>