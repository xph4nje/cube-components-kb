# Mappa delle proprietà (Agile property types)

Documento di riferimento per i **tipi di proprietà** utilizzabili dai componenti e per i
**token CSS** (custom properties) ammessi. Ricavato dallo schema `Agile property types`
(schemaVersion 1.0.0).

## Regole generali

- **Variabili**: quando un tipo usa una variabile, nel payload va sempre salvato il
  token `var(--nome-variabile)`, mai il valore CSS già risolto.
- **Gruppi**: vengono serializzati come dichiarazioni CSS multiple separate da `;`
  (es. `font-size: var(--font-l); line-height: var(--lineheights-s);`).
- **Tuple**: i valori multipli (padding, border-width, ecc.) rispettano sempre l'ordine
  `top, right, bottom, left`.

---

## Set di variabili (design token)

### Colori (`colors`) 
| Nome | Token | Label |
|---|---|---|
| `--trasparent` | `var(--trasparent)` | Trasparente |
| `--light` | `var(--light)` | Chiaro |
| `--light-primary` | `var(--light-primary)` | Chiaro primario |
| `--light-secondary` | `var(--light-secondary)` | Chiaro secondario |
| `--dark` | `var(--dark)` | Scuro |
| `--dark-primary` | `var(--dark-primary)` | Scuro primario |
| `--dark-secondary` | `var(--dark-secondary)` | Scuro secondario |

### Spaziature (`spaces`)
| Nome | Token | Label |
|---|---|---|
| `--spaces-0` | `var(--spaces-0)` | Nessuno |
| `--spaces-xs` | `var(--spaces-xs)` | Extra small |
| `--spaces-s` | `var(--spaces-s)` | Small |
| `--spaces-m` | `var(--spaces-m)` | Medium |
| `--spaces-l` | `var(--spaces-l)` | Large |
| `--spaces-xl` | `var(--spaces-xl)` | Extra large |

### Dimensioni contenitore (`sizes`)
| Nome | Token | Label |
|---|---|---|
| `--size-s` | `var(--size-s)` | Small |
| `--size-m` | `var(--size-m)` | Medium |
| `--size-l` | `var(--size-l)` | Large |
| `--size-full` | `var(--size-full)` | Full |

### Dimensioni font (`fontSizes`)
| Nome | Token | Label |
|---|---|---|
| `--font-s` | `var(--font-s)` | Small |
| `--font-b` | `var(--font-b)` | Base |
| `--font-m` | `var(--font-m)` | Medium |
| `--font-l` | `var(--font-l)` | Large |
| `--font-xl` | `var(--font-xl)` | Extra large |
| `--font-xxl` | `var(--font-xxl)` | Extra extra large |

### Interlinea (`lineHeights`)
| Nome | Token | Label |
|---|---|---|
| `--lineheights-s` | `var(--lineheights-s)` | Compatta |
| `--lineheights-b` | `var(--lineheights-b)` | Base |
| `--lineheights-m` | `var(--lineheights-m)` | Media |
| `--lineheights-l` | `var(--lineheights-l)` | Ampia |

### Allineamento testo (`textAlign`)
| Nome | Token | Label |
|---|---|---|
| `--textalign-left` | `var(--textalign-left)` | Sinistra |
| `--textalign-center` | `var(--textalign-center)` | Centro |
| `--textalign-right` | `var(--textalign-right)` | Destra |
| `--textalign-justify` | `var(--textalign-justify)` | Giustificato |

### Famiglie font (`fontFamilies`)
| Nome | Token | Label |
|---|---|---|
| `--font-titles` | `var(--font-titles)` | Font titoli |
| `--font-text` | `var(--font-text)` | Font testo |

### Formati immagine (`imageFormats`)
> Le variabili `--img-*` restituiscono **percentuali** (usate tipicamente in `padding-bottom` per il trick aspect-ratio).

| Nome | Token | Label |
|---|---|---|
| `--img-xwide` | `var(--img-xwide)` | Molto orizzontale |
| `--img-whide` | `var(--img-whide)` | Orizzontale |
| `--img-normal` | `var(--img-normal)` | Normale |
| `--img-quad` | `var(--img-quad)` | Quadrata |
| `--img-vert` | `var(--img-vert)` | Verticale |
| `--img-xvert` | `var(--img-xvert)` | Molto verticale |

### Rapporti immagine (`aspectRatios`)
> Usare le variabili `--ar-*` (proprietà CSS `aspect-ratio`), non confonderle con `--img-*`.

| Nome | Token | Label |
|---|---|---|
| `--ar-xwide` | `var(--ar-xwide)` | Molto orizzontale |
| `--ar-whide` | `var(--ar-whide)` | Orizzontale |
| `--ar-normal` | `var(--ar-normal)` | Normale |
| `--ar-quad` | `var(--ar-quad)` | Quadrata |
| `--ar-vert` | `var(--ar-vert)` | Verticale |
| `--ar-xvert` | `var(--ar-xvert)` | Molto verticale |

### Peso font (`fontWeights`)
| Nome | Token | Label |
|---|---|---|
| `--font-wlight` | `var(--font-wlight)` | Light |
| `--font-wregular` | `var(--font-wregular)` | Regular |
| `--font-wbold` | `var(--font-wbold)` | Bold |

---

## Tipi di proprietà

### Enum (valore raw, lista chiusa di opzioni)

