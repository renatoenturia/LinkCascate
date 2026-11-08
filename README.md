# LinkCascate

Aplicação web para criar uma **página pública de bio links** (links em cascata), com painel autenticado para perfil, avatar e ordenação dos links.

**Demo local (após o setup):** usuário `test@example.com` / senha `password` — bio em `/p/testuser`.

## Stack

- **PHP 8.4+** · **Laravel 13**
- **Tailwind CSS 4** · **daisyUI** · **Vite**
- **SQLite** (padrão) — migrations e testes com `RefreshDatabase`
- Autenticação session (login, registro, logout)
- **PHPUnit** — suíte de testes de feature e unit

## Funcionalidades

| Área | Destaques |
|------|-----------|
| **Bio pública** | `/p/{identificador}` — nome, bio, avatar e links ativos por posição |
| **Perfil** | Handler (`@identificador`), biografia, upload de avatar |
| **Links** | CRUD, ativar/desativar, reordenar (subir/descer), policies por dono |
| **UI** | Componentes Blade reutilizáveis (`card`, `form`, `input`, `button`, `alert`, ícones) |

## Arquitetura (resumo)

- Validação em **Form Requests**; mass assignment via `Model::unguard()` com dados sensíveis filtrados no request
- **LinkPolicy** + `authorizeResource` no `LinkController`
- **LinkReorderer** para troca de posições
- Regra customizada **HandlerFormat** (`@slug`) para identificador público

## Como rodar

```bash
composer install
cp .env.example .env   # se ainda não existir
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install && npm run build

php artisan serve
```

Acesse `http://127.0.0.1:8000`.

## Testes

```bash
php artisan test
```

## Licença

MIT — ver [LICENSE](LICENSE).
