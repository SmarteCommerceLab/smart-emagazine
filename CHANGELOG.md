# Changelog

## [1.1.1]
- Dichiara a Smart Builder Site il supporto Builder e Compose per Smart Site Home e Smart Site Blog.
- Mantiene Smart Site Builder come superficie per i soli widget Builder.
- Affida a SBS dati e rendering dei componenti, conservando nel tema la presentazione editoriale.

## [1.1.0]
- Ripristina la safe area del pannello amministrativo rispetto al menu e alla Admin Bar di WordPress.
- Allinea il wrapper alla spaziatura canonica del design system Smart su desktop e mobile.
- Impedisce la regressione verso margini negativi che annullano il padding nativo di WordPress.

## [1.0.99]
- Introduce l'hub amministrativo Smart eMagazine con Dashboard, Design, Menu, Integrazioni, Sistema e Assistenza.
- Uniforma la struttura concettuale delle impostazioni ad AI-HTML mantenendo invariati menu e template legacy del frontend.
- Collega gli strumenti nativi WordPress per Customizer, widget e posizioni menu.
- Applica alle pagine del tema il design system coerente con lo schema colori amministrativo scelto dall'utente.
- Riunisce diagnostica, aggiornamenti, dipendenze e report tecnico nelle rispettive sezioni.

## [1.0.98]
- Ripristina la registrazione completa delle sezioni Smart eMagazine nel Customizer.
- Carica gli hook del Customizer durante il bootstrap del tema senza dipendere dal valore prematuro di `is_customize_preview()`.
- Inizializza in modo esplicito il runtime SCF incorporato in Smart Bootstrap Manager quando necessario.

## [1.0.97]
- Centralizza firma, data di pubblicazione, immagine in evidenza, tag e biografia autore dei cinque layout articolo.
- Mantiene le varianti responsive tramite argomenti dei componenti condivisi.
- Corregge escaping, rel dei collegamenti esterni e testo accessibile delle icone nei metadati editoriali.
- Evita errori nei post senza tag.

## [1.0.96]
- Mostra gli avvisi delle integrazioni soltanto nelle schermate Aspetto pertinenti.
- Riunisce i plugin opzionali mancanti in un unico messaggio non invasivo.
- Carica CSS e JavaScript amministrativi soltanto nell'editor articoli e nelle pagine del tema.
- Mantiene Smart Bootstrap Manager come unica dipendenza tecnica del Customizer.

## [1.0.95]
- Centralizza la condivisione social di tutti i layout articolo in un componente accessibile.
- Corregge URL e attributi di condivisione per Facebook, X, WhatsApp e LinkedIn.
- Aggiunge ai profili utente ruolo redazionale e collegamenti social sanitizzati.
- Mostra il ruolo redazionale accanto alla firma dell'autore negli articoli.
- Usa il runtime Smart Customizer Framework incorporato in Smart Bootstrap Manager.
- Rimuove la dipendenza separata dal vecchio plugin Smart Customizer Frameworks.
- Riclassifica Smart Advertising come integrazione opzionale perché gli slot sono già protetti.
- Aggiunge Sistema, Assistenza, diagnostica e protezioni nonce alle metabox editoriali.
- Consolida header e footer duplicati nei template canonici del tema.

## [1.0.93]
- Mantiene compatibili gli aggiornamenti delle installazioni storiche con cartella tema contenente spazi.
- Normalizza le nuove installazioni nella cartella `smart-emagazine`.

## [1.0.92]
- Introduce gli aggiornamenti firmati tramite Smart Repository.
- Aggiunge pacchetti release verificati con checksum SHA-256.
- Aggiorna i metadati di compatibilita WordPress e PHP.

## [1.0.91]
- Versione sorgente precedente alla distribuzione GitHub.
