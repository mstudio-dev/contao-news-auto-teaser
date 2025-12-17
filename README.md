# Contao News Auto Teaser

Dieses Bundle kürzt News-Teaser in Contao 5 automatisch auf 300 Zeichen und sichert den Originaltext in einem neuen Content-Element.

## Installation

1. Per Composer hinzufügen:
   ```bash
   composer require mstudio-dev/contao-news-auto-teaser

2. Datenbank migrieren:
    ```bash
    php vendor/bin/contao-console contao:migrate

## Features

- Automatisches Kürzen bei über 300 Zeichen.

- Erhalt des HTML-Markups beim Kürzen.

- Automatische Erstellung eines Text-Inhaltselements mit dem vollen Text.