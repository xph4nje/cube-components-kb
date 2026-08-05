# Tipologie di Modulo e valore restituito da `$this->getModulo()` — Cube CMS

Quando in un template si chiama `$this->getModulo('Nome Dicitura')`, il metodo (in `PageContentTrait.php`) risolve il modulo associato a quella "dicitura" nel modello della pagina/componente corrente e, in base al suo **`id_modulo`** (tabella `moduli` / costanti in `app/Modules/Module.php`), esegue una query diversa e restituisce una struttura dati differente.

Ogni componente (nel Page Builder / modello classico) ha un pannello di configurazione dove si scelgono le "diciture" dei moduli associati; questo documento spiega **cosa arriva effettivamente nel template** per ciascuna tipologia.

Riferimento codice: `app/Public/Traits/PageContentTrait.php` → `getContenuto()` (switch su `$row['id_modulo']`), costanti in `app/Modules/Module.php`.

---

## [ Titolo ] — id_modulo 1
**Ritorna:** `string` — il testo del titolo (dalla tabella `pagine_moduli.testo`, per lingua o "non traducibile").
```php
$titolo = $this->getModulo('Titolo'); // "Benvenuti in..."
```

## [ Sottotitolo ] — id_modulo 2
**Ritorna:** `string` — stessa logica del Titolo (stessa porzione di switch: case 1/2/3/6), letto da `pagine_moduli.testo`.
```php
$sottotitolo = $this->getModulo('Sottotitolo');
```

## [ Testo ] — id_modulo 3
**Ritorna:** `string` (HTML) — il testo lungo (editor ricco), con i path dei media nel testo (link/immagini inline) risolti/ripuliti tramite `MediaPathService::clearPathInText()`.
```php
echo $this->getModulo('Testo');
```

## [ Testo breve ] — id_modulo 6
**Ritorna:** `string` — identico al Testo (stessa gestione di case nello switch), pensato per un campo più corto (es. estratto/abstract), ma tecnicamente stesso trattamento dati.

## [ Immagine selezione ] — id_modulo 4
**Ritorna:** `array` di immagini (elenco selezionabile, es. galleria di sezione). Ogni elemento è un array associativo:
```php
[
  "files"       => "album/nomefile.jpg",   // path relativo del file
  "title"       => "...",                   // title (da media_meta o autogenerato da titolo pagina)
  "caption"     => "...",
  "ordine"      => 1,
  "titolo"      => "...",                   // titolo specifico dell'immagine (pagine_immagini_info)
  "sottotitolo" => "...",
  "descrizione" => "...",                   // HTML, con path ripuliti
  "label"       => "...",
  "link"        => "...",                   // URL già risolto (interno/esterno/booking/offerta/documento)
  "target"      => "_blank" | "",
  "video"       => "..."                    // eventuale video associato
]
```
```php
$immagini = $this->getModulo('Immagine selezione');
foreach ($immagini as $img) { echo $img['files']; }
```

## [ Immagine singola ] — id_modulo 7
**Ritorna:** stessa struttura di **Immagine selezione** (stesso ramo di switch, case 4/7) — un `array` di immagini attive per quel modulo; nella pratica il template ne usa tipicamente solo la prima (`$immagini[0]`).

## [ Video ] — id_modulo 16
**Ritorna:** `string` — path del video con prefisso fisso, es. `"/video/nomefile.mp4"`.
```php
$video = $this->getModulo('Video'); // "/video/presentazione.mp4"
```

## [ Lista articoli ] — id_modulo 5
**Ritorna:** `array` di articoli — delega a `$this->getArticoli(...)`, che a sua volta interroga `pagine`/`pagine_contenuti` filtrando per sotto-tipo "articoli". Restituisce l'elenco di record articolo (id, titolo, testo, immagine anteprima, link, ecc. — struttura definita in `ArticleTrait::getArticoli()`).
```php
$articoli = $this->getModulo('Lista articoli');
foreach ($articoli as $art) { echo $art['titolo']; }
```

## [ Offerte ] — id_modulo 8
**Ritorna:** `array` di offerte selezionate/attive per la struttura, filtrate anche per dispositivo (desktop/mobile/tablet). Ogni elemento:
```php
[
  "offerta_id_prodotto"        => ...,
  "offerta_titolo"             => "...",
  "offerta_descrizione"        => "...",
  "offerta_descrizione_lunga"  => "...",
  "offerta_selling_ord"        => ...,
  "offerta_tipologia"          => "...",
  "offerta_id_albergo"         => ...,
  "desktop" => 1, "mobile" => 1, "tablet" => 1,
  "min_los" => ...,
  "id_categoria" => ...
]
```

