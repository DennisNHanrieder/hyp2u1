# Regular Expression Beispiel

Dieses Beispiel dient zur Demonstration der PHP Regular Expression-Funktion `preg_match()`. Ein Datum im Format JJJJ-MM-TT wird dabei in das Format TT.MM.JJJJ umgewandelt. Eine ungültig formatierte oder fehlende Eingabe erzeugt eine Fehlermeldung.

## Startseite mit Formular (`index.html`)

Die Datei `index.html` enthält ein Formular einem Eingabefeld und einem Submit-Button. Das Eingabefeld wird durch das `name`-Attribut `date` gekennzeichnet.

Das `action`-Attribut des `<form>`-Elements verweist auf die Datei `date.php`. Das Attribut `method` hat den Wert `post`.

Wird der Submit-Button gedrückt, erfolgt ein POST-Request an `date.php`. Der Inhalt des Formularfeldes wird dabei mitgeschickt und steht auf der PHP-Seite dann zur Verfügung.

## PHP-Seite zur Umwandlung der Eingabe (`date.php`)

Auf der PHP-Seite wird zunächst mittels `isset($_POST["date"])` überprüft, ob es POST-Daten unter dem Eintrag `date` (der Name des Formularfeldes) gibt. Falls ja (`isset()` ergibt `true`), wird mittels `mb_strlen($_POST["date"]) !== 0` noch überprüft, ob die Länge der Eingabe nicht 0 Zeichen beträgt. In diesem Fall wäre das Formularfeld leer gelassen worden.

Sind beide Bedingungen erfüllt, wird der Inhalt von `$_POST["date"]` der Variable `$date` zugewiesen.

Dann wird die Funktion `preg_match()` mit folgendem Regular Expression Muster aufgerufen.

### Der reguläre Ausdruck (das Muster)

```php
"/(^[0-9]{4})-(\d{1,2})-([[:digit:]]{1,2}$)/"
```

Jede Regular Expression ist eine Zeichenkette (hier durch `""` angegeben) und benötigt ein Begrenzerzeichen an Anfang und Ende (hier `/ /`).

Dazwischen ist das Muster definiert. Über Klammerung `( )` können Teilausdrücke erschaffen werden, die später im Array `$matches` zur Verfügung stehen.

Die Teile des regulären Ausdrucks:

- `(^[0-9]{4})`: Der erste geklammerte Ausdruck verlangt nach einer vierstelligen Zahl (`[0-9]{4}`) und muss am Anfang der Zeichenkette stehen (`^`).
- `-`: Danach folgt ein Bindestrich.
- `(\d{1,2})`: Der zweite geklammerte Ausdruck verlangt nach mindestens einer und maximal zwei Zahlen. Anstatt der Zeichengruppe `[0-9]` wird hier das Metazeichen `\d` verwendet. Es ist einfach ein anderer Ausdruck, führt aber zu selben Ergebnis.
- `-`: Danach folgt ein weiterer Bindestrich.
- `([[:digit:]]{1,2}$)`: Im dritten geklammerten Ausdruck werden wieder 1 bis 2 Zahlen gesucht. Dieses Mal wird die benannte Zeichenklasse `[[:digit:]]` verwendet, die ein weiterer Ausdruck für eine Zahl ist und `[0-9]` und `\d` entspricht. Mit `$` wird angegeben, dass danach die Zeichenkette zu Ende sein muss.

### `preg_match()` und das `$matches` Array

Der Aufruf des regulären Ausdrucks lautet wie folgt:

```php
preg_match("/(^[0-9]{4})-(\d{1,2})-([[:digit:]]{1,2}$)/", $date, $matches)
```

- Der erste Parameter ist dabei das oben besprochene Muster.
- Dieses wird auf `$date` angewandt. Darin befindet sich das eingegebene Datum im Format JJJJ-MM-TT.
- Der dritte Parameter ist `$matches`. Er ist ein zunächst noch leeres Array in dem die Übereinstimmungen des Musters mit der Zeichenkette abgelegt werden.

Der Rückgabewert von `preg_match()` ist nämlich schlicht 1 oder 0. 1, wenn eine Übereinstimmung gefunden wurde und 0, wenn es keine gibt. Um aber bei einer Übereinstimmung auch tatsächlich die Zeichenkette zu bekommen, die dem Muster entspricht, muss `$matches` angegeben werden.

Angenommen, das eingegebene Datum ist 2024-01-15. Dann baut sich `$matches` wie folgt auf:

- `$matches[0]`: Enthält immer die gesamte Übereinstimmung, hier also `2024-01-15`.
- `$matches[1]`: Enthält den Inhalt der ersten Klammerung in der Regular Expression, hier also `2024`.
- `$matches[2]`: Enthält den Inhalt der zweiten Klammerung, hier `01`.
- `$matches[3]`: Enthält den Inhalt der dritten Klammerung, hier `15`.

`$matches` enthält immer einen Eintrag an Stelle 0. Die restlichen Einträge hängen davon ab, ob im regulären Ausdruck etwas geklammert ist und wie viele Klammerungen es gibt. Elemente die nicht im Klammern stehen, wie hier die beiden Bindestriche, werden nicht in `$matches` erfasst.

### Die Ausgabe

Der Aufruf von `preg_match()` erfolgt in einer if-Bedingung. Gibt es eine Übereinstimmung evaluiert diese auf `true` und wird betreten. In diesem Fall werden die drei Teile von `$matches` verwendet, um ein Datum im Format DD.MM.JJJJ zusammenzubauen und mit `echo` in einem Absatz zurückzugeben:

```php
echo "<p class='text-bg-success p-3'>$matches[3].$matches[2].$matches[1]</p>";
```

Gab es keine Übereinstimmung, d.h. wurde kein Muster im Text gefunden, wird eine Fehlermeldung zurückgegeben:

```php
echo "<p class='text-bg-danger p-3'>Error: Invalid format \"$date\".</p>";
```

Und wurde das Eingabefeld leer gelassen (Überprüfung der allerersten if-Bedingung), wird ebenfalls eine Fehlermeldung ausgegeben:

```php
echo "<p class='text-bg-danger p-3'>Error: No input specified.</p>";
```

Damit ist das Beispiel abgeschlossen. Über einen Link zu `index.php` kann erneut gestartet werden.