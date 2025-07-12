# Pacchetto per Generazione Token di Servizio Sanctum

## Installazione
```bash
composer require arpitech/laravel-sanctum-service-token
```

## Configurazione
1. Pubblica le migrazioni:
```bash
php artisan vendor:publish --provider="Arpitech\\SanctumServiceToken\\Providers\\SanctumServiceTokenServiceProvider" --tag="service-token-migrations"
```

2. Esegui le migrazioni:
```bash
php artisan migrate
```

## Utilizzo
Genera un token:
```bash
php artisan service:generate-token "Nome Progetto"
```
