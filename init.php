<?php
if (file_exists(__DIR__ . '/.php.ini')) {
    echo "✅ Loading custom PHP.ini<br>";
    foreach (file(__DIR__ . '/.php.ini') as $line) {
        if (strpos($line, 'extension=') === 0) {
            $ext = trim(substr($line, 10));
            if (!extension_loaded($ext)) {
                @dl($ext . '.so');
                echo "Loaded extension: $ext<br>";
            }
        }
    }
} else {
    echo "❌ .php.ini file not found<br>";
}
?>
