---
title: Standard
layout: default
nav_order: 4
---

# Standard di sviluppo componenti CUBE

Documento ricavato dall'analisi dei componenti esistenti nella cartella `components/`
(52 componenti, ognuno con struttura `componente.php`, `componente.css`, `componente.js`).

---

## 1. Struttura di un componente

Ogni componente vive in una propria cartella (kebab-case) e contiene sempre 3 file
con lo stesso nome fisso:

```
nome-componente/
├── componente.php   # markup + logica
├── componente.css   # stili (sintassi SCSS-like con nesting, compilati dal CMS)
└── componente.js    # comportamento JS del componente
```

Il nome della cartella coincide con la classe CSS radice del componente
(es. `abs-graphic-el/` → `.abs-graphic-el`).

---

## 2. PHP

### 2.1 Convenzioni di naming

- **Variabili locali**: `camelCase`, in inglese, descrittive dell'uso finale nel markup
  (es. `$hideMobile`, `$buttonVariant`, `$headingTitle`, `$isFixed`).
- **Prefissi booleani**: variabili booleane iniziano con `is`/`has`/`show` quando il senso
  lo richiede (`$isFixed`, `$hasCta`, `$showEmail`), altrimenti restano nomi diretti
  risultato di un confronto (`$hideMobile = getProp(...) == 'yes'`).
- **Modificatori CSS calcolati in PHP**: variabili brevi che rappresentano classi
  modificatrici da iniettare nel markup (`$mh`, `$anchor`, `$rev`, `$blur`), assegnate
  con espressioni ternarie che restituiscono la classe o stringa vuota.
- **Label delle proprietà CMS** (primo argomento di `getProp`/`getVariant`): sempre in
  **italiano**, con iniziale maiuscola per ogni parola significativa
  (es. `"Boxed Size"`, `"Inverti Titoli"`, `"Formato Foto Mobile"`).
- **Valori delle opzioni** (secondo argomento, default): stringhe minuscole `yes`/`no`,
  oppure valori descrittivi minuscoli (`"row"`, `"bottom-right"`, `"cover"`).
- I blocchi ripetuti/estratti da un item vengono nominati al singolare
  (`$block`, `$offer`, `$cta`, `$image`, `$room`) quando si itera una collezione al
  plurale (`$blocks`, `$offers`, `$ctas`, `$images`, `$rooms`).

### 2.2 Come recuperare le proprietà

Le proprietà semplici del componente si leggono con `$this->getProp(...)`:

```php
$svg   = $this->getProp("SVG", '');
$boxed = $this->getProp('Boxed Size'); // senza default se non serve un fallback esplicito
$hideMobile = $this->getProp('Hide Mobile', 'no') == 'yes';
```

Regole:
- Primo parametro = label italiana della proprietà così com'è definita nel CMS.
- Secondo parametro = valore di default (omesso solo se non necessario).
- Le proprietà booleane sono modellate come stringhe `"yes"/"no"` e vanno sempre
  normalizzate subito in un booleano PHP con `== "yes"` (mai usare il valore stringa
  direttamente nella logica).
- Tutte le `getProp` vanno dichiarate in cima al file, prima di qualunque markup HTML,
  raggruppate logicamente (proprietà di layout, poi booleani, poi testi).

### 2.3 Come recuperare le varianti

Per le proprietà di tipo "variante" (che restituiscono un set di più campi collegati,
tipicamente usati per configurare un sub-componente come un bottone o uno slider) si usa
`$this->getVariant(...)`:

```php
$buttonVariant = $this->getVariant('Tipologia pulsanti');
$buttonVariant = $this->getVariant('Pulsante Invio', 'basic-button'); // con default esplicito
```

- Primo parametro = label italiana della variante.
- Secondo parametro (opzionale) = nome della variante di default da usare.
- Se serve leggere **una singola proprietà interna alla variante attiva** (senza volerla
  istanziare per intero) si usa `$this->getVariantProp(...)`:

```php
$icon = $this->getVariantProp("Icona Vantaggi", "fa-light fa-star");
$iconPosition = $this->getVariantProp('Posizione Frecce', 'hidden');
```

### 2.4 Come recuperare i children

I contenuti "figli"/ripetuti si ottengono in due modi, a seconda della fonte:

1. **Repeater manuale** definito sul componente stesso → `$this->getModulo("Label")`,
   che restituisce un array di elementi:

```php
$blocks = $this->getModulo("Contenuto Blocchi Manuale");
if (is_array($blocks) && count($blocks) > 0) {
    foreach ($blocks as $block) {
        $images = $block['Gallery'];
        $ctas   = $block['Ctas'];
        ...
    }
}
```

