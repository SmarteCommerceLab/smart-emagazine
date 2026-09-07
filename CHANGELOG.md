# Changelog

## [1.0.99]
- Allinea la struttura concettuale dei menu ad AI-HTML mantenendo i template PHP legacy.
- Aggiunge posizioni principali, utility, secondarie e quattro colonne footer senza rimuovere le posizioni editoriali esistenti.
- Introduce fallback affidabili tra posizioni equivalenti per evitare navigazioni vuote dopo il cambio tema.
- Migliora accessibilita dell'offcanvas con skip link, pulsanti semantici ed etichette localizzate.

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
