# Books-App

## Installation

Installation mittels

```
laravel new books-app
```

Die weitere Arbeit erfolgt in PHPStorm. Bei der Bearbeitung wird `npm run dev` verwendet. 
Dadurch die Stile (css, js, etc.) korrekt angezeigt.

## Konfiguration

Laravel wird in einer Datei names `.env` konfiguriert. 
Diese Datei muss besonders geschützt werden, da sie auch Zugangsdaten beinhaltet. 
Die Speicherung darf nicht in einem Repository erfolgen.

Ein Key (`APP_Key`) kann mittels `php artisan key:generate` erstellt werden. 
Standardmäßig wird die `.env`-Datei mittels `.gitignore`-Datei ignoriert.

In der `.env`-Datei befindet sich auch der Zugang zur Datenbank. 
Standardmäßig wird mit `Sqlite` gearbeitet. 
Wirf auf eine andere DB umgestellt, so muss der Konfigurationseintrag `DB_CONNECTION` entsprechend angepasst werden (z.B. mysql inkl. Benutzerdaten). 
Nach `php artisan migrate` werden alle Tabellen lt. Migration erstellt.

## Api_Installation

Um eine Api verwenden zu können, muss folgender Befehl ausgeführt werden:

```
php artisan install:api
```

Im 'routs'-Verzeichnis wird dadurch eine `api.php` erstellt. 
In dieser Datei werden alle API-Endpunkte erstellt. 
In der `web.php`-Datei werden alle für die Website relevanten Urls erstellt.

## Backend-Installation

Laravel Breeze ermöglicht die schnelle und einfache Verwendung eines Backends:

```
composer require laravel/breeze --dev
php artisan breeze:install
```

> **Hinweis:** Nach der Installation eventuell erneut `npm run dev` ausführen.

Nach dieser Installation ist Laravel inkl. `Login` etc. verfügbar:

![Laravel-Website](public/build/assets/laravel-breeze.png)

## Welcome view anpassen

Die Welcome-Datei wird angepasst, um dem Projekt zu entsprechen. 
Hierzu wird die bestehende Datei folgendermaßen lt. Tailwind-Dokumentation ([https://tailwindcss.com/docs/installation/framework-guides/laravel/vite]) verändert.

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>

</body>
</html>
```

Die Welcome-Seite wird ausgegeben, da in der `web.php`-Datei folgende Route vorhanden ist:

```php
Route::get('/', function () {
    return view('welcome');
});
```

Beim Aufruf der Domain (bzw. `/`) wird die View `welcome.blade.php` in `resources/views` verwendet. 
Um alle Routes anzuzeigen wird folgender Befehl verwendet:

```
php artisan route:list
```

In dieser Liste ist ersichtlich, dass eine Route `/login` mit dem Namen `Login` verfügbar ist.

In Blade kann mittels `@if` eine Abfrage durchgeführt werden. 

```bladehtml
@if (Route::has('login'))
        @auth
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
        @else
        <li><a href="{{ route('login') }}">Anmeldung</a></li>
            @if (Route::has('register'))
                <li><a href="{{ route('register') }}">Registrierung</a></li>
            @endif
        @endauth
@endif
```

Im obigen Beispiel wird überprüft, ob ie Route `login` verfügbar ist (also ob ein Auth-System installiert wurde). 
Anschließend wird der Anmeldestatus es Benutzers mittels `@auth` abgefragt.

> **Hinweis:** In Blade müssen Elemente stets mit `@end...` geschlossen werden.

# Arbeit mit Daten

## Laravel und das MVC-Pattern – einfach erklärt

Laravel verwendet das **MVC-Pattern**, um Daten strukturiert anzuzeigen.

### So funktioniert es:

- **Model**  
  Verwaltet die Daten, zum Beispiel aus der Datenbank.

- **Controller**  
  Holt die Daten vom Model und verarbeitet sie. Er entscheidet, welche Daten angezeigt werden.

- **View**  
  Stellt die Daten für den Benutzer dar, zum Beispiel als Webseite.

### Einfach gesagt:
Der **Controller** ist die Schnittstelle zwischen Daten und Anzeige.  
Er nimmt die Daten vom **Model** und übergibt sie an die **View**, damit sie angezeigt werden.

In der Bücherverwaltung werden Bücher gespeichert, es muss also ein `Model` namens `Book` erstellt werden

```
php artisan make:model Book
```

Dadurch wird innerhalb von `app\Models` eine Datei names `Book.php` (Singular) erstellt.

# Datenspeicherung

Um Bücher speichern zu können, wird auch eine dazugehörige Datenbank-Tabelle namens `books` (plural) benötigt.

### Bedeutung von Singular und Plural

Laravel folgt dabei einer festen Namenskonvention:

- **Book (Singular)**  
  Das Model beschreibt **ein einzelnes Buch**.

- **books (Plural)**  
  Die dazugehörige Datenbanktabelle enthält **viele Bücher**.

Laravel erkennt automatisch:
- Model `Book` → Tabelle `books`

### Einfach erklärt:
- Das Model heißt **Book**, weil es ein einzelnes Objekt darstellt.
- Die Tabelle heißt **books**, weil dort mehrere Bücher gespeichert sind.

So kann Laravel automatisch die richtige Tabelle zuordnen, ohne dass zusätzliche Konfiguration nötig ist.

> **Achtung:** Plural und Singular sind in diesem Fall sehr wichtig, da ansonsten die Automatik nicht funktioniert.

Die Tabelle wird mittels `php artisan make:migration create_books_table` erstellt. 
In `database\migrations\` befindet sich dadurch eine PHP-Datei mit einem entsprechenden Zeitstempel, die eine Tabelle erstellt. 
Die PHP-Datei in `migrations` werden entsprechend ihres Zeitstempels abgearbeitet. 
Da bei der Erstellung die Wörter "table, create, ..." hinzugefügt wurden, wird automatisch ein Schema erstellt.

Laut Doku ([https://laravel.com/docs/12.x/migrations#creating-tables] https://laravel.com/docs/12.x/migrations#creating-tables) wird eine Tabelle erstellt.

Im `up`-Bereich wird die Tabelle mit den Attributen `title`, `isbn` und `pages` erstellt. 

```php
public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn');
            $table->integer('pages');
            $table->timestamps();
        });
    }
