Create `.env` from `.env.dist`:
* set DATABASE_URL
* set JWT_PASSPHRASE with password used to generate jwt keys

Install dependencies:
* `composer install`

Run migrations:
* `php bin/console doctrine:migrations:migrate `

To generate jwt keys:
* `mkdir -p config/jwt`
* `openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096`
* `openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`



Setup test database:
* `mkdir var/data`
* `php bin/console doctrine:schema:create --env=test`


Create user:
* POST request on: `/register`
* with example body:
    `{
      	"username": "user",
      	"password": "user123",
      	"email": "user@user.com"
     }`
     
Get token:     
* POST request on: `/api/login_check`
* with example body:
    `{
     	"username": "user@user.com",
     	"password": "user123"
     }`
     
Create measurement record:
* POST request on: `/api/measurement`
* with header `Authorization: Bearer {token}`
* with example body:
    `{
         "subjectName": "test",
         "type": 5,
         "timestamp": "2020-01-01 00:00:00",
         "payload": "test"
     }`