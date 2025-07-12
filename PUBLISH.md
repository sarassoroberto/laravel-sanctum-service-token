# Guida alla Pubblicazione su Packagist

Questa guida ti aiuterà a pubblicare il pacchetto `arpitech/laravel-sanctum-service-token` su Packagist.

## Prerequisiti

1. ✅ Repository GitHub pubblico configurato
2. ✅ Codice funzionante e testato
3. ✅ `composer.json` configurato correttamente
4. ✅ README.md completo
5. ⏳ Account Packagist (da creare)
6. ⏳ Tag di versione (da creare)

## Step 1: Verifica del composer.json

Assicurati che il `composer.json` sia configurato correttamente:

```bash
composer validate
```

## Step 2: Crea un Tag di Versione

Prima di pubblicare su Packagist, crea un tag per la prima versione:

```bash
# Tag per la versione 1.0.0
git tag -a v1.0.0 -m "Prima release stabile"
git push origin v1.0.0
```

## Step 3: Account Packagist

1. Vai su [https://packagist.org](https://packagist.org)
2. Registrati o accedi con il tuo account GitHub
3. Collega il tuo account GitHub a Packagist

## Step 4: Submissione del Pacchetto

1. Vai su Packagist e clicca "Submit"
2. Inserisci l'URL del tuo repository GitHub:
   ```
   https://github.com/sarassoroberto/laravel-sanctum-service-token
   ```
3. Clicca "Check" e poi "Submit"

## Step 5: Configurazione Auto-Update

Per aggiornare automaticamente Packagist quando fai push:

1. Vai alle impostazioni del repository su GitHub
2. Vai in "Webhooks" → "Add webhook"
3. Inserisci l'URL del webhook di Packagist:
   ```
   https://packagist.org/api/github?username=YOUR_PACKAGIST_USERNAME
   ```
4. Seleziona "application/json" come content type
5. Seleziona "Just the push event"

## Step 6: Verifica

Dopo la pubblicazione:

1. Verifica che il pacchetto sia visibile su Packagist
2. Testa l'installazione in un progetto di prova:
   ```bash
   composer require arpitech/laravel-sanctum-service-token
   ```

## Step 7: Aggiorna README

Una volta pubblicato, aggiorna il README.md per rimuovere le note sui repository Git e usare i comandi standard di Composer.

## Versioning

Usa il [Semantic Versioning](https://semver.org/):

- **MAJOR** (1.0.0): Cambiamenti incompatibili con versioni precedenti
- **MINOR** (1.1.0): Nuove funzionalità backward-compatible
- **PATCH** (1.0.1): Bug fixes backward-compatible

## Esempi di Tag

```bash
# Bug fix
git tag -a v1.0.1 -m "Fix: Risolto problema con middleware"
git push origin v1.0.1

# Nuova feature
git tag -a v1.1.0 -m "Feature: Aggiunto supporto per token con scadenza"
git push origin v1.1.0

# Breaking change
git tag -a v2.0.0 -m "Breaking: Cambiata struttura API del TokenService"
git push origin v2.0.0
```

## Note

- Packagist sincronizzerà automaticamente le nuove versioni tramite GitHub webhook
- I badge nel README si aggiorneranno automaticamente una volta pubblicato
- Considera l'aggiunta di test automatici con GitHub Actions prima della pubblicazione