```

Im `down`-Bereich wird die Tabelle gelöscht.

```php
public function down(): void
    {
        Schema::dropIfExists('books');
    }
```

Mittels `php artisan migrate` wird die Migration der Datenbank (in diesem Fall die Tabelle erstellt) durchgeführt mittels (`php artisan migrate:rollback`) kann die Migration wieder rückgängig gemacht werden.

> **Achtung:** Eine bereits durchgeführte Migration (zb `2025_11_25_115215_create_books_table.php`) darf nicht mehr verändert werden. Für Veränderungen muss eine neue Migration erstellt werden.

In diesem Beispiel wird eine Sqlite-Datenbank names `database.sqlite` im `database`-Ordner angelegt und kann in PHPStorm per Drag & Drop eingebunden werden.

Die Datenbank beinhaltet eine Tabelle namens `books` mit den lt. Migration angegebenen Spalten:

![Tabelle](public/build/assets/database.png)

## Demo-Daten

Um bereits bei der Entwicklung über Daten zu verfügen, werden Demo-Daten mit sogenannten `Seeders` hinzugefügt.

```
php artisan make:seeder BookSeeder
```

Dieser Befehl erstellt einen Seeder in `BookSeeder`-Seeder in `database/seeders/`, welcher in DatabaseSeeder (als Ausgangspunkt) hinzugefügt werden muss. 
Der DatabaseSeeder ruft mehrere Seeders automatisch auf.


In der `run`-Methode des DatabaseSeeders wird ein Benutzer erstellt und er Seeder mittels `call` aufgerufen.

```php
public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Max Musertr',
            'email' => 'max.muster@example.org',
            'password' => Hash::make('max.muster@example.org'),
        ]);

        $this->call([BookSeeder::class]);
    }
