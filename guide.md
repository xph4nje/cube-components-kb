---
title: Componenti
layout: default
nav_order: 2
---

# Agile

> Guida operativa a BlastPlan, BlastDev, composizioni, stili e componenti.

## Introduzione / Panoramica

Agile è un sistema per progettare, comporre e pubblicare siti web basati su componenti riutilizzabili e su una gestione centralizzata degli stili all'interno di Cube.
Il flusso Agile è suddiviso in due aree principali:

- **BlastPlan – Composizioni**: dove si creano e si gestiscono progetti, stili e composizioni di pagina.
- **BlastDev – Componenti**: dove si definiscono e configurano componenti, componenti statici e la loro struttura (HTML/PHP, SCSS, JavaScript e config).

L'obiettivo è:

- Standardizzare componenti tra progetti diversi.
- Velocizzare il passaggio da demo approvata a sito in produzione.

## Scopo del documento

Questo documento spiega come utilizzare Agile nelle sue due aree principali:

- Come usare BlastPlan per creare stili e composizione.
- Come usare BlastDev per definire e configurare componenti.
- Come stili, componenti e composizioni interagiscono nel flusso Agile.
- Quali sono le funzioni, le convenzioni e le buone pratiche principali.

Destinatari:

- Grafici che creano composizioni.
- Programmatori che costruiscono e mantengono componenti in BlastDev.
- Chiunque si occupi del passaggio da demo approvata a sito online.

## Architettura / Concetti chiave

### Architettura ad alto livello

- **Progetto**
  Entità di livello più alto in BlastPlan. Un progetto può avere:
  - una o più commesse;
  - una o più composizioni.
- **Composizione di pagina**
  Layout di pagina costruito a partire da componenti:
  - diviso nelle dropzone **Header**, **Content** e **Footer**;
  - utilizza componenti e componenti statici definiti in BlastDev;
  - prevede dropzone clonabili tra più pagine e personalizzabili per singola pagina.
- **Demo**
  Composizione di pagina non ancora pubblicata, utilizzata per creare e presentare il layout al cliente.
- **Istanza di sito Agile**
  Quando il cliente approva una demo:
  - si crea una nuova istanza Agile del sito in Cube;
  - l’istanza viene associata al progetto;
  - le composizioni vengono trasferite dal progetto al sito.
- **Componente (BlastDev)**
  Blocco riutilizzabile composto da:
  - struttura (HTML/PHP);
  - stile (SCSS);
  - comportamento (JavaScript);
  - configurazione (JSON) con struttura ad albero, blocchi e mappature.
- **Componente statico**
  Variante specializzata che:
  - esiste solo all’interno di un componente padre;
  - fornisce varianti visive o di comportamento, per esempio diversi stili di pulsante;
  - legge le proprietà tramite `getVariantProp()`.

## Setup / Attivazione del flusso

### 1. Creare o individuare un progetto (BlastPlan)

1. Apri **BlastPlan – Composizioni** in Cube.
2. Crea un nuovo Progetto o selezionane uno esistente.
3. Associa una o più commesse al progetto.

### 2. Creare una demo per il progetto

1. All'interno del progetto, crea una nuova demo.
2. Crea o seleziona uno stile da associare alla composizione demo.
3. Usa la composizione demo per:
   - Sperimentare layout e componenti.
   - Preparare più proposte grafiche per lo stesso progetto.

Lascia lo stile non selezionato se desideri creare una composizione demo in modalità wireframe.

### 3. Passare da demo approvata a sito

Quando una demo viene approvata:

1. Crea una nuova istanza del sito Agile in Cube.
2. Associala al progetto.
3. Trasferisci le composizioni dalla demo al sito.

Nel sito:

- Vai in **Aspetto → Composizioni** per vedere tutte le composizioni trasferite.
- Da quel momento:
  - Le composizioni sul sito non sono più collegate alla demo.
  - Le modifiche sulla demo non si riflettono sul sito, e viceversa.

## Configurazione

### Stili e ereditarietà degli stili

#### Stile base

Ogni composizione di pagina può avere uno stile associato che definisce:

- Colori, tipografia, spaziature.
- Elementi globali come H1, H2, pulsanti, testi base.

Flusso tipico:

- Il designer prepara lo stile completo.
- Implementa lo stile definendo le variabili (palette colori, spacing, ecc.).
- Mappa le variabili sugli elementi globali (H1, H2, pulsanti, testi).

Risultato:

- Titoli, pulsanti e testi hanno uno stile coerente in tutto il sito.
- Si riduce al minimo la duplicazione manuale.

