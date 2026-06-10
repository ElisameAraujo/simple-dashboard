# Simple Dashboard

Simple Dashboard é uma base pronta de painel administrativo em Laravel. Ele entrega uma estrutura limpa de dashboard, helpers reutilizáveis e módulos opcionais que podem ser adaptados em projetos reais.

Se você quer ver os recursos funcionando com dados fake e exemplos visuais, use o repositório separado da demo: [simple-dashboard-demo](https://github.com/ElisameAraujo/simple-dashboard-demo).

## Stack

- Laravel 13
- Livewire 4
- Tailwind CSS 4
- DaisyUI 5
- FontAwesome 7
- Vite 8
- Setup local pronto para SQLite

## Instalação

Clone o repositório base:

```bash
git clone https://github.com/ElisameAraujo/simple-dashboard.git
cd simple-dashboard
```

Instale as dependências PHP e JavaScript:

```bash
composer install
npm install
```

Crie o arquivo de ambiente, gere a chave da aplicação e rode as migrations:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
```

Gere os assets:

```bash
npm run build
```

Inicie o ambiente local:

```bash
composer run dev
```

Depois acesse:

```text
http://127.0.0.1:8000/admin
```

## O Que Está Incluído

### Helpers

Os helpers ficam em `app/Helpers` e são registrados em `config/helpers.php`.

| Helper | Foco |
| --- | --- |
| `DateHelper` | Datas, períodos e textos relativos. |
| `DiskHelper` | Upload, troca, remoção e geração de URL para disks Laravel. |
| `HTMLHelper` | Geração de HTML fake para factories, previews e documentação. |
| `MediaHelper` | Resolução, exibição, download e MIME type de mídias. |
| `NotificationHelper` | Leitura de notificações Laravel do usuário autenticado. |
| `NumberHelper` | Formatação de números, moedas, áreas e ordinais por locale. |
| `PaginationHelper` | Helpers para arrays de paginação. |
| `RouteHelper` | Importação organizada de arquivos e pastas de rotas. |
| `RuleHelper` | Extração de valores de regras de validação Laravel. |
| `TextHelper` | Limpeza, normalização, pluralização, slugs e textos de UI. |
| `UserHelper` | Acesso seguro a dados básicos do usuário e extras de permissões. |

### Módulos

Os módulos são blocos reutilizáveis. Esta base não inclui páginas demonstrativas para eles; consulte a pasta de documentação para ver detalhes de implementação.

| Módulo | Finalidade |
| --- | --- |
| `ImagePreview` | Preview de imagem em formulários Livewire de create e edit. |
| `Visits` | Registro standalone de visitas Eloquent e escopos de popularidade. |
| `Notifications UI` | Componentes visuais de notificações prontos para conectar ao backend. |
| `Maintenance Mode` | Modo de manutenção no estilo WordPress mantendo o painel admin disponível. |
| `Search Engine` | Busca configurável para Spotlight admin, pesquisa web, models Eloquent, itens estáticos e tabelas Livewire. |
| `Rich Text Media` | Upload, commit, sync, limpeza e remoção de imagens embutidas em editores WYSIWYG. |

## Documentação

A documentação está disponível em:

```text
documentation/en
documentation/pt-BR
```

Docs úteis dos módulos:

| Tópico | Inglês | Português |
| --- | --- | --- |
| ImagePreview | `documentation/en/ImagePreview.md` | `documentation/pt-BR/ImagePreview.md` |
| Visits | `documentation/en/Visits.md` | `documentation/pt-BR/Visits.md` |
| Notifications UI | `documentation/en/NotificationsUI.md` | `documentation/pt-BR/NotificationsUI.md` |
| Maintenance Mode | `documentation/en/MaintenanceMode.md` | `documentation/pt-BR/MaintenanceMode.md` |
| Search Engine | `documentation/en/SearchEngine.md` | `documentation/pt-BR/SearchEngine.md` |
| Rich Text Media | `documentation/en/RichTextMedia.md` | `documentation/pt-BR/RichTextMedia.md` |

## Validação

Rode a suite completa de testes:

```bash
php artisan test
```

Gere os assets:

```bash
npm run build
```

Rode testes focados ao alterar um módulo específico:

```bash
php artisan test tests/Feature/Search
php artisan test tests/Feature/Visits
php artisan test tests/Feature/Media
php artisan test --filter=MaintenanceModeTest
```

## Observações

- O projeto é fornecido como base inicial. Adapte rotas, autorização, models e detalhes de UI conforme sua aplicação.
- Modais simples de confirmação usam DaisyUI.
- Fluxos com Livewire devem ficar em componentes Livewire quando precisam de validação ou controle de estado.
- O repositório da demo contém exemplos visuais; este repositório mantém a implementação reutilizável limpa.