## [ Gallery ] — id_modulo 9
**Ritorna:** `array` con due chiavi:
```php
[
  "categorie" => [ ["id_categoria"=>.., "categoria"=>"Nome", "slug"=>"nome"], ... ],
  "immagini"  => [ ["files"=>.., "title"=>.., "caption"=>.., "ordine"=>.., "titolo"=>.., "sottotitolo"=>.., "descrizione"=>.., "id_categoria"=>.., "video"=>..], ... ]
]
```
Rappresenta un'intera galleria fotografica organizzata per categorie (usata per le pagine "Gallery" del sito).

## [ Tipologia form ] — id_modulo 10
**Ritorna:** `string` (HTML del form pronto per il render) oppure il valore restituito dal metodo form specifico. In base alla sotto-tipologia configurata (`pagine_moduli.id_tipologia`) delega a uno di questi metodi (vedi anche `FormTrait`):
| id_tipologia | Delega a |
|---|---|
| 1, 5 | `form_newsletter()` |
| 2 | `form_contatti($privacy, 0, ...)` |
| 3 | `form_meeting()` |
| 4 | `form_contatti($privacy, 1, ...)` (lavora con noi) |
| 6, 7 | `club()` |
| 8 | `form_checkin_online()` |
| ≥ 9 | `form_personalizzato()` (form builder custom) |

## [ Link ] — id_modulo 11
**Ritorna:** `array` di link, ciascuno:
```php
[
  "label"  => "Testo del link",
  "ordine" => 1,
  "target" => "_blank" | "",
  "link"   => "https://..."   // già risolto in base al tipo (interno/esterno/booking/offerta/documento)
]
```

## [ Scelta pagine ] — id_modulo 22
**Ritorna:** `array` — stesso ramo dello switch di "Link" (case 11/22), ma con struttura semplificata pensata per referenziare pagine interne:
```php
[
  "id_pagina" => 123,   // id della pagina scelta
  "link"      => "https://..." // URL risolto della pagina
]
```

## [ Pressroom ] — id_modulo 12
**Ritorna:** `array` con tre chiavi, per generare sezioni "news/comunicati stampa" organizzate per categoria:
```php
[
  "categorie" => [ ["id_categoria"=>.., "categoria"=>"Nome", "slug"=>".."], ... ],
  "documenti" => [ id_categoria => [ ["id_pagina"=>.., "titolo"=>.., "data"=>.., "contenuti"=>[...]], ... ], ... ],
  "articoli"  => [ ["id_pagina"=>.., "id_categoria"=>.., "titolo"=>.., "data"=>.., "contenuti"=>[...]], ... ]
]
```
`contenuti` in ogni voce è un array associativo `dicitura_modulo => valore` (ricorsivamente ottenuto richiamando `getContenuto()` per ogni modulo del modello della pagina pressroom).

## [ Recensioni ] — id_modulo 13
**Ritorna:** `array` con chiave `recensioni`, elenco di recensioni pubblicate per la struttura:
```php
[
  "recensioni" => [
    [
      "id_pagina"    => ..,
      "valutazione"  => 4.5,
      "titolo"       => "...",
      "provenienza"  => "...",   // (usa il campo "sottotitolo" della pagina)
      "testo"        => "...",
      "ordine"       => ..,
      "sottotitolo"  => ...,     // valore del modulo "sottotitolo" associato a quella pagina recensione
      "extra"        => ...      // valore del modulo "extra" associato
    ], ...
  ]
]
```

## [ Gruppi moduli ripetibili ] (GMR) — id_modulo 14
**Ritorna:** `array` — è il modulo "contenitore" più complesso: rappresenta un **gruppo ripetibile di sotto-moduli** (fino a 3 livelli di annidamento), tipico di componenti come "elenco caratteristiche", "slide multiple", "box ripetuti con titolo+testo+immagine". Ogni ripetizione produce un array associativo con chiave = dicitura del sotto-modulo (in minuscolo, spazi sostituiti da `_`) e valore = il contenuto di quel sotto-modulo risolto **ricorsivamente** con la stessa logica di questa tabella (quindi un sotto-modulo "Titolo" restituirà una stringa, un sotto-modulo "Immagine selezione" un array immagini, ecc.), e così via se un sotto-modulo è a sua volta un GMR (annidamento).
```php
$gruppi = $this->getModulo('Box caratteristiche');
foreach ($gruppi as $box) {
    echo $box['titolo'];   // stringa
    echo $box['testo'];    // stringa HTML
    print_r($box['immagine']); // array immagini
}
```

