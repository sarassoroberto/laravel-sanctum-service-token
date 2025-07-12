# Laravel Sanctum Service Token

[![Latest Version on Packagist](https://img.shields.io/packagist/v/arpitech/laravel-sanctum-service-token.svg?style=flat-square)](https://packagist.org/packages/arpitech/laravel-sanctum-service-token)
[![Total Downloads](https://img.shields.io/packagist/dt/arpitech/laravel-sanctum-service-token.svg?style=flat-square)](https://packagist.org/packages/arpitech/laravel-sanctum-service-token)
[![License](https://img.shields.io/packagist/l/arpitech/laravel-sanctum-service-token.svg?style=flat-square)](https://packagist.org/packages/arpitech/laravel-sanctum-service-token)

Un pacchetto Laravel per la generazione e gestione di token di servizio utilizzando Laravel Sanctum. Questo pacchetto permette di creare token di accesso per servizi esterni o API, semplificando l'autenticazione tra servizi.

## Caratteristiche

- ✅ Generazione di token di servizio tramite comando Artisan
- ✅ Modello dedicato per account di servizio
- ✅ Middleware per autenticazione service-to-service
- ✅ Supporto per Laravel 9 e 10
- ✅ Integrazione completa con Laravel Sanctum
- ✅ Gestione sicura dei token di accesso

## Requisiti

- PHP 8.0 o superiore
- Laravel 9.0 o 10.0
- Laravel Sanctum 3.0

## Installazione

### 1. Installazione da Repository Git (Attuale)

**Nota**: Il pacchetto non è ancora pubblicato su Packagist, quindi devi installarlo direttamente dal repository Git.

Aggiungi al tuo `composer.json`:

```json
{
    "require": {
        "arpitech/laravel-sanctum-service-token": "dev-main"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/sarassoroberto/laravel-sanctum-service-token.git"
        }
    ]
}
```

Poi esegui:

```bash
composer install
```

### 2. Installazione Diretta (Alternativa)

Puoi anche installare direttamente con:

```bash
composer require arpitech/laravel-sanctum-service-token:dev-main --prefer-source
```

**Importante**: Devi prima aggiungere il repository al tuo `composer.json` come mostrato sopra.

### 3. Installazione via Packagist (Futuro)

Una volta pubblicato su Packagist, potrai installare semplicemente con:

```bash
composer require arpitech/laravel-sanctum-service-token
```

## Configurazione

### 1. Pubblica le Migrazioni

Pubblica le migrazioni del pacchetto:

```bash
php artisan vendor:publish --provider="Arpitech\SanctumServiceToken\Providers\SanctumServiceTokenServiceProvider" --tag="service-token-migrations"
```

### 2. Esegui le Migrazioni

Esegui le migrazioni per creare le tabelle necessarie:

```bash
php artisan migrate
```

### 3. Configura Laravel Sanctum

Assicurati che Laravel Sanctum sia configurato correttamente. Se non l'hai già fatto:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

## Utilizzo

### Generazione di Token di Servizio

Genera un nuovo token di servizio usando il comando Artisan:

```bash
php artisan service:generate-token "Nome del Servizio"
```

Esempio:

```bash
php artisan service:generate-token "API Gateway Service"
```

Il comando restituirà:

- L'ID dell'account di servizio creato
- Il token di accesso generato
- Le informazioni di configurazione

### Utilizzo del Middleware

Applica il middleware `service-account` alle tue rotte API:

```php
// In routes/api.php
Route::middleware(['service-account'])->group(function () {
    Route::get('/protected-endpoint', [ApiController::class, 'index']);
    Route::post('/data', [ApiController::class, 'store']);
});
```

### Utilizzo Programmatico

```php
use Arpitech\SanctumServiceToken\Services\TokenService;
use Arpitech\SanctumServiceToken\Models\ServiceAccount;

// Creare un nuovo account di servizio
$tokenService = new TokenService();
$result = $tokenService->createServiceToken('My API Service');

echo "Token: " . $result['token'];
echo "Service Account ID: " . $result['service_account']->id;

// Recuperare un account di servizio
$serviceAccount = ServiceAccount::where('name', 'My API Service')->first();
```

### Autenticazione nelle Richieste API

Per utilizzare il token nelle richieste HTTP:

```bash
curl -H "Authorization: Bearer YOUR_TOKEN_HERE" \
     -H "Accept: application/json" \
     https://your-api.com/api/protected-endpoint
```

## Aggiornamento del Pacchetto

**Nota**: Fino a quando il pacchetto non sarà pubblicato su Packagist, tutti gli aggiornamenti devono essere fatti dal repository Git.

### Aggiornamento da Repository Git

Per aggiornare il pacchetto all'ultima versione dalla branch main:

```bash
composer update arpitech/laravel-sanctum-service-token
```

### Aggiornamento con Controllo delle Dipendenze

Per un aggiornamento più sicuro che controlla le compatibilità:

```bash
composer update arpitech/laravel-sanctum-service-token --with-dependencies
```

### Aggiornamento Forzato

Se hai problemi con l'aggiornamento, puoi forzare il download della versione più recente:

```bash
composer update arpitech/laravel-sanctum-service-token --prefer-source
```

### Aggiornamento Standard (Dopo Pubblicazione su Packagist)

Una volta pubblicato su Packagist, potrai aggiornare semplicemente con:

```bash
composer update arpitech/laravel-sanctum-service-token
```

### Workflow di Aggiornamento Completo

1. **Backup del Database** (raccomandato):

   ```bash
   php artisan db:backup  # Se hai un comando di backup configurato
   ```

2. **Aggiorna il Pacchetto**:

   ```bash
   composer update arpitech/laravel-sanctum-service-token
   ```

3. **Pubblica le Nuove Migrazioni** (se presenti):

   ```bash
   php artisan vendor:publish --provider="Arpitech\SanctumServiceToken\Providers\SanctumServiceTokenServiceProvider" --tag="service-token-migrations" --force
   ```

4. **Esegui le Nuove Migrazioni**:

   ```bash
   php artisan migrate
   ```

5. **Pulisci la Cache**:

   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   ```

### Verifica della Versione Installata

Per verificare quale versione del pacchetto è attualmente installata:

```bash
composer show arpitech/laravel-sanctum-service-token
```

## Struttura del Database

Il pacchetto crea la tabella `service_accounts` con la seguente struttura:

```sql
- id (bigint, primary key)
- name (string, unique)
- description (text, nullable)
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

## Sicurezza

- I token generati utilizzano il sistema di hashing sicuro di Laravel Sanctum
- I token possono essere revocati tramite l'interfaccia standard di Sanctum
- Il middleware verifica automaticamente la validità dei token
- Gli account di servizio possono essere disabilitati impostando `is_active = false`

## Troubleshooting

### Errore "Class not found"

Se ricevi errori di classe non trovata dopo l'installazione:

```bash
composer dump-autoload
php artisan config:clear
```

### Problemi con le Migrazioni

Se le migrazioni non vengono eseguite:

```bash
php artisan migrate:status
php artisan migrate --force
```

### Token non Riconosciuto

Verifica che:

1. Il middleware sia applicato correttamente
2. L'header `Authorization: Bearer TOKEN` sia presente
3. L'account di servizio sia attivo (`is_active = true`)

## Contribuire

1. Fork del repository
2. Crea un branch per la tua feature (`git checkout -b feature/amazing-feature`)
3. Commit delle modifiche (`git commit -m 'Add amazing feature'`)
4. Push al branch (`git push origin feature/amazing-feature`)
5. Apri una Pull Request

## Changelog

Vedi il file [CHANGELOG.md](CHANGELOG.md) per i dettagli sui cambiamenti.

## Licenza

Questo pacchetto è open-source software rilasciato sotto la [Licenza MIT](LICENSE.md).

## Supporto

Per domande, bug reports o richieste di funzionalità:

- 🐛 [Issues GitHub](https://github.com/sarassoroberto/laravel-sanctum-service-token/issues)
- 📧 Email: [info@arpitech.com](mailto:info@arpitech.com)
- 📖 [Documentazione](https://github.com/sarassoroberto/laravel-sanctum-service-token/wiki)

## Autori

- **Roberto Sarasso** - *Sviluppo Iniziale* - [sarassoroberto](https://github.com/sarassoroberto)

## Riconoscimenti

- [Laravel Sanctum](https://laravel.com/docs/sanctum) per il sistema di autenticazione
- [Laravel](https://laravel.com) per il framework
- La community Laravel per l'ispirazione e il supporto