#### Stili figli

Gli stili figli:

- Ereditano le associazioni dal loro stile padre.
- Permettono di modificare solo le variabili.

Sono utili per:

- Gestire siti di gruppo con la stessa struttura ma branding o colori diversi.
- Una volta che il sito è associato alla composizione di pagina, lo stile attivo dei figli può essere cambiato dalle Impostazioni, come se fosse una variabile di struttura.

### Struttura della composizione di pagina

Ogni composizione di pagina è divisa in tre dropzone (aree):

1. Header
2. **Content**
3. Footer

Questa divisione permette di:

- Clonare facilmente aree comuni (per esempio header e footer dalla home) su tutte le pagine interne.
- Personalizzare alcune impostazioni sulle aree clonate per singola pagina (per esempio altezza gallery top, visibilità slider offerte, ecc.).

### Modalità di aggiunta dei componenti

I componenti si aggiungono dalla colonna in basso a sinistra, tramite due modalità:

1. **Modalità “Bacchetta magica”**
   - Componenti già pronti, con proprietà preconfigurate.
   - Ideali per ottenere velocemente un blocco grafico finale.
2. **Modalità “Sarto”**
   - Componenti “grezzi”, senza proprietà impostate.
   - Usano solo i valori di default.
   - Devono essere personalizzati completamente.

### Modalità “Sarto” – utilizzo degli esempi

In modalità “Sarto”, oltre alla lista dei componenti grezzi, per ogni componente è disponibile il pulsante “Esempi”.
Il pulsante Esempi permette di:

- Visualizzare tutti gli utilizzi reali di quel componente all’interno delle composizioni esistenti.
- Riutilizzare un componente già configurato senza doverlo ricostruire da zero.

#### Flusso di utilizzo

1. Attiva la modalità Sarto.
2. Cerca il componente desiderato.
3. Clicca su Esempi.
4. Individua l’esempio che corrisponde al risultato grafico o funzionale desiderato.
5. Con tasto destro sull’esempio:
   - Seleziona la dropzone (Header, **Content** o Footer) in cui inserirlo.

Il componente verrà inserito nella composizione con le stesse impostazioni e proprietà dell’esempio selezionato.

#### Vantaggi

- Riduce drasticamente il tempo di composizione.
- Evita duplicazioni inutili di configurazioni complesse.
- Favorisce coerenza grafica e funzionale tra le pagine.
- Permette di lavorare per riuso di soluzioni approvate, invece che per ricostruzione manuale.

## Flussi di lavoro principali

### 1. Creazione e gestione della demo

#### 1.1 Wireframe (opzionale)

In fase di creazione di una composizione di pagina puoi generare una bozza wireframe:

- Senza colori, font o immagini.
- Utile per mostrare solo il layout al cliente, senza influenze estetiche.

Al momento il flusso tipico è passare direttamente allo stile completo, quindi l'uso dei wireframe è facoltativo.

#### 1.2 Creazione dello stile completo

Flusso tipico:

1. Il grafico prepara lo stile completo (colori, tipografia, spaziature, ecc.).
   - Inserisce nel sistema le variabili (palette colori, spaziature, ecc.).
   - Associa le variabili agli elementi globali (H1, H2, pulsanti, testi, ecc.).

Questo garantisce:

- Uniformità di titoli, pulsanti e testi in tutto il sito.
- Riduzione del lavoro manuale in ogni singola composizione.

### 2. Composizione del sito

#### 2.1 Comporre la pagina

1. Seleziona la composizione di pagina che vuoi modificare.
2. Struttura la pagina in:
   - Header
   - **Content**
   - Footer
3. Trascina i componenti nelle aree appropriate a partire dal menu componenti.

#### 2.2 Clonare aree e personalizzarle

- Puoi clonare aree come header e footer da una composizione (per esempio la home) ad un’altra.
- Anche nelle aree clonate puoi modificare alcune impostazioni, ad esempio:
  - Fare in modo che in una pagina specifica l'immagine occupi solo il 50%.
  - Nascondere lo slider delle offerte in alcune pagine.

### 3. Gestione dei componenti

#### 3.1 Aggiungere e gestire i componenti

Per gestire i componenti in una composizione:

- Trascina i componenti in header, content o footer.
- Usa il tasto destro su un componente per:
  - Duplicare.
  - Nascondere.
  - Rinominare.
  - Eliminare.
  - Modificare.

Puoi anche trascinare il componente per riordinarlo all'interno della composizione.
Quando un componente viene rinominato dal **Visual Composer** all’interno di una composizione:
Il nome assegnato al componente non è solo descrittivo nella composizione.
Quel nome viene riutilizzato automaticamente nelle sezioni dei moduli durante la creazione o modifica delle pagine sul sito finale.

