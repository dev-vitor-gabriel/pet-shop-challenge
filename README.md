# Configuração Teste Prático Desenvolvedor Back-end


## Configurações iniciais
1. Para os testes o primeiro passo deverá ser rodar o comando `composer install`

2. O segundo passo será subir o docker `docker compose up`.

3. O terceiro passo será um comando para conectar no docker via terminal após o mesmo estiver rodando `docker exec -it pet-shop-challenge-laravel.test-1 bash`, os próximos passos precisarão ser feitos dentro deste terminal.

4. O quarto passo irá servir para criar as tables `php artisan migrate`

5. O quinto e ultimo passo irá servir para criar a key jwt `php artisan jwt:secret`
#
# Controllers
## AuthController
* Responsável pelos métodos de `login` dos usuários

## PetController
* Responsável pelos métodos de `crud` dos pets

## AtendimentoController
* Responsável pelos métodos de `crud` dos atendimentos

# Tables
*  Segue um link para verificar como está a UML do banco.
`https://dbdiagram.io/d/pet-shop-challenge-650e1d50ffbf5169f0563c21`

# Models

## Atendimento
## Pet
## User
# Rotas relacionadas ao usuário
* POST /api/auth/register  `Rota de cadastro de usuário`
`Nessa rota, definimos a coluna is_admin, caso o usuário seja admin ele terá pleno acesso ao sistema, e caso não, ele só poderá consultar e alterar os dados que ele mesmo tiver cadastrado`

```
{
	"name": "Digite aqui o nome do usuário",
	"email": "Digite aqui o email do usuário",
    "password": "Digite aqui sua senha",
    "is_admin": "Defina como true ou false(Caso não seja preenchido será como padrão false)"
}

```
* POST /api/auth/login  `Rota de login de um usuário(Aqui será definido seu token e permissões)`

```
{
	"email": "Digite aqui o seu email cadastrado",
	"password": "Digite aqui a sua senha de cadastro"
}

```
* POST /api/auth/refresh `Rota em que podemos realizar o refresh do token`

* POST /api/auth/logout  `Rota em que podemos realizar o logout do sistema`

# Rotas relacionadas ao pet
* POST /api/pet/  `Rota de cadastro de pet`

```
{
	"des_pet_tbp":"Digite aqui o nome do seu Pet"
}

```
* GET /api/pet/{id_pet} `Rota que retorna todos os pets cadastrados, ou caso queira um específico, passe o id_pet na rota`

* PUT /api/pet/{id_pet}  `Rota em que podemos atualizar o nome do pet de acordo com o id_pet`
```
{
	"des_pet_tbp":"Digite aqui o nome do seu Pet"
}

```
* DELETE /api/pet/{id_pet} `Rota em que deletamos o pet por seu id_pet`
# Rotas relacionadas ao atendimento
* POST /api/atendimento/  `Rota de cadastro de pet`

```
{
	"id_pet_tba": "Digite aqui o id do seu pet",
	"dta_atendimento_tba":"Digite aqui a data do seu atendimento"
}

```
* GET /api/atendimento/{id_atendimento} `Rota que retorna todos os atendimentos cadastrados, ou caso queira um específico, passe o id_atendimento na rota`

* PUT /api/atendimento/{id_atendimento}  `Rota em que podemos atualizar o id do pet relacionado ao atendimento com o id_atendimento`

```
{
	"id_pet_tba": "Digite aqui o id do seu pet",
}

```

* DELETE /api/atendimento/{id_atendimento} `Rota em que deletamos o atendimento por seu id_atendimento`
# Teste feito utilizando Laravel 10,React e Mysql 








