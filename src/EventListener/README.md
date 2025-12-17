# News Auto Teaser Bundle for Contao 5

Dieses Bundle erweitert die Nachrichten-Komponente von Contao 5. Wenn ein Teaser-Text länger als 300 Zeichen ist, wird er beim Speichern automatisch gekürzt. Der vollständige ursprüngliche Text wird dabei als neues Text-Content-Element in den Details der Nachricht abgelegt.

## Features

* **Automatische Kürzung:** Kürzt Teaser auf 300 Zeichen (HTML-sicher).
* **Content-Element Generation:** Erzeugt automatisch ein `text` Element mit dem vollen Inhalt.
* **Intelligentes Flag:** Ein verstecktes Feld `teaser_processed` verhindert, dass der Prozess bei jedem Speichervorgang erneut ausgeführt wird.

## Installation

### 1. Composer
Da das Bundle (noch) nicht auf Packagist ist, füge es lokal oder über dein GitHub Repository hinzu:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "[https://github.com/mstudio-dev/news-auto-teaser-bundle](https://github.com/mstudio-dev/news-auto-teaser-bundle)"
    }
],