#### 3.2 Proprietà dei componenti

Le proprietà si dividono in due categorie principali:

##### 1. Proprietà generali

Esempi:

- Padding.
- Sfondo.
- Bordo.
- Colore del testo e dei link generici.

Agiscono sull'intero componente.

##### 2. Proprietà degli elementi interni

- Si riferiscono a parti specifiche del componente.
- Si selezionano:
  - Dall'alberatura.
  - Oppure dall'anteprima.
- Modificando queste proprietà, modifichi solo l'istanza del componente nella composizione, non il componente originale.

### 4. Gestione dei contenuti dei componenti

Durante la creazione della composizione puoi intervenire su:

- Valori delle proprietà.
- Contenuti di testo, immagini, ecc.

#### Contenuti faker

Nella sezione **Content** puoi trovare contenuti faker:

- Dati di esempio legati ai moduli associati al componente.
- Questi contenuti non vengono trasferiti sul sito finale.

Sul sito reale:

- Gli editor creano le pagine scegliendo la composizione (invece del classico modello di pagina).
- I contenuti reali vengono inseriti direttamente sul sito.

I contenuti faker servono solo per le demo. Non compaiono mai sul sito finale, quindi assicurati che gli editor sappiano quali testi e immagini dovranno essere ricreati in produzione.

### 5. Componenti statici e varianti

#### 5.1 Componenti statici nelle composizioni

Un componente può richiamare componenti statici, ovvero varianti predefinite di un elemento (ad esempio diversi tipi di pulsante).
Esempio:

- Il componente "box alternati" richiama un componente statico della categoria "buttons".
- All'interno di quella categoria puoi passare da un pulsante all'altro tra tutte le varianti disponibili.

I componenti statici possono essere:

- Gestiti dallo stile globale (per esempio i pulsanti).
- Personalizzati manualmente:
  - Le personalizzazioni fatte sull'istanza del componente statico vincono sulle proprietà definite nello stile.

#### 5.2 Componenti overlay

- I componenti overlay sono elementi grafici in posizione absolute.
- Si usano come dettagli aggiuntivi sopra un componente esistente (per esempio elementi decorativi).

#### 5.3 Componenti con layout (header e footer)

Alcuni componenti, come header e footer, hanno una sezione aggiuntiva chiamata Layout, modificabile attivando l’interruttore “Componi il layout”.

- Nel layout vengono mappate aree che possono contenere componenti statici.
- È possibile inserire componenti statici nelle diverse aree cliccando sull’icona del “+” presente nell’area.
- È possibile impostare visibilità differenziata dei componenti statici per:
  - Desktop.
  - Tablet.
  - Mobile.

Questo consente layout responsive con componenti dedicati per dispositivo.

### 6. Preview e stati della composizione

Per una composizione puoi visualizzare diversi stati:

- Stato scrolled.
- Menu aperto.
- QR aperto.
- Zoom in / zoom out.
- Vista visual composer:
  - Desktop.
  - Mobile.
- Anteprima:
  - Desktop.
  - Mobile.

Queste viste servono per verificare interazioni, spaziature e comportamento responsive prima dell'approvazione.

### 7. Dalla demo al sito

Quando la composizione di pagina viene approvata:

1. Crea l'istanza del sito in Cube.
2. Associala al progetto.
3. Trasferisci le composizioni al sito.

Nel sito:

- In **Aspetto → Composizioni** trovi tutte le composizioni trasferite.
- Da quel momento in poi:
  - Le composizioni del sito non sono collegate alla composizione di pagina originale.
  - Le modifiche nella composizione di pagina non si riflettono più sul sito, e viceversa.

Dopo il trasferimento delle composizioni, ogni modifica va fatta direttamente sull'istanza del sito. Gli aggiornamenti successivi in demo non vengono propagati automaticamente.

## BlastDev – Componenti

### Panoramica

BlastDev è l'area di Cube dedicata a:

- Creazione, gestione e configurazione dei componenti.
- Definizione di:
  - Componenti.
  - Componenti statici.
  - Categorie di componenti.
  - Categorie di componenti statici.

Tutti i blocchi visivi utilizzati nelle composizioni sono definiti in BlastDev.

### Tipologie di componenti

#### 1. Componenti normali

Un componente normale:

- Può essere usato ovunque nel sito.
- Può richiamare componenti statici al suo interno.
- Usa le proprietà definite nel pannello Proprietà tramite:

```php
$this->getProp('Nome proprietà', $default);
```

#### 2. Componenti statici

Un componente statico:

- Può avere una o più varianti (es. pulsante primario/secondario, card con/senza immagine).
- Esiste solo all'interno di un componente padre.
- Personalizza il comportamento o l'aspetto del componente padre.
- Usa:

```php
$this->getVariantProp('Nome proprietà', $default);
```

In sintesi, un componente statico è una parte strutturale del componente normale che lo ospita.

### Creazione di un componente

Quando crei un nuovo componente devi impostare:

- Nome del componente.
- Slug.
- Categoria.
- Preview (opzionale).

Una volta creato, il componente è organizzato nelle sezioni:

- **Info Componente** (editor).
- Moduli.
- Proprietà.
- Varianti.

### Info Componente – Editor

La sezione **Info Componente** contiene un editor suddiviso in:

1. HTML/PHP.
2. CSS (SCSS).
3. JavaScript.
4. Config (JSON).

#### Struttura HTML/PHP

Nel tab HTML/PHP scrivi la struttura del componente esattamente come in un normale file PHP.
Sono disponibili:

- Le funzioni standard di Cube.
- Funzioni aggiuntive specifiche dei componenti.

##### Funzioni aggiuntive

```php
// Proprietà del componente
$this->getProp('Nome proprietà', $default);

// Proprietà della variante (componente statico)
$this->getVariantProp('Nome proprietà', $default);

// Variante attiva (componente statico)
$this->getVariant(); // restituisce la variante corrente

// Recupero di un altro componente per la composizione
$this->getComponent('Nome o ID componente');

// Placeholder di variante in config/struttura
$this->getVariantPlaceholder();

// Tutte le proprietà risolte per il componente corrente
$props; // array con le proprietà del componente
```

#### CSS / SCSS

Nel tab CSS definisci lo stile del componente utilizzando SCSS.

##### Uso delle proprietà

Le proprietà si richiamano con una sintassi dedicata, ad esempio:

```scss
padding: [Padding Elemento|valore di default];
```

Per le proprietà gruppo si utilizzano shortcode, per esempio:

```text
[Formattazione Testo]
```

##### Responsive

Non usare media query manuali del tipo:

```scss
@media screen and (max-width: 1024px) {
...
}
```

Usa invece gli shortcode forniti dal sistema:

- `§MOBILE§`
- `§TABLET§`

Questi verranno tradotti internamente nel comportamento responsive corretto.

##### Scope dello stile

- Gli stili definiti nel componente agiscono solo all'interno del componente.
- Non devono essere usati per definire regole globali di pagina.

##### Valori di default e variabili di stile

I valori di default devono usare sempre le variabili di stile della pagina, per esempio:

```css
--transparent
--light
--light-primary
--light-secondary
--dark
--dark-primary
--dark-secondary

--spaces-0
--spaces-xs
--spaces-s
--spaces-m
--spaces-l
--spaces-xl

--size-s
--size-m
--size-l
--size-full

--font-s
--font-b
--font-m
--font-l
--font-xl
--font-xxl

--lineheights-s
--lineheights-b
--lineheights-m
--lineheights-l

--textalign-left
--textalign-center
--textalign-right
--textalign-justify

--font-titles
--font-text

--img-xwide
--img-whide
--img-normal
--img-quad
--img-vert
--img-xvert

--font-wlight
--font-wregular
--font-wbold
```

Questo assicura coerenza con il sistema di stile globale.

#### JavaScript

Nel tab JavaScript inserisci la logica del componente.

- Lo script viene caricato solo quando il componente è presente sulla pagina.
- Puoi utilizzare librerie esterne dichiarate nel file config (JSON).

#### Config (JSON)

Il file config serve per:

1. Associare librerie esterne
   - Per esempio: Swiper, LightGallery, ecc.
2. Associare Blocchi.
3. Definire la struttura ad albero del componente:
   - Mappare i nodi.
   - Collegare le proprietà a nodi specifici.
   - Definire alberature per componenti statici e varianti.

In passato la struttura del config imitava la struttura HTML, ma risultava poco chiara per i grafici.
Oggi si preferisce una struttura simbolica, semplificata ma completa.
Esempio concettuale:

```json
{
  "struct": [
    {
      "name": "Contenitore",
      "selector": ".selettore",
      "childs": [
        {
          "name": "Elemento",
          "selector": ".selettore",
          "childs": []
        }
      ]
    }
  ],
  "blocks": [
    {
      "id": 23,
      "name": "Blocco menu"
    },
    {
      "id": 20675,
      "name": "Blocco extra menu"
    }
  ],
  "dependencies": [
    {
      "slug": "swiper",
      "trigger": "scroll",
      "version": 6
    }
  ]
}
```