## [ Lista pagine da Menu ] — id_modulo 15
**Ritorna:** `array` — l'elenco delle voci di menu figlie di una voce configurata (delega a `$this->getMenu()`), utile per generare automaticamente elenchi di link a partire da una struttura di menu esistente (es. "tutte le sotto-pagine di Camere").
```php
$vociMenu = $this->getModulo('Lista pagine da Menu');
```

## [ Scelta multipla ] — id_modulo 17
**Ritorna:** `string` — il valore scelto (letto direttamente da `pagine_moduli.testo`), tipicamente uno tra un set di opzioni predefinite in fase di configurazione modulo (es. "sinistra"/"destra", uno slug di variante layout).
```php
$variante = $this->getModulo('Layout'); // es. "sinistra"
```

## [ Mappa ] — id_modulo 20
**Ritorna:** `string` — stesso ramo di switch di "Scelta multipla"/"Data" (case 17/20/21): il valore grezzo salvato in `pagine_moduli.testo`, che normalmente contiene il **nome della mappa configurata** da passare poi a `$this->getMappa($nomeMappa)` per il rendering effettivo.
```php
$nomeMappa = $this->getModulo('Mappa');
echo $this->getMappa($nomeMappa);
```

## [ Data ] — id_modulo 21
**Ritorna:** `string` — il valore data salvato in `pagine_moduli.testo` (stessa gestione di Scelta multipla/Mappa), tipicamente in formato `YYYY-MM-DD` o quello scelto dal date-picker in admin.
```php
$data = $this->getModulo('Data pubblicazione');
```

---

## Moduli non presenti nella lista richiesta ma gestiti dallo stesso switch (per completezza)

| Modulo | id_modulo | Ritorna |
|---|---|---|
| Lista tag | 23 | `array` di tag univoci raccolti dalle configurazioni associate (`$this->getTagContent()` per ciascuna configurazione, poi `array_unique`). |
| Separatore | 24 | Modulo puramente visivo/di editing, non gestito nello switch di `getContenuto()` (nessun contenuto associato, serve solo lato admin per organizzare visivamente i moduli nel form). |

---

## Riepilogo tipo di ritorno per categoria

| Tipo di ritorno | Moduli |
|---|---|
| `string` (testo semplice/HTML) | Titolo, Sottotitolo, Testo, Testo breve, Video (path), Scelta multipla, Mappa (nome), Data, Tipologia form (se ritorna HTML) |
| `array` di elementi omogenei | Immagine selezione, Immagine singola, Lista articoli, Offerte, Link, Scelta pagine, Lista pagine da Menu, Gruppi moduli ripetibili |
| `array` strutturato con più chiavi | Gallery (`categorie`+`immagini`), Pressroom (`categorie`+`documenti`+`articoli`), Recensioni (`recensioni`) |

---

## Nota implementativa

Tutta la logica descritta vive in un unico metodo, `getContenuto()` (in `PageContentTrait.php`), che riceve `$id_modello`/`$id_pagina`/`$ordine_modulo` (la "dicitura"), interroga `modelli_moduli` per scoprire l'`id_modulo` associato, e poi esegue lo `switch` che innesca la query/logica specifica descritta sopra. `getModulo()` è solo un wrapper comodo che risolve automaticamente il modello/componente corrente e delega a `getContenuto()`.

Esiste inoltre, lato **amministrazione** (non front-end), una gerarchia parallela di classi in `app/Modules/*.php` (`Testo.php`, `Video.php`, `Gallery.php`, `Offerte.php`, `ImmagineSelezione.php`, `Link.php`, `Pressroom.php`, `Recensioni.php`, `Gmr.php`, `SceltaMultipla.php`, `Mappa.php`, `Form.php`, `ListaArticoli.php`, `ListaPagineMenu.php`, `ListaTag.php`, `Separatore.php`, `Input.php`), istanziate da `ModuleFactory::init()` in base allo stesso `id_modulo`: queste classi gestiscono il **rendering del form di editing e il salvataggio dei dati** nel pannello admin, mentre `getContenuto()`/`getModulo()` gestiscono la **lettura per il front-end pubblico** — sono due facce dello stesso `id_modulo`, ma codice separato.