```

> **Achtung:** Der Befehl `php artisan migrate:fresh` darf **niemals** in einem Produktivsystem ausgeführt werden - dies würde ALLE Daten löschen!!!

Um die Datenbank neu zu erstellen und die Demodaten hinzuzufügen, wird folgener Befehl aufgerufen:

```
php artisan migrate:fresh --seed
```


> **Hinweis:** Da der BookSeeder derzeit noch keinen Inhalt aufweist, wurde die Tabelle noch nicht befüllt.

Im BookSeeder wird daher die `run`-Methode entsprechend angepasst und mit Hilfe der Model-Klasse `Book` zwei Bücher erstellt (statische Methode create). 
`id` und `timestamps` werden automatisch ermittelt.

```php
public function run(): void
{
        Book::create([
            'title' => 'Book 1',
            'isbn'  => '9-7234-234-234',
            'pages' => 312
        ]);

        Book::create([
            'title' => 'Book 2',
            'isbn'  => '9-7234-214-234',
            'pages' => 400
        ]);
}
```

Nach einem erneuten Aufruf von `php artisan migrate:fresh --seed` werden die Daten in der `books`-Tabelle anzeigt.

## Konfigurationsdaten auslesen

Um die Konfiguration lt. `.env` auszulesen, muss die Funktion `config` verwendet werden.

```php
<title>{{ config('app.name', 'Laravel') }}</title>
```

Im obigen Beispiel ist ersichtlich, dass die Konfiguration `APP_NAME` ausgelesen wird und falls diese nicht verfügbar ist, wird der Wert `Laravel` verwendet. Es können in der `.env`-Datei auch eigenen Variablen erstellt werden.

## Mehrere Sprachen unterstützen

In einer Blade-Datei können mti folgendem Code mehrere Sprachen unterstützt werden:


```bladehtml
{{ __('List') }}
```

Der Wert `List` wird als "fallbackvalue" in EN geschrieben. In *views* wird ein Ordner namens "lang" erstellt. Dieser beinhaltet eine `json`-Datei namens `de.json`. In dieser Datei werden die angegebenen Werte übersetzt.

In der `.env`-Datei werden die entsprechenden Spracheinstellungen festgelegt:

```dotenv
APP_LOCALE=de
APP_FALLBACK_LOCALE=en
```

Deutsch wird als lokale Sprache festgelegt - EN als "fall back".

## Routes

Ausgangspunkt für einen Seitenaufruf ist immer die `web.php`. In dieser Datei werden die Routes festgelegt.

Im folgenden Beispiel wird eine Route für die Buchliste festgelegt und mittels auth-Middleware geschützt. Es können also nur angemeldete Benutzer auf die Buchliste zugreifen. Der Name für die Route wird auf `list` festgelegt.

>**Hinweis:** Werden Namen verwendet, so können die URLs bei Bedarf einfach angepasst werden, ohne den HTML-COde zu verändern.

Innerhalb `view` wird in diesem Beispiel `list`angegeben, das bedeutet, dass eine list.blade.php-Datei innerhalb des views-Ordners gesucht wird.Wäre ein Unterordner vorhanden, so müsste man `unterordner.list` angeben.

```php
Route::get('/list', function (){
    return view('list');
})->middleware(['auth'])->name('list');
```

Die neue Route kann in der Navigation (navigation.blade.php) folgendermaßen verwendet werden:

```bladehtml
<!-- navigation link -->
<x-nav-link :href="route('list')" :active="request()->routeIs('list')">
    {{ __('List') }}
</x-nav-link>

<!-- hamburger link -->
 <x-responsive-nav-link :href="route('list')" :active="request()->routeIs('list')">
     {{ __('List') }}
 </x-responsive-nav-link>
```

Die Verwendung einer `function()` innerhalb der `web.php` kann für schnelle Veränderungen bzw. "kleine" Webseiten verwendet werden. Bei umfangreicheren Seiten sollte die Route-Behandlung in einen Controller ausgelagert werden.

## Routes und Controller verbinden

Ein Controller wird mittels `php artisan make:controller BookController` erstellt. Dadurch wird in `app\http\Controller` eine Datei namens `BookController.php` erstellt. Controller werden in der Einzahl erstellt.

Die Verbindung erfolgt folgendermaßen:

```php
Route::get('/list', [BookController::class, 'listBooks'])->middleware(['auth'])->name('list');
```

Mittels `GET` kann `/list` aufgerufen werden und es wird die Methode `list()` im BookController verwendet.

Möchte man nur `BookController` schreiben, so muss der Namespace mit `use` oben hinzugefügt werden.

```php
use App\Http\Controllers\BookController;
```

>**Tipp:** Mit einem Rechtsklick kann dies via `Context Actions` rasch erledigt werden.

![Show Context Actions](public/build/assets/context-actions.png)

Im BookController werden nun innerhalb der Funktion `listBooks` alle Bücher ausgelesen.

>**Achtung:** Bei Book muss natürlich deer Namespace `App\Models\Book` mit `use` hinzugefügt werden.

```
 public function listBooks(): View
    {
        // Abfrage mit model class Book
        $books = Book::all();

        return view('list', [
            'books' => $books
        ]);
    }
