# Test di Installazione del Pacchetto

Questo file contiene i passi per testare se il pacchetto è installato correttamente.

## 1. Verifica della Struttura del Pacchetto

✅ **composer.json** - Presente e valido
✅ **src/Providers/SanctumServiceTokenServiceProvider.php** - ServiceProvider configurato
✅ **database/migrations/** - Migrazioni presenti
✅ **src/Console/** - Comandi Artisan
✅ **src/Models/** - Modelli
✅ **src/Services/** - Servizi

## 2. Comandi per Testare l'Installazione

### In un progetto Laravel esistente:

1. **Aggiungi il repository al composer.json**:
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/sarassoroberto/laravel-sanctum-service-token.git"
        }
    ]
}
```

2. **Installa il pacchetto**:
```bash
composer require arpitech/laravel-sanctum-service-token:dev-main
```

3. **Verifica che il ServiceProvider sia registrato**:
```bash
php artisan package:discover
```

4. **Controlla se il comando è disponibile**:
```bash
php artisan service:generate-token --help
```

5. **Pubblica le migrazioni**:
```bash
php artisan vendor:publish --provider="Arpitech\SanctumServiceToken\Providers\SanctumServiceTokenServiceProvider" --tag="service-token-migrations"
```

6. **Verifica che le migrazioni siano state pubblicate**:
```bash
ls database/migrations/*service_accounts*
```

7. **Esegui le migrazioni**:
```bash
php artisan migrate
```

8. **Verifica che la tabella sia stata creata**:
```bash
php artisan migrate:status | grep service_accounts
```

## 3. Test del Funzionamento

### Genera un token di test:
```bash
php artisan service:generate-token "Test Service"
```

### Verifica nel database:
```sql
SELECT * FROM service_accounts WHERE name = 'Test Service';
SELECT * FROM personal_access_tokens WHERE tokenable_type = 'Arpitech\SanctumServiceToken\Models\ServiceAccount';
```

## 4. Troubleshooting Comuni

### Errore: "Provider not found"
- Esegui: `composer dump-autoload`
- Esegui: `php artisan config:clear`

### Errore: "Migration not found"
- Verifica che il tag sia corretto: `--tag="service-token-migrations"`
- Controlla il percorso nel ServiceProvider

### Errore: "Command not found"
- Verifica che il ServiceProvider registri il comando
- Esegui: `php artisan list | grep service`

### Errore: "Class not found"
- Verifica l'autoload in composer.json
- Esegui: `composer dump-autoload`

## 5. Verifica dei File Chiave

Controlla che questi file esistano e siano accessibili:

- `vendor/arpitech/laravel-sanctum-service-token/src/Providers/SanctumServiceTokenServiceProvider.php`
- `vendor/arpitech/laravel-sanctum-service-token/src/Console/GenerateServiceTokenCommand.php`
- `vendor/arpitech/laravel-sanctum-service-token/src/Models/ServiceAccount.php`
- `vendor/arpitech/laravel-sanctum-service-token/database/migrations/2023_01_01_000000_create_service_accounts_table.php`

## 6. Test Completo in un Nuovo Progetto Laravel

```bash
# Crea un nuovo progetto Laravel
composer create-project laravel/laravel test-service-token
cd test-service-token

# Aggiungi il repository
# (Modifica composer.json come mostrato sopra)

# Installa il pacchetto
composer require arpitech/laravel-sanctum-service-token:dev-main

# Installa Sanctum se non presente
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Configura il database
# (Modifica .env con le tue credenziali DB)

# Esegui le migrazioni base
php artisan migrate

# Pubblica e esegui le migrazioni del pacchetto
php artisan vendor:publish --provider="Arpitech\SanctumServiceToken\Providers\SanctumServiceTokenServiceProvider" --tag="service-token-migrations"
php artisan migrate

# Testa il comando
php artisan service:generate-token "Test Installation"
```
