# NotificationHelper

Consulta e conta notificações do usuário autenticado para dropdowns, badges e telas de leitura.

## Quando Usar

- Use NotificationHelper quando uma view, componente Livewire ou controller precisa buscar notificações do usuário logado sem repetir verificações de Auth.
- O helper é focado em leitura. Ações como marcar como lida, marcar todas como lidas ou excluir notificações devem ficar no Controller ou no componente Livewire que controla a interação.
- latestNotifications() alimenta resumos curtos, como o dropdown do header; allUnreadNotifications() alimenta listas completas de pendências que não cabem no resumo.
- Quando não existe usuário autenticado, os métodos de lista retornam uma Collection vazia e os métodos de contagem retornam 0.

## Exemplo

```php
$unreadCount = NotificationHelper::allUnreadNotificationsCount();
$dropdownNotifications = NotificationHelper::latestNotifications(10);
```

**Saída**

```
15 notificações não lidas e 10 itens para o dropdown.
```

## Métodos

### `unreadNotificationsByType`

Lista notificações não lidas de uma classe específica de notificação.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `type` | Nome da classe de notificação ou classe completa com namespace. |
| `subfolder` | Subpasta opcional dentro de App\Notifications, como User. |
| `limit` | Limite opcional de registros retornados. Quando null ou menor que 1, retorna todos os registros encontrados. |

**Exemplo**

```php
NotificationHelper::unreadNotificationsByType('NewMessageNotification', 'User', 5);
```

**Saída**

```
Collection com até 5 notificações não lidas do tipo App\Notifications\User\NewMessageNotification.
```

### `unreadNotificationsByTypeCount`

Conta notificações não lidas de uma classe específica de notificação.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `type` | Nome da classe de notificação ou classe completa com namespace. |
| `subfolder` | Subpasta opcional dentro de App\Notifications, como User. |

**Exemplo**

```php
NotificationHelper::unreadNotificationsByTypeCount('NewMessageNotification', 'User');
```

**Saída**

```
3
```

### `allUnreadNotifications`

Lista todas as notificações não lidas do usuário autenticado, com limite opcional.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `limit` | Limite opcional de registros retornados. Quando null, retorna todas as notificações não lidas. |

**Exemplo**

```php
NotificationHelper::allUnreadNotifications();
```

**Saída**

```
Collection com todas as notificações não lidas.
```

### `allUnreadNotificationsCount`

Conta todas as notificações não lidas do usuário autenticado.

**Exemplo**

```php
NotificationHelper::allUnreadNotificationsCount();
```

**Saída**

```
15
```

### `latestNotifications`

Lista as notificações mais recentes do usuário autenticado, lidas ou não lidas, para resumos como dropdowns.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `limit` | Quantidade máxima de notificações retornadas. Quando null ou menor que 1, retorna todas. |

**Exemplo**

```php
NotificationHelper::latestNotifications(10);
```

**Saída**

```
Collection com as 10 notificações mais recentes.
```
