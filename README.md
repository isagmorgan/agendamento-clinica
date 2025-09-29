# Projeto de Agendamento

Este é um sistema de agendamento desenvolvido em **Laravel**, utilizando **Laravel Sail** para gerenciamento do ambiente com Docker e **Laravel Passport** para autenticação via OAuth2.

---

## ℹ️ Sobre o projeto

Este foi meu **primeiro projeto** utilizando estas tecnologias.
O desenvolvimento foi feito com base em **vídeos tutoriais** e com o apoio de **Inteligência Artificial**, o que me ajudou a superar as principais barreiras.

Durante o processo enfrentei algumas **dificuldades com instalações e configurações** (especialmente envolvendo Docker, Sail e Passport).

Este projeto marca o início do meu aprendizado com Laravel e seu ecossistema, e estou em constante busca por **aprimorar minhas habilidades e compreender melhor cada etapa** do desenvolvimento.

---

## 🚀 Tecnologias utilizadas

* [Laravel 9+](https://laravel.com/)
* [Laravel Sail](https://laravel.com/docs/9.x/sail)
* [Laravel Passport](https://laravel.com/docs/9.x/passport)
* Docker / Docker Compose
* MySQL

---

## 📦 Pré-requisitos

Antes de começar, você precisa ter instalado em sua máquina:

* [Docker](https://docs.docker.com/get-docker/)
* [Docker Compose](https://docs.docker.com/compose/)
* [Git](https://git-scm.com/)

---

## 🔧 Instalação e execução

Clone este repositório:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

Instale as dependências do Laravel:

```bash
./vendor/bin/sail composer install
```

Copie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
./vendor/bin/sail artisan key:generate
```

Suba os containers do Docker:

```bash
./vendor/bin/sail up -d
```

Execute as migrações e seeders:

```bash
./vendor/bin/sail artisan migrate --seed
```

Instale e configure o Passport:

```bash
./vendor/bin/sail artisan passport:install
```

---

## 🛠️ Comandos úteis

Rodar o projeto em modo desenvolvimento:

```bash
./vendor/bin/sail up
```

Rodar o projeto em background:

```bash
./vendor/bin/sail up -d
```

Parar os containers:

```bash
./vendor/bin/sail down
```

Acessar o container do Laravel:

```bash
./vendor/bin/sail bash
```

---

## 🔑 Autenticação com Passport

O projeto utiliza o **Laravel Passport** para autenticação OAuth2.
Após rodar `passport:install`, serão gerados os clientes de acesso. Guarde as chaves `client_id` e `client_secret` para consumir a API.

---

## 🌐 Acesso ao projeto

Depois que o Sail estiver rodando, você pode acessar o projeto em:

```
http://localhost
```

