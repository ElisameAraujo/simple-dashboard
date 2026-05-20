# PaginationHelper

O **PaginationHelper** constrói uma lista compacta de números de páginas para views de paginação customizadas.

Ele é útil quando você quer renderizar as primeiras páginas, as últimas páginas e as páginas próximas da página atual sem calcular esses intervalos manualmente dentro do Blade.

---

# Funções disponíveis

## `build($paginator, $eachSide = null): array`

Retorna um array ordenado com os números de páginas que devem ser exibidos.

O helper inclui:

- as primeiras páginas;
- as últimas páginas;
- as páginas ao redor da página atual.

Se `$eachSide` não for informado, o helper usa o próprio valor `onEachSide` do paginador.

### Exemplo

```php
$pages = PaginationHelper::build($posts);
```

### Exemplo com intervalo customizado

```php
$pages = PaginationHelper::build($posts, 2);
```

### Saída possível

```php
[
    1,
    2,
    8,
    9,
    10,
    18,
    19,
]
```

---

# Uso no Blade

```blade
@foreach (PaginationHelper::build($posts, 2) as $page)
    <a href="{{ $posts->url($page) }}">
        {{ $page }}
    </a>
@endforeach
```

---

# Observações

- O objeto `$paginator` precisa fornecer `currentPage()` e `lastPage()`.
- O helper apenas monta a lista de páginas. Ele não renderiza HTML.
- Use os métodos nativos do paginador do Laravel, como `url($page)`, para gerar os links finais.

