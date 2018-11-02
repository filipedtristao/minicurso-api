1. Iniciar um novo projeto Laravel
```
composer create-project --prefer-dist laravel/laravel minicurso-api
```
2. Colocar o .htaccess apropriado
3. Renomear para apenas .htaccess
4. Configurar o .env com o ambiente da máquina
5. Mover o model de usuário para Models/
6. Deletar a pasta Auth em Http/Controllers
6. Remover rotas e arquivos inutilizados no RouteProvider
7. Declarar arquivo de rotas customizado
8. No arquivo customizado declarar rota index, com a versão da API
9. Limpar a pasta resource
10. Baixar pasta database no github e substituir pela do seu projeto
11. Importar banco e registros
```
php artisan db:migrate
php artisan db:seed
```
12. Adicionar a dependencia "tymon/jwt-auth": "1.0.*" no require do composer.json e rodar o comando:
```
composer update tymon/jwt-auth
```
13. Publicar os arquivos de configuração do plugin
```
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
14. Rodar o comando para gerar o secret do JWT
```
php artisan jwt:secret
```
14. Colocar driver jwt como default nas configurações em auth.php
15. Implementar a interface JWTSubject no Model de usuário, juntamente com os métodos getJWTIdentifier e getJWTCustomClaims
```php
<?php
class User extends Authenticatable implements JWTSubject {
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey(); // Eloquent Model method
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
```
15. Criar o controller para Login
```
php artisan make:controller LoginController
```
16. Criar a rota para login
15. Criar o controller para Books
```
php artisan make:controller BookController
```
16. Criar as rotas para Books


A partir desse passo a API está configurada e pronta para ser utilizada.