| Tipo | Label | CSS property | Valori accettati |
|---|---|---|---|
| `boolean` | Booleano | — | `yes` (Sì), `no` (No) |
| `imagefit` | Adattamento immagine | — | `cover` (Copri il contenitore), `contain` (Mostra tutta l'immagine), `auto` (Automatico) |
| `texttransform` | Trasformazione testo | — | `uppercase` (Maiuscolo), `lowercase` (Minuscolo), `capitalize` (Iniziali maiuscole), `none` (Nessuna) |
| `border-style` | Stile bordo | — | `solid` (Continuo), `dashed` (Tratteggiato), `none` (Nessun bordo) |
| `font-style` | Stile font | — | `italic` (Corsivo), `normal` (Normale) |
| `flex-align-v` | Allineamento verticale | `align-items` | `flex-start` (In alto), `center` (Al centro), `flex-end` (In basso) |
| `flex-align-h` | Allineamento orizzontale | `justify-content` | `flex-start` (A sinistra), `center` (Al centro), `flex-end` (A destra), `space-between` (Spazio tra gli elementi) |

### Variable (output = singolo token `var(--...)`)

| Tipo | Label | Variable set | Note |
|---|---|---|---|
| `textalign` | Allineamento testo | `textAlign` | Ammette anche alias raw: `left`, `center`, `right`, `justify` |
| `sizes` | Dimensione contenitore | `sizes` | cardinalità 1 |
| `colors` | Colore | `colors` | cardinalità 1 |
| `background` | Colore sfondo | `colors` | cardinalità 1 |
| `fontsizes` | Dimensione font | `fontSizes` | es. `var(--font-l)` |
| `fontfamily` | Famiglia font | `fontFamilies` | cardinalità 1 |
| `fontweights` | Peso font | `fontWeights` | cardinalità 1 |
| `lineheights` | Interlinea | `lineHeights` | cardinalità 1 |
| `border-color` | Colore bordo | `colors` | cardinalità 1 |
| `aspect-ratio` | Rapporto immagine | `aspectRatios` | usare `--ar-*`, non `--img-*` |
| `imageformat` | Formato immagine | `imageFormats` | `--img-*` restituiscono percentuali |

### Variable-tuple (output = più token `var(--...)` separati da spazio)

| Tipo | Label | Variable set | Cardinalità | Posizioni | Esempio |
|---|---|---|---|---|---|
| `spaces` | Spaziatura | `spaces` | 4 | top, right, bottom, left | `var(--spaces-m) var(--spaces-0) var(--spaces-m) var(--spaces-0)` |

### Number / Number-tuple (output = valori numerici unitless)

| Tipo | Label | Cardinalità | Posizioni |
|---|---|---|---|
| `width` | Larghezza | 1 | — |
| `border-width` | Spessore bordo | 4 | top, right, bottom, left |
| `paddings` | Padding numerico | 4 | top, right, bottom, left |

### String (output = valore raw testuale)

| Tipo | Label | Formato |
|---|---|---|
| `icon` | Icona | classe FontAwesome, es. `fa-light fa-arrow-right` |
| `cdnimagename` | Immagine CDN | path |
| `content` | Contenuto | free-text |
| `free` | Valore libero | raw, nessun formato vincolato |

### Disabled

| Tipo | Label | Motivo |
|---|---|---|
| `filter` | Filtro | Al momento non funzionante — non utilizzare |

---

## Gruppi (`kind: "group"`)

Un gruppo produce **più dichiarazioni CSS** (`css-declarations`), una per ogni `field`,
serializzate separate da `;`.

### `grp-text` — Gruppo stile testo
| Field | Tipo | CSS property |
|---|---|---|
| `color` | `colors` | `color` |
| `fontFamily` | `fontfamily` | `font-family` |
| `fontSize` | `fontsizes` | `font-size` |
| `lineHeight` | `lineheights` | `line-height` |
| `fontWeight` | `fontweights` | `font-weight` |
| `textAlign` | `textalign` | `text-align` |
| `textTransform` | `texttransform` | `text-transform` |
| `fontStyle` | `font-style` | `font-style` |
| `letterSpacing` | `number` (unitless) | `letter-spacing` ⚠️ *needs-confirmation* |

Esempio output: `font-size: var(--font-l); line-height: var(--lineheights-s);`

### `grp-border` — Gruppo bordo
| Field | Tipo | CSS property |
|---|---|---|
| `borderWidth` | `border-width` | `border-width` |
| `borderStyle` | `border-style` | `border-style` |
| `borderColor` | `border-color` | `border-color` |

### `grp-flex-align` — Gruppo allineamento flex
| Field | Tipo | CSS property |
|---|---|---|
| `justifyContent` | `flex-align-h` | `justify-content` |
| `alignItems` | `flex-align-v` | `align-items` |

### `grp-icon-style` — Gruppo stile icona
| Field | Tipo | CSS property |
|---|---|---|
| `fill` | `colors` | `fill` |
| `stroke` | `colors` | `stroke` |
| `height` | `number` (unitless) | `height` ⚠️ *needs-confirmation* |
| `fontSize` | `fontsizes` | `font-size` |

---

## Note e punti aperti

- I campi marcati `status: "needs-confirmation"` (`letterSpacing` in `grp-text`,
  `height` in `grp-icon-style`) usano un tipo `number`/`unitless` non ancora validato
  in via definitiva: verificare con il team prima di affidarsi ciecamente al comportamento.
- Il tipo `filter` è presente nello schema ma **disabilitato** (`enabled: false`):
  non esporlo nei componenti finché non viene riattivato.
- Per `aspect-ratio` vs `imageformat`: sono due variable set distinti (`--ar-*` vs
  `--img-*`) che sembrano coprire lo stesso concetto (proporzioni immagine) ma con
  output CSS diverso (`aspect-ratio` vs percentuale per `padding-bottom`) — scegliere
  in base alla tecnica di layout usata dal componente, non intercambiabili.
