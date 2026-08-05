# Classe `utili`

## Aree funzionali

- Rendering e template
- Hooks
- Lingue
- Strutture e siti
- Menu e navigazione
- Pagine e contenuti
- Immagini e media
- Offerte e articoli
- Form e lead generation
- Club / Area riservata
- Cookie e compliance
- Analytics
- Mappe e QR
- Gallery
- Utility varie

---

## Elenco metodi

### Rendering
- `cube_parts($file, array $variables = [], bool $print = true): false|string`
- `cube_part($file, array $variables = [], bool $print = true): false|string`
- `cube_head()`
- `cube_footer()`
- `cube_favico()`
- `cube_theme_roller(bool $opz = false, string $id_sito = ''): array`

### Hooks
- `addHook($hook_key, $func, string $parametri = '')`
- `doHook($hooKey, string $stringa = '', array $array = []): mixed|string`

### Lingue
- `trova_lingua($id_lingua, string $tipo_lingua = ''): mixed`
- `lingua_default(string $id_sito = '', string $id_struttura = ''): mixed`
- `getMenuLingue(bool $notForceUrl = false): mixed`
- `lg_testo(): string`
- `__($slug, string $id_lingua = ''): mixed`

### Strutture e siti
- `getIDStruttura(string $id_sito = ''): mixed`
- `getStrutture(string $id_sito = ''): array`
- `getListaStrutture(...) : mixed`
- `getInfoStruttura(...) : mixed`
- `grouppiStrutture($campo): array|void`
- `numero_strutture($id_sito): mixed`
- `info_sito($campo, string $id_sito = ''): mixed`
- `rowSito($id_sito): bool`
- `getImpostazioneTemplate($impostazione): mixed`
- `getImpostazione($impostazione, string $id_sito = '', string $id_struttura = ''): mixed`

### Utenti
- `cubeAuthenticator($opz)`
- `info_utente($campo, string $id_utente = ''): mixed`
- `info_tipologia_utente($id_tipologia): mixed`

### Menu e navigazione
- `getMenu(...) : array`
- `getMenuSecondario(...) : array`
- `getMenuSecondarioTerzoLivello(...) : array`
- `getMenuLanding(...) : mixed`
- `getBreadCrumb(...) : string`
- `paginaPadre(...) : array`
- `getIdMenu(...) : int`
- `getIdMenuVoci($id_pagina): mixed`
- `getInfoMenu(...) : mixed`
- `getLinkPadre(): string`
- `getLinkHome(...) : string`
- `getLinkHomeCS(...) : string`
- `getLinkPagina(...) : string`
- `getLinkAmministrazione(): string`

### Pagine e contenuti
- `getInfoPagina(...) : mixed`
- `getInfoPaginaMeta(...) : mixed`
- `getTitolo(...) : mixed`
- `getTitoloAnteprima(...) : mixed`
- `getSottotitolo(...) : mixed`
- `getTesto(...) : string|array`
- `getDescrizioneAnteprima(...) : mixed`
- `getVar(...) : mixed`
- `getPagineFigli(...) : array|bool`
- `getPagineModello(...) : array`
- `getModulo(...)`
- `getContenuto(...)`
- `getComposer(...) : string`
- `getIdModulo($modulo): mixed`
- `getModello($modello): mixed`
- `info_modello(...) : mixed`

### Immagini e media
- `getImgAnteprima(string $id_pagina = ''): string`
- `getLogo(...) : string`
- `getLogoP(...) : string`
- `getImgOfferta(...) : string`
- `getImg(...) : string`
- `getPicture(...) : string`
- `getPath(...) : string`

### Offerte
- `getLinkPaginaOfferte(...) : array|string`
- `getLinkOfferte(...) : string`
- `getLinkBooking(...) : string`
- `array_offerte(...) : mixed`

### Articoli
- `getIDCategoria(...) : bool`
- `getArticoliByIDCategoria(...) : array`
- `getArticoliStruttura(...) : array`
- `getArticoli(...) : array`

### Recensioni
- `getRecensioni(...) : array`

### Form
- `form_personalizzato(...) : string`
- `form_newsletter(...) : mixed|string`
- `form_contatti(...) : string`
- `form_experience() : string`
- `form_meeting(...) : string`
- `sender_form_prepare(...)`

### Club / Area riservata
- `club($id_tipologia)`
- `club_add($id_tipologia)`
- `form_club($id_tipologia): string`
- `form_club_accedi($id_tipologia): string`

### Cookie
- `fnBannerCookie()`
- `banner_cookie(...) : string`
- `banner_cookie_v1(...) : string`
- `banner_cookie_v2() : string`
- `banner_cookie_new_v3() : string`

### Analytics
- `googleAnalytics()`
- `tagManagerHead()`
- `tagManagerBody()`
- `getRichSnippet()`

### Mappe e QR
- `getMappa(...) : string`
- `qrA(...) : string`
- `qr(...) : string`

### Gallery e blocchi
- `get_gallery_content($galleryID): array`
- `getMeeting(): mixed`
- `getBlocco(...) : mixed`

### Utility
- `get_client_ip(): array|false|string`
- `get_page_url(): string`
- `trova_end_of_request_uri(): mixed|string`
- `randomKey($length): string`
- `checkJson(...) : bool|string`
- `genera_json()`
- `genera_rss()`
- `ajax_set(...)`
- `is_group(): bool`
- `isGruppo(): bool`
- `pop_up()`
- `apriBeServizi(...) : string`
- `link_group(): string`
- `link_to($struttura): string`
- `parametri($campo): mixed`
