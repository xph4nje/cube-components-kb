# Installazione del tema Agile

Carica nel repository `xph4nje.github.io` tutti i file e le cartelle di questo pacchetto,
mantenendo esattamente la stessa struttura.

La struttura finale principale deve essere:

```text
xph4nje.github.io/
├── _config.yml
├── index.md
├── _includes/
│   └── head_custom.html
└── _sass/
    ├── color_schemes/
    │   └── agile.scss
    └── custom/
        └── custom.scss
```

## Pubblicazione

Nelle impostazioni del repository GitHub:

1. Apri **Settings → Pages**.
2. In **Build and deployment**, seleziona **Deploy from a branch**.
3. Seleziona il branch **main** e la cartella **/(root)**.
4. Salva.

Il sito sarà pubblicato su:

```text
https://xph4nje.github.io/
```

## Personalizzazione

Il colore principale si modifica in:

```text
_sass/color_schemes/agile.scss
```

Il CSS aggiuntivo si modifica in:

```text
_sass/custom/custom.scss
```

Il font Satoshi viene caricato tramite Fontshare in:

```text
_includes/head_custom.html
```
