# Notensystem
## Herunterladen
Das Notensystem kann folgendermassen heruntergeladen werden:
```git
git clone https://github.com/SwissPrekek/Notensystem
```

## Inbetriebnahme

Zuerst muss XAMPP oder ein anderer lokaler Webserverdienst installiert werden.

Danach muss über die Oberfläche Apache und MySQL gestartet werden.

Die heruntergeladene Repository muss nun in den von XAMPP eingerichteten htdocs Ordner verschoben werden.
Bei mir ist das: ```C:\xampp\htdocs\```

## MySQL Einrichtung
### Datenbank einlesen
Um die Datenbank und die benötigten Tebellen zu erstellen muss das SQL File "Notensystem.sql" eingelesen werden, dies kann mit folgendem Befehl getan werden:
```mysql
mysql -u root < "C:/xampp/htdocs/Notensystem/sql/Notensystem.sql"
```
### Benutzer einrichten
Um den Benutzer, der benötigt wird einzurichten, kann folgender Befehl verwendet werden:
```mysql
CREATE USER '151'@'localhost' IDENTIFIED BY '151';
grant select, insert, update, delete on notensystem.* to '151'@'localhost';
```

## Fertigstellung
Die Das Notensystem kann nun im Browser unter localhost/Notensystem erreicht werden.