2. **Figli presi dal menu/struttura del sito** → si combina un flag `getProp`/`getModulo`
   di scelta sorgente con le API di menu, poi si normalizza sempre allo stesso formato
   array con `menuVoicesToElenco(...)`:

```php
$childsContent = $this->getModulo("Contenuto Blocchi da Figli");
if ($childsContent == 'yes') {
    $menuSecondario = $this->getMenuSecondario();
    $blocks = $this->menuVoicesToElenco($menuSecondario);
} else if ($childsContent == 'menu') {
    $menuChilds = $this->getModulo("Contenuto Blocchi da Menu");
    $blocks = $this->menuVoicesToElenco($menuChilds);
} else {
    $blocks = $this->getModulo("Contenuto Blocchi Manuale");
}
```

Regole comuni:
- Prima di iterare, **verificare sempre** `is_array($x) && count($x) > 0`, o `isset(...)`
  per le chiavi opzionali dentro ogni item (`isset($offer['offerta_titolo']) ? ... : ...`).
- Avvolgere l'intero blocco di markup che dipende dai children in un `if` che ne verifica
  la presenza, per non stampare contenitori vuoti.
- Il markup HTML fuori dai tag `<?php ?>` va usato per il contenuto ripetuto; la logica
  di preparazione dati resta sempre in blocchi PHP separati prima del ciclo `foreach`.

---

## 3. SCSS (file `componente.css`)

### 3.1 Nesting consentito

- Nesting **BEM-style con `&`**, sempre partendo dalla classe radice = nome del
  componente:

```scss
.abs-graphic-el {
    ...
    &.menu-visible { ... }        // modificatore di stato
    &__inner { ... }               // elemento
    &__inner.boxed { ... }         // combinazione elemento + modificatore
    a { ... }                      // selettore discendente semplice, quando serve
    body.menu & { ... }            // selettore contestuale genitore
}
```

- Livelli di nesting profondi sono ammessi seguendo la gerarchia reale del markup
  (`&__elcontainer`, poi `&__inner` dentro, poi `&__inner__el`), ma il nome BEM completo
  viene sempre ricostruito con concatenazioni di `&__x__y` per riflettere il path DOM.
- Non annidare oltre la struttura DOM effettiva del componente: ogni livello di nesting
  corrisponde a un livello reale di markup, non va usato per pura organizzazione stilistica.

### 3.2 Uso di variabili

- **Non vengono usate variabili SCSS (`$var`)** nei componenti analizzati: nessun file
  ne contiene. Non introdurne di nuove per restare coerenti con la codebase esistente.
- Ogni valore "configurabile da CMS" è espresso con la sintassi placeholder
  `[Label Proprietà|valore di default]`, che il motore di rendering sostituisce con il
  valore impostato dall'editor (o il default se non impostato):

```scss
z-index: [Z-index|1];
padding: [Padding Icone|var(--spaces-0) 1rem var(--spaces-0) var(--spaces-0)];
max-width: [Boxed Size|var(--size-l)];
```

- Per varianti responsive (mobile/tablet) che devono **ereditare di default il valore
  desktop** invece di un valore fisso, si usa `@propAsDefault("Label Desktop", "fallback")`:

```scss
padding: [Padding Inner Mobile|@propAsDefault("Padding Inner","var(--spaces-0) ...")];
background: [Sfondo Box Mobile|@propAsDefault("Sfondo Box","var(--transparent)")];
```

- Le label dei placeholder seguono la stessa convenzione italiana Capitalizzata delle
  `getProp` in PHP, e quando esiste una variante mobile/tablet si aggiunge il suffisso
  `Mobile`/`Tablet` alla stessa label (es. `"Padding Box"` → `"Padding Box Mobile"`).

### 3.3 Uso delle custom properties

- Tutti i valori di design system (colori, spaziature, font-size, dimensioni) vanno
  espressi con **custom properties CSS** (`var(--token)`), mai valori hardcoded:

```scss
color: var(--dark);
gap: var(--spaces-xs);
font-size: var(--font-b);
max-width: var(--size-l);
padding-bottom: var(--img-normal);
```

- Token osservati per categoria (riutilizzare gli stessi, non introdurne di nuovi senza
  necessità):
  - Colori: `--dark`, `--light`, `--light-primary`, `--transparent`
  - Spaziature: `--spaces-0`, `--spaces-xs`, `--spaces-s`, `--spaces-m`, `--spaces-l`
  - Dimensioni contenitore: `--size-l`, `--size-full`
  - Tipografia: `--font-b`
  - Formati immagine: `--img-normal`
