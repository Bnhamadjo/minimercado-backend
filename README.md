<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Minimercado Backend

## 🧾 Visão Geral
Este projeto é o backend de um sistema de gestão para minimercado, desenvolvido com Laravel. Ele oferece funcionalidades para controle de produtos, vendas, fornecedores, usuários e outras operações essenciais para o funcionamento de um pequeno mercado.

## ⚙️ Instalação

### Requisitos
- PHP >= 8.0
- Composer
- MySQL
- Node.js e npm (opcional, para compilação de assets)

### Passos
1. Clone o repositório:
   ```bash
   git clone https://github.com/Bnhamadjo/minimercado-backend.git
   cd minimercado-
   
### Instale as dependencias
1. composer install
2. Copie o arquivo .env.example para .env e configure:
    cp .env.example .env
3. Gere a chave da aplicação:
    php artisan key:generate
4. Configure o banco de dados no .env e rode as migrations:
    php artisan migrate
5. inicie o servidor
    php artisan serve

### 🔧 Configuração

Configure o .env com suas credenciais de banco de dados, email, e outras variáveis.
Use php artisan storage:link para criar o link simbólico para arquivos públicos.

### 📦 Funcionalidades

Cadastro e gestão de produtos
Controle de estoque com alerta de baixo nível
Cadastro de fornecedores
Registro de vendas
Geração de recibos
Autenticação de usuários
Suporte a moeda FCFA (XOF)

### 📡 Endpoints principais

GET /api/produtos — Lista todos os produtos
POST /api/produtos — Cadastra um novo produto
GET /api/fornecedores — Lista fornecedores
POST /api/vendas — Registra uma venda
GET /api/estoque/baixo — Lista produtos com estoque baixo

### 👤 Autor
Braima Nhamadjo
GitHub: @Bnhamadjo



## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