```

An die `View` wird nun ein Array mit den Daten aus dem Model gesendet. Die View kann mit dem Namen `mybooks` auf diese Daten zugreifen.


## View

In der View wird auf `$books` folgendermaßen zugegriffen:

```bladehtml
<h2 class="text-lg md:text-xl lg:text-2xl">{{__('Books') }}</h2>

@foreach($books as $book)
    <div>
        {{ $book->isbn }} - {{ $book->title }}
    </div>
@endforeach
```

In der `foreach`-Schleife wird jedes Buchelement als `$book` behandelt und innerhalb der Schleife wird auf die einzelnen `Book`-Models zugegriffen. Es sind die meisten attribute der Tabelle verfügbar.

Mit zB `@if` kann auch eine Verzweigung durchgeführt werden. Zum Beispiel könnten nur Bücher mit mehr als 350 Seiten angezeigt werden:

```bladehtml
@foreach($books as $book)
    @if ($book->pages>350)
        <div>
            {{ $book->isbn }} - {{ $book->title }}
        </div>
    @endif
@endforeach
```

Aus Performance-Gründen, würde diese Abfrage aber eher im Controller durchgeführt werden (`where`).

## Daten eingeben

Daten werden mit Formulare eingeben. Mit `route('save')` wird auf die URL der Route `save` (siehe *web.php*) zugegriffen. Mittels `@csrf` wird das Formular vor unberechtigten Zugriffen geschützt. Fehlt `csrf`, so wird *Page expired* ausgegeben. Um auch fehlerhafte Werte, welche nach einem Absenden des Formulares verschwinden würde, anzuzeigen, wird auf die gesendeten Daten mittels `old('feldname') zugegriffen.

Auf die Werte der Datenüberprüfung wird mittels `@error('isbn')` und `@enderror` zugegriffen. Dadurch kann eine detaillierte Fehlermeldung angezeigt werden. Im *lang*-Ordner befinden sich die installierten/übersetzten Sprachen. Mit `php artisan lang:publish` wird die Standardsprache im Ordner `lang erstellt.

> **Hinweis:** Eine Komponente in `resources/views/components` wird mittels Präfix `x-` hinzugefügt. Der "Primary Button" wird also mit `<x-primary-button ...` hinzufügt.

````bladehtml
    <form action="{{ route('save') }}" method="post" class="space-y-6">
    @csrf

    <div>
        <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">
            {{ __('ISBN') }}
        </label>
        <input
            value="{{ old('isbn') }}"
            type="text"
            name="isbn"
            id="isbn"
            class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
        >
        @error('isbn')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
            {{ __('Title') }}
        </label>
        <input
            value="{{ old('title') }}"
            type="text"
            name="title"
            id="title"
            class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
        >
        @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="pages" class="block text-sm font-medium text-gray-700 mb-1">
            {{ __('Pages') }}
        </label>
        <input
            value="{{ old('pages') }}"
            type="number"
            name="pages"
            id="pages"
            class="w-full max-w-md border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500"
        >
        @error('pages')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-primary-button class="px-5 py-2">
            {{ __('Save') }}
        </x-primary-button>
    </div>
    </form>
````

### Icons

Icons können von [www.heroicons.com](https://www.heroicons.com) heruntergeladen werden. Mit `<x-trash class="text-red-500"/> kann ein Icon (analog zu einer anderen Komponente) eingebunden werden. Um die Komponente mit einer Klasse versehen zu können, wird in der `blade.php`-Datei der Komponente ein `$attributes->merge` mit den jeweiligen Standardklassen benötigt.

```bladehtml
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" {{ $attributes->merge(['class' => 'size-6']) }}>
    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>
```