### Moduli

Nella sezione Moduli puoi associare uno o più moduli al componente.
📌 I componenti statici non possono avere moduli associati. I moduli sono disponibili solo per i componenti normali.
I moduli vengono poi utilizzati per:

- Fornire dati ai componenti.
- Popolare i contenuti faker nelle composizioni di pagina.

### Proprietà del componente

Le proprietà definiscono ciò che l'utente può personalizzare in un componente.

#### 1. Proprietà singole

Sono usate direttamente come valori CSS, ad esempio:

```scss
padding: [Padding Elemento|default];
width: [Larghezza|default];
```

Esempi di proprietà singole:

- `free` permette di utilizzare proprietà custom
- `sizes` aggiunge la possibilità di gestire le dimensioni massime specificate nello stile
- `colors` (proprietà obsoleta) gestisce il color del testo
- `background` aggiunge la possibilità di cambiare colore dello sfondo dell’elemento
- `spaces` aggiunge la possibilità di gestire il padding dell’elemento utilizzando le dimensioni specificate nello stile.
- `imageformat` aggiunge la possibilità di gestire il formato dell’immagine
- `imagefit` aggiunge la possibilità di gestire l’object-fit dell’immagine
- `aspect ratio` permette di gestire l’aspect ratio per le immagini
- `filter` permette di gestire il filter per le immagini
- `paddings` aggiunge la possibilità di gestire il padding dell’elemento utilizzando le dimensioni libere
- `fontfamily` (proprietà obsoleta) gestisce il font family
- `fontweights` (proprietà obsoleta) gestisce il font family
- `lineheights` (proprietà obsoleta) gestisce il line height
- `textalign` (proprietà obsoleta) gestisce il text align
- `border-width` (proprietà obsoleta) gestisce il border width
- `texttransform` (proprietà obsoleta) gestisce il text transform
- `border-color` (proprietà obsoleta) gestisce il border-color
- `border-style` (proprietà obsoleta) gestisce il border-style
- `cdnimagename` permette di inserire un’immagine
- `content` permette di inserire del contenuto libero (es. codice svg per illustrazioni)
- `boolean` permette di utilizzare proprietà yes/no.
- `width` aggiunge la possibilità di gestire dimensioni in px, rem, percentuali, percentuali schermo e variabili dello stile
- `icon` permette di selezionare un’icona svg da un set di icone standard
- `animation` permette l’inserimento di animazioni
- `variantplaceholder` permette di definire un’area placeholder
- `font-style` (proprietà obsoleta) gestisce il font style
- `flex-align-v` permette di gestire l’allineamento verticale per gli elementi flex
- `flex-align-h` permette di gestire l’allineamento orizzontale per gli elementi flex

#### 2. Proprietà gruppo

Si inseriscono tramite shortcode e gestiscono più regole CSS insieme, per esempio:

```text
[Formattazione Testo]
```

Esempi di gruppi:

- `grp-text` aggiunge la possibilità di gestire le proprietà del testo. Composto da:
  - color
  - font-family
  - font-weight
  - line-height
  - font-size
  - text-align
  - font-style
  - letter-spacing
  - text-transform
- `grp-free-align` aggiunge la possibilità di gestire l’allineamento degli elementi in flex. Composto da:
  - justify-content
  - align-items
- `grp-border` aggiunge la possibilità di gestire i bordi dell’elemento. Composto da:
  - colore bordo
  - spessore bordo
  - stile bordo
  - border radius
- `grp-icon-style` aggiunge la possibilità di gestire grandezza e colore delle icone fontawesome. Composto da:
  - font-size/height/line-height
  - color/fill

#### Mappatura delle proprietà

Ogni proprietà deve essere associata a un nodo dell'albero definito nel file di config.
Funzioni PHP rilevanti:

```php
// Proprietà del componente normale
$this->getProp('Nome proprietà', 'default');

// Proprietà del componente statico (variante)
$this->getVariantProp('Nome proprietà', 'default');
```

### Varianti

Nella sezione Varianti puoi:

- Definire tutte le varianti disponibili per un componente statico.
- Assegnare a ciascuna variante proprietà specifiche.

In PHP, recuperi la variante attiva con:

```php
$this->getVariant('Nome variante');
```

Le varianti permettono di generare versioni diverse dello stesso componente statico, per esempio:

- Pulsante primario / secondario.
- Card con immagine / card senza immagine.
