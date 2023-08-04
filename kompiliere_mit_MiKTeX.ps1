# Kompilierung der Projektdokumentation

# PlantUML Diagramme kompilieren und in Anhang verschieben
$answer = Read-Host "Sollen die PlantUML Diagramme kompiliert werden (y/n)?"
if ($answer -eq "y") {
    Write-Output "Die Diagramme werden kompiliert"
    Write-Output "Diagramme werden in SVG umgewandelt"
    $files = Get-ChildItem -Path ".\PlantUML\" -Filter "*.puml"
    foreach ($file in $files) {
        & java -jar plantuml.jar -charset UTF-8 -svg $file.FullName
    }

    Write-Output "Diagramme wurden erfolgreich in SVG umgewandelt"
    Write-Output "Diagramme werden in PDF umgewandelt"
    $svgFiles = Get-ChildItem -Path ".\PlantUML\" -Filter "*.svg"
    foreach ($svgFile in $svgFiles) {
        $pdfName = ".\Anhang\" + [IO.Path]::GetFileNameWithoutExtension($svgFile.Name) + ".pdf"
        & inkscape --export-filename=$pdfName $svgFile.FullName
    }

    Write-Output "Diagramme wurden erfolgreich in PDF umgewandelt"
    Write-Output "Diagramme als SVG werden geloescht"
    $svgFiles | ForEach-Object { Remove-Item $_.FullName }
    Write-Output "Diagramme als SVG wurden erfolgreich geloescht"
} else {
    Write-Output "Die Diagramme werden nicht kompiliert"
}

# Projektdokumentation.tex kompilieren
for ($i = 1; $i -le 2; $i++) {
    Write-Output "Projektdokumentation.tex wird kompiliert"
    & pdflatex "-synctex=1" "-interaction=nonstopmode" "-file-line-error" "-output-directory=./" "Projektdokumentation"
    Write-Output "Projektdokumentation.tex wurde kompiliert"
}

# Projektdokumentation öffnen
$answer = Read-Host "Soll die Datei geoeffnet werden (y/n)?"
if ($answer -eq "y") {
    Start-Process -FilePath ".\Projektdokumentation.pdf"
    Write-Output "Datei wurde geoeffnet"
} else {
    Write-Output "Script wird beendet"
}
