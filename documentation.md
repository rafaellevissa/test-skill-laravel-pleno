# Test Skill Laravel Pleno

## Instalação

Com o projeto já em sua máquina, instale as dependências com o seguinte comando dentro do repositório.

```
composer install
```

Crie o .env com base no .env.example e altere as credências.

```
cp .env.example .env
```

Em seguida gere a chave da aplicação.

```
php artisan key:generate
```

E por fim rode as migrations em seu banco de dados.

```
php artisan migrate --seed
```

Agora basta rodar o server de desenvolvimento.

```
php artisan serve
```

## Documentação

A Documentação da api encontra-se no endpoint `/api/documentation`.