- Le custom properties si usano sia come **valore di default** dentro i placeholder
  CMS (`[Label|var(--token)]`) sia direttamente nel CSS per proprietà non configurabili
  dall'editor (es. `gap: var(--spaces-xs);` fisso, non esposto come prop).
- Per gruppi di dichiarazioni CSS interamente sostituibili da CMS (non un singolo
  valore ma un blocco), si usa il placeholder su un'intera dichiarazione:

```scss
[Formattazione Titolo|color:var(--dark);]
```

---

## 4. JS (file `componente.js`)

### 4.1 Naming

- **Variabili/costanti**: `camelCase`, nome che richiama il componente e l'elemento
  selezionato (`basicPageSliders`, `boxFisWrapper`, `boxFisPics`, `sliderOffers`).
- **Funzioni globali esposte** (quando il componente deve essere richiamabile da altri
  script o da markup inline `onclick`): assegnate su `window`, con nome descrittivo del
  componente + azione, in `camelCase`:

```js
window.genericGalleryFilter = (index, categoryID) => { ... };
window.genericPressroomFilter = (index, categoryID) => { ... };
window.historyFilter = (event) => { ... };
```

- I selettori DOM usano sempre la classe radice del componente come prefisso
  (`.base-page-slider`, `.box-fisarmonica__item`), coerente col nome della cartella e
  del BEM in CSS.

### 4.2 Inizializzazione

- Il codice **non è wrappato in IIFE**: ogni `componente.js` viene incluso ed eseguito
  quando serve, con side-effect diretti al top-level del file.
- Due pattern di inizializzazione osservati:
  1. **Ad esecuzione immediata**, quando il DOM del componente è certamente già presente
     al momento del caricamento dello script (es. `box-fisarmonica`):
     ```js
     const boxFis = document.querySelectorAll('.box-fisarmonica__item');
     ```
  2. **In attesa di un evento custom di inizializzazione di libreria**, quando il
     componente dipende da un plugin esterno (Swiper, SimpleLightbox) che deve essere
     pronto prima:
     ```js
     document.addEventListener('swiperInitialized', function (event) {
         const basicPageSliders = document.querySelectorAll('.base-page-slider');
         ...
     });
     document.addEventListener('simplelightboxInitialized', function (event) {
         if (document.querySelectorAll('.sml').length > 0) { ... }
     });
     ```
- Prima di operare su una NodeList, si verifica sempre la presenza effettiva di elementi
  con un controllo `.length > 0` quando l'operazione seguente non è già sicura di per sé
  (es. iterare con `forEach` su lista vuota è innocuo, ma un accesso singolo va guardato).

### 4.3 Eventi

- **Eventi custom applicativi**: nome in `camelCase`, dispatchati/ascoltati con
  `addEventListener`/i plugin di terze parti (`swiperInitialized`, `simplelightboxInitialized`).
- **Eventi nativi del browser**: gestiti con `addEventListener` diretto su elemento o su
  `window` (`click`, `resize`):

```js
item.addEventListener('click', () => { ... });
window.addEventListener('resize', () => { ... });
```

- **Callback inline da markup** (filtri, toggle) vengono esposte come funzioni globali
  su `window` (vedi 4.1) e richiamate direttamente da attributi `onclick` nel PHP,
  piuttosto che con binding via `addEventListener` — pattern usato per elenchi filtrabili
  (gallerie, pressroom, storico).
- Le arrow function sono lo stile preferito per le callback (`() => { ... }`), le
  `function` classiche vengono usate solo come handler di `addEventListener` quando
  serve accedere a `event`/`this` o per coerenza con il codice esistente in quel file.

---

## 5. Checklist rapida per un nuovo componente

- [ ] Cartella kebab-case = classe CSS radice
- [ ] `componente.php`: tutte le `getProp`/`getVariant`/`getModulo` in cima, label in
      italiano capitalizzate, booleani normalizzati subito
- [ ] Children: sempre `is_array() && count() > 0` prima del `foreach`
- [ ] `componente.css`: nesting con `&` che rispecchia il DOM, valori via
      `[Label|var(--token)]`, nessuna variabile SCSS `$`
- [ ] Responsive: usare `@propAsDefault("Label Desktop", "fallback")` per ereditare
      il valore desktop
- [ ] `componente.js`: selettori prefissati con la classe radice, init diretta o su
      evento di libreria (`swiperInitialized`, `simplelightboxInitialized`), funzioni
      condivise su `window` quando richiamate da markup
