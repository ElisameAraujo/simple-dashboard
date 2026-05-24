# UserHelper

Fornece atalhos defensivos para dados do usuário autenticado, avatar, e-mail, resumos e integração opcional com Spatie Permission.

## Quando Usar

- Use UserHelper em views, headers, menus e componentes administrativos que precisam de dados simples do usuário autenticado sem repetir verificações de Auth.
- info() busca apenas atributos diretos do model User. Ele não carrega relações e retorna o fallback quando o usuário ou a coluna não existem.
- userIsActive() é configurável para projetos que usam booleanos, strings de status ou identificadores numéricos para representar usuários ativos.
- Os métodos de Spatie são opcionais. Eles retornam valores seguros quando o pacote está instalado, mas o model User ainda não implementa HasRoles.

## Exemplo

```php
UserHelper::userShortSummary();
```

**Saída**

```
Maria S. — maria@example.com
```

## Métodos

### `userLogged`

Verifica se existe um usuário autenticado.

**Exemplo**

```php
UserHelper::userLogged();
```

**Saída**

```
true
```

### `info`

Retorna um atributo direto do usuário autenticado ou um fallback quando o atributo não existe.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Nome da coluna ou atributo direto do model User. |
| `default` | Valor retornado quando não há usuário autenticado ou quando o atributo não existe. |

**Exemplo**

```php
UserHelper::info('name', 'Visitante');
```

**Saída**

```
Maria da Silva
```

### `userIsActive`

Verifica se um atributo do usuário corresponde ao valor configurado como ativo.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo que representa o status do usuário. |
| `activeValue` | Valor considerado ativo no projeto, como true, active ou 1. |

**Exemplo**

```php
UserHelper::userIsActive('status', 'active');
```

**Saída**

```
true
```

### `userId`

Retorna o identificador do usuário autenticado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo usado como identificador. |

**Exemplo**

```php
UserHelper::userId();
```

**Saída**

```
1
```

### `username`

Retorna o nome do usuário autenticado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo usado como nome. |

**Exemplo**

```php
UserHelper::username();
```

**Saída**

```
Maria da Silva
```

### `userFirstName`

Retorna o primeiro nome do usuário autenticado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo usado como nome. |

**Exemplo**

```php
UserHelper::userFirstName();
```

**Saída**

```
Maria
```

### `userShortName`

Retorna o primeiro nome com a inicial do último sobrenome.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo usado como nome. |

**Exemplo**

```php
UserHelper::userShortName();
```

**Saída**

```
Maria S.
```

### `userEmail`

Retorna o e-mail do usuário autenticado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo usado como e-mail. |

**Exemplo**

```php
UserHelper::userEmail();
```

**Saída**

```
maria@example.com
```

### `emailDomain`

Retorna o domínio do e-mail do usuário autenticado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo usado como e-mail. |

**Exemplo**

```php
UserHelper::emailDomain();
```

**Saída**

```
example.com
```

### `maskEmail`

Mascara a parte local de um e-mail para exibição segura.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `email` | E-mail que será mascarado. |
| `charactersToMask` | Quantidade de caracteres mascarados. Quando null ou menor que 1, mascara toda a parte antes do @. |
| `position` | Posição da máscara. Aceita start, middle ou end. |

**Exemplo**

```php
UserHelper::maskEmail('maria.silva@example.com', 5, 'middle');
```

**Saída**

```
maria*****a@example.com
```

### `sanitizeEmail`

Remove caracteres inválidos do e-mail e converte o resultado para minúsculas.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `email` | E-mail que será sanitizado. |

**Exemplo**

```php
UserHelper::sanitizeEmail(' MARIA@example.com ');
```

**Saída**

```
maria@example.com
```

### `userAvatar`

Retorna a URL pública do avatar do usuário quando o atributo existe, ou um placeholder quando informado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo que armazena o caminho do avatar. |
| `disk` | Disco configurado em filesystems.php. |
| `placeholder` | Caminho público usado quando o avatar não existe. |

**Exemplo**

```php
UserHelper::userAvatar('avatar', 'public', 'img/placeholders/avatars/default-avatar.jpg');
```

**Saída**

```
/storage/avatars/user.jpg
```

### `userAvatarPath`

Retorna o caminho salvo do avatar do usuário sem resolver a URL pública.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo que armazena o caminho do avatar. |

**Exemplo**

```php
UserHelper::userAvatarPath();
```

**Saída**

```
avatars/user.jpg
```

### `userAvatarFallback`

Retorna iniciais e uma cor estável para exibir um avatar textual quando não há imagem.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `column` | Atributo usado como nome para gerar as iniciais. |

**Exemplo**

```php
UserHelper::userAvatarFallback();
```

**Saída**

```
['initials' => 'MS', 'color' => '#3498db']
```

### `userSummary`

Retorna um array simples com id, nome e e-mail do usuário autenticado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `id` | Atributo usado como identificador. |
| `name` | Atributo usado como nome. |
| `email` | Atributo usado como e-mail. |

**Exemplo**

```php
UserHelper::userSummary();
```

**Saída**

```
['id' => 1, 'name' => 'Maria da Silva', 'email' => 'maria@example.com']
```

### `userShortSummary`

Retorna um resumo curto com nome abreviado e e-mail do usuário autenticado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `name` | Atributo usado como nome. |
| `email` | Atributo usado como e-mail. |

**Exemplo**

```php
UserHelper::userShortSummary();
```

**Saída**

```
Maria S. — maria@example.com
```

### `userHasRole`

Verifica se o usuário autenticado possui uma role quando HasRoles está implementado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `role` | Nome da role que será verificada. |

**Exemplo**

```php
UserHelper::userHasRole('admin');
```

**Saída**

```
true
```

### `userHasPermission`

Verifica se o usuário autenticado possui uma permissão.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `permission` | Nome da permissão que será verificada. |

**Exemplo**

```php
UserHelper::userHasPermission('posts.edit');
```

**Saída**

```
true
```

### `userRoles`

Retorna os nomes das roles do usuário quando HasRoles está implementado.

**Exemplo**

```php
UserHelper::userRoles();
```

**Saída**

```
['admin', 'editor']
```

### `userPermissions`

Retorna os nomes de todas as permissões do usuário quando HasRoles está implementado.

**Exemplo**

```php
UserHelper::userPermissions();
```

**Saída**

```
['posts.create', 'posts.edit']
```

### `allPermissions`

Retorna todos os nomes de permissões cadastrados pelo Spatie Permission.

**Exemplo**

```php
UserHelper::allPermissions();
```

**Saída**

```
collect(['posts.create', 'posts.edit'])
```

### `allRoles`

Retorna todos os nomes de roles cadastrados pelo Spatie Permission.

**Exemplo**

```php
UserHelper::allRoles();
```

**Saída**

```
collect(['admin', 'editor'])
```
