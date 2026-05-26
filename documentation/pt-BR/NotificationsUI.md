# Notifications UI

Dropdown e modal visual de notificações para o header administrativo.

## Quando Usar

- Use Notifications UI quando o painel precisa exibir um preview de notificações sem assumir uma implementação de back-end.
- Mantenha a origem dos dados livre. O array pode vir de Laravel Notifications, tabela própria, API, broadcast ou qualquer camada do projeto.
- Use a versão do projeto como base visual estática. A demo mostra o comportamento Livewire completo.

## Como Funciona No Projeto

O header monta um array de exemplos e envia para o componente Blade:

```blade
<x-admin.notifications-ui.index :notifications="$adminNotifications" />
```

O componente renderiza:

- sino com contador de não lidas;
- dropdown compacto com as notificações recentes;
- modal nativo do DaisyUI para a lista completa;
- ações visuais para marcar como lida, marcar todas como lidas e excluir.

## Contrato De Dados

```php
[
    'title' => 'Pedido aprovado',
    'description' => 'O pedido mais recente foi aprovado e está pronto para separação.',
    'author' => 'Vendas',
    'label' => 'Pedido',
    'time' => '2 minutos atrás',
    'icon' => 'fa-solid fa-bag-shopping',
    'read' => false,
]
```

## Modal DaisyUI

A lista completa usa o modal do DaisyUI com `modal-toggle`:

```blade
<input type="checkbox" id="adminNotificationsModal" class="modal-toggle" />

<div class="modal" role="dialog">
    <div class="modal-box">...</div>

    <label for="adminNotificationsModal" class="modal-backdrop">Fechar</label>
</div>
```

Isso mantém abertura, fechamento, backdrop e animações sem adicionar `wire-elements/modal` ao projeto ou depender de JavaScript customizado.

## Integração Com Back-End

Troque o array estático do header por uma fonte real:

```php
$adminNotifications = auth()->user()
    ->notifications()
    ->latest()
    ->limit(30)
    ->get()
    ->map(fn ($notification) => [
        'title' => $notification->data['title'] ?? 'Notificação',
        'description' => $notification->data['description'] ?? '',
        'author' => $notification->data['author'] ?? 'Sistema',
        'label' => $notification->data['label'] ?? 'Notificação',
        'time' => $notification->created_at->diffForHumans(),
        'icon' => $notification->data['icon'] ?? 'fa-regular fa-bell',
        'read' => filled($notification->read_at),
    ]);
```

## Observações

- O projeto não instala `wire-elements/modal` para este módulo.
- Os botões de ação são hooks visuais. Conecte-os ao back-end quando definir a fonte real de notificações.
- O componente não cria migrations, eventos, filas nem classes de notificação.
