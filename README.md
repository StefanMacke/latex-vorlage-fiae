# LaTeX-Vorlage zur Projektdokumentation für Fachinformatiker Anwendungsentwicklung

Die Vorlage umfasst neben dem Layout und den obligatorischen Elementen wie Deckblatt, Verzeichnissen und Literaturangaben insbesondere eine Vorstrukturierung der üblicherweise geforderten Inhalte einer Dokumentation zur betrieblichen Projektarbeit inklusive einiger Beispiele für wichtige Inhalte wie z.B. Kostenkalkulation und Amortisationsrechnung. Obwohl viele Inhalte der Vorlage speziell auf Anwendungsentwickler zugeschnitten sind, dürfte die Vorlage auch für die anderen IT-Berufe (Fachinformatiker Systemintegration, IT-Kaufleute usw.) interessant sein, da die Vorgaben hinsichtlich der Projektarbeit größtenteils übereinstimmen.

Mehr Informationen und eine Beispieldokumentation auf Basis dieser Vorlage gibt es hier: [Vorlage für die Projektdokumentation][fiaevorlage].

[fiaevorlage]: http://fiae.link/LaTeXVorlageFIAE "Vorlage für die Projektdokumentation"

# Projektdokumentation kompilieren

In beiden Scripts gibt es eine Abfrage, mit der ausgewählt werden kann, ob PlantUML-Diagramme in PDF konvertiert werden sollen.
Hierzu müssen die PlantUML-Diagramme mit der Endung `.puml` im Ordner `PlantUML` liegen.

Darüber hinaus müssen dafür folgende Programme installiert sein:

1. Beliebige Java-Version; im PATH hinterlegt
2. Inkscape; im PATH hinterlegt

## Docker

1. Stelle sicher, dass Docker läuft.
2. Öffne die `./kompiliere_mit_Docker.ps1` in der PowerShell.

## Lokale MiKTeX-Installation

1. Öffne die `./kompiliere_mit_MiKTeX.ps1` in der PowerShell.

## IntelliJ

Anstelle der Scripte können in IntelliJ Run Configurations genutzt werden, die mit Importieren des Projekts geladen werden.

Zudem sind File Watchers hinterlegt, mit denen die Umwandlung von PlantUML-Diagrammen bei einer Änderung an diesen, im Hintergrund passiert. Damit dies funktioniert, wird das Plugin `File Watchers` benötigt.

# Lizenz

[![Creative Commons Lizenzvertrag](https://i.creativecommons.org/l/by-sa/4.0/88x31.png)](http://creativecommons.org/licenses/by-sa/4.0/)  
LaTeX-Vorlage zur IHK-Projektdokumentation für Fachinformatiker Anwendungsentwicklung von [Stefan Macke](http://fiae.link/LaTeXVorlageFIAE) ist lizenziert unter einer [Creative Commons Namensnennung - Weitergabe unter gleichen Bedingungen 4.0 International Lizenz](http://creativecommons.org/licenses/by-sa/4.0/).