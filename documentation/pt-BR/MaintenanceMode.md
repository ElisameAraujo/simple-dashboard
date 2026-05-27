# Maintenance Mode

Controle de manutenção para bloquear o site público sem derrubar o painel administrativo.

## Quando Usar

- Use Maintenance Mode quando precisa esconder o site de visitantes enquanto valida ajustes.
- Use como alternativa ao `php artisan down` quando administradores ainda precisam acessar o painel e navegar pelo site autenticados.
- Use o middleware nas rotas públicas reais do projeto. Esta versão não cria uma página web de exemplo.

## Como Acessar

A tela administrativa fica em:

```text
/admin/configs/maintenance
```

Ela também pode ser acessada pelo menu lateral em **Configurações > Manutenção**.

## Como Funciona

O estado fica salvo na tabela `maintenance_settings`.

Quando o modo de manutenção está ativo:

- visitantes anônimos recebem a página `503`;
- usuários autenticados continuam acessando as rotas protegidas pelo middleware;
- o painel administrativo continua disponível;
- a mensagem configurada é exibida na página de manutenção;
- o atalho do header pode ser ativado ou ocultado pela própria tela de configuração.

## Middleware

O alias registrado é:

```php
'site.available' => \App\Http\Middleware\EnsureSiteIsAvailable::class,
```

Para proteger suas rotas públicas, aplique o middleware no grupo web do seu projeto:

```php
use Illuminate\Support\Facades\Route;

Route::middleware('site.available')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blog/{post}', [PostController::class, 'show'])->name('blog.show');
    Route::get('/produtos/{product}', [ProductController::class, 'show'])->name('products.show');
});
```

Rotas administrativas não precisam desse middleware.

## Configurações

| Campo | Função |
| --- | --- |
| Status atual | Mostra se o site está online ou em manutenção. |
| Ativar/Desativar Manutenção | Alterna o bloqueio público com modal DaisyUI de confirmação. |
| Mensagem de Manutenção | Define o texto exibido na página `503`. |
| Atalho no Cabeçalho | Mostra ou oculta o botão rápido no header e no menu mobile. |
| Alerta de Site Online | Exibe um aviso temporário quando a manutenção é desativada. |
| Duração do alerta | Define por quantos segundos o aviso de site online aparece. Use `0` para manter sempre visível. |

## Página 503

A view usada é:

```text
resources/views/errors/503.blade.php
```

Ela lê a mensagem atual de manutenção e usa o layout mínimo:

```text
resources/views/errors/minimal.blade.php
```

## Observações

- O modal de confirmação usa DaisyUI porque é um fluxo simples de sim/não.
- O módulo depende apenas de Laravel, Eloquent, Livewire e DaisyUI já presentes no painel.
- O `projeto` entrega o core pronto, mas deixa a decisão de quais rotas públicas serão protegidas para cada aplicação.
