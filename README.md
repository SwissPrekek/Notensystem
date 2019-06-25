# Kochbuch
## Herunterladen
Das Kochbuch kann folgendermassen heruntergeladen werden:
```git
git clone https://github.com/simonjaeggi/Kochbuch
```
In diesem Beispiel wurde das Projekt in den Ordner "E:\xampp\htdocs" geklont.

## Umgebung
Als Umgebung wird [xampp](https://www.apachefriends.org/de/index.html) empfohlen.
Grundsätzlich kann aber auch ein Webserver mit Apache, PHP, Mysql/MariaDB und den entsprechenden Kompatiblitätspatches von PHP verwendet werden.

Diese Anleitung wurde mit XAMPP 7.1.11 getestet. 
Xampp wurde auf einem Windows 10 PC unter "E:\xampp" installiert.
Es wurden keine Standardeintstellungen verändert.

1. XAMPP starten
1. Modul Apache starten
1. Modul MySQL starten

## Datenbank einrichten
1. Die Datenbank wird mittels der Datei "sql_Kochbuch.sql" erstellt. Diese muss in die SQL Instanz geladen werden:
```mysql
mysql -u root < "E:/xampp/htdocs/Kochbuch/sql/sql_Kochbuch.sql"
```
2. Zusätzlich muss in der Datenbank ein neuer Benutzer angelegt und berechtigt werden. Dazu muss die Datei "Kochbuch_editor.sql" in die SQL Instanz geladen werden:
```mysql
mysql -u root < "E:/xampp/htdocs/Kochbuch/sql/kochbuch_editor.sql"
```
_Für neuere Mysql Versionen muss die Benutzererstellung leicht angepasst werden. Dazu kann in der Datei "Kochbuch_editor.sql" der # vor der zweiten Zeile entfernt, und vor der dritten Zeile eingefügt werden._

## Fertigstellung
Wenn die oben genannten Punkte erledigt wurden, kann das Projekt nun über [localhost/Kochbuch](http://localhost/Kochbuch) erreicht werden.
