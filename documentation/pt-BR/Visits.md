# Visits

Registro standalone de visitas com Eloquent para qualquer model que precise de métricas de popularidade.

## Quando Usar

- Use Visits quando um model precisa de métricas de visualização sem depender de pacote externo.
- Use em posts, produtos, páginas, banners ou qualquer model que deve ser ordenado por popularidade.
- O módulo registra visitas únicas por identidade do visitante e intervalo. Ele não é uma stream bruta de eventos para cada refresh.

## Como Funciona

Visits salva uma linha por combinação única de:

```text
visitable_type
visitable_id
visitor_type
visitor_hash
interval
interval_key
```

O valor do visitante passa por hash com `config('app.key')`, então IP, session id, identidade de usuário ou UUID não ficam salvos diretamente.

## Instalação

Adicione o contrato e a trait ao model:

```php
use App\Visits\Contracts\CanBeVisited;
use App\Visits\Traits\HasVisits;

class Post extends Model implements CanBeVisited
{
    use HasVisits;
}
```

Rode a migration:

```bash
php artisan migrate
```

## Registrando Visitas

```php
$post->visit()->withIp()->dailyInterval();
$post->visit()->withSession()->hourlyInterval();
$post->visit()->withUser()->dailyInterval();
$post->visit()->withUuid($visitorUuid)->monthlyInterval();
$post->visit()->withData(['source' => 'homepage'])->dailyInterval();
```

## Métodos De Popularidade

| Método | Descrição |
| --- | --- |
| `visit()` | Inicia o registrador fluente para a instância atual do model. |
| `withTotalVisitCount()` | Adiciona o atributo `visit_count_total` sem alterar a ordenação atual. |
| `popularAllTime()` | Ordena os models pelo total geral de visitas. |
| `popularToday()` | Ordena os models por visitas registradas entre o início e o fim do dia atual. |
| `popularThisWeek()` | Ordena os models por visitas registradas durante a semana atual. |
| `popularLastWeek()` | Ordena os models por visitas registradas durante a semana anterior do calendário. |
| `popularThisMonth()` | Ordena os models por visitas registradas durante o mês atual. |
| `popularLastMonth()` | Ordena os models por visitas registradas durante o mês anterior do calendário. |
| `popularThisYear()` | Ordena os models por visitas registradas durante o ano atual. |
| `popularLastYear()` | Ordena os models por visitas registradas durante o ano anterior do calendário. |
| `popularLastDays($days)` | Ordena os models por visitas registradas na quantidade informada de últimos dias. |
| `popularBetween($from, $to)` | Ordena os models por visitas registradas dentro de um intervalo customizado de datas. |

## Exemplos

```php
Post::query()
    ->popularThisMonth()
    ->limit(10)
    ->get();
```

```php
Post::query()
    ->withTotalVisitCount()
    ->orderByDesc('visit_count_total')
    ->paginate();
```

```php
Post::query()
    ->popularBetween(now()->subDays(30), now())
    ->get();
```

## Observações

- A foreign key `visits.user_id` assume a tabela `users` padrão. Se o projeto não usa essa tabela, ajuste a migration antes de rodá-la.
- O módulo depende apenas de Laravel, Eloquent, migrations e Carbon através da própria aplicação.
- Dados fake de visitas pertencem a testes ou seeders locais, não ao núcleo do módulo.
