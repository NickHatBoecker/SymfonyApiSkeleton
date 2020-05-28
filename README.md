# Symfony REST API Skeleton

## Installation

Clone this repository and execute `composer install`.

### Create JWT Key Files

```
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

Put the password you chose for the key files in your `.env.local` under `JWT_PASSPHRASE`.

### Execute migrations

```$ php bin/console doctrine:migrations:migrate```
