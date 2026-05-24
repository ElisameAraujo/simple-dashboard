# DateHelper

Formata datas, intervalos relativos e rótulos de data para e-mail com saída localizada.

## Quando Usar

- Use DateHelper quando datas precisam ser exibidas para pessoas, não apenas armazenadas ou comparadas.
- O helper resolve o locale solicitado, carrega as traduções de datas do projeto e aplica o timezone da aplicação antes de formatar.

## Exemplo

```php
DateHelper::simpleDate('2026-05-19', 'pt-BR');
```

**Saída**

```
19/05/2026
```

## Métodos

### `currentYear`

Retorna o ano atual no formato de quatro dígitos.

**Exemplo**

```php
DateHelper::currentYear();
```

**Saída**

```
2026
```

### `currentDate`

Retorna a data atual usando o formato configurado para o locale informado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `locale` | Locale usado para definir o formato da saída. Quando omitido, usa o locale atual da aplicação. |

**Exemplo**

```php
DateHelper::currentDate('pt-BR');
```

**Saída**

```
21/05/2026
```

### `fullCurrentDate`

Retorna a data atual por extenso, com dia da semana e mês traduzidos.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `locale` | Locale usado para traduzir o dia da semana, o mês e o formato final. |

**Exemplo**

```php
DateHelper::fullCurrentDate('pt-BR');
```

**Saída**

```
quinta-feira, 21 de maio de 2026
```

### `fullExtendedDate`

Formata uma data recebida em string no formato completo do locale.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data que será formatada. |
| `locale` | Locale usado para traduzir o dia da semana, o mês e o formato final. |

**Exemplo**

```php
DateHelper::fullExtendedDate('2026-05-19', 'pt-BR');
```

**Saída**

```
terça-feira, 19 de maio de 2026
```

### `currentFullDateWithHours`

Formata uma data por extenso incluindo a hora.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data e hora que serão formatadas. |
| `locale` | Locale usado para traduzir e montar a saída final. |

**Exemplo**

```php
DateHelper::currentFullDateWithHours('2026-05-19 10:30:00', 'pt-BR');
```

**Saída**

```
19 de maio de 2026 às 10:30
```

### `diffDatesHuman`

Retorna a diferença entre uma data e o momento atual em texto humanizado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data que será comparada com o momento atual. |
| `locale` | Locale usado para traduzir unidades como minutos, horas, dias e meses. |

**Exemplo**

```php
DateHelper::diffDatesHuman('2026-05-19 11:58:00', 'pt-BR');
```

**Saída**

```
2 minutos atrás
```

### `dateWithHoursAndSeconds`

Formata uma data com hora, minuto e segundo.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data e hora que serão formatadas. |
| `locale` | Locale usado para definir o formato da saída. |

**Exemplo**

```php
DateHelper::dateWithHoursAndSeconds('2026-05-19 10:30:15', 'pt-BR');
```

**Saída**

```
19/05/2026 às 10:30:15
```

### `dateExcel`

Formata uma data no padrão esperado para planilhas no locale informado.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data que será formatada. |
| `locale` | Locale usado para definir o padrão da data. |

**Exemplo**

```php
DateHelper::dateExcel('2026-05-19', 'pt-BR');
```

**Saída**

```
19/05/2026
```

### `dateWithHours`

Formata uma data com hora e minuto, sem segundos.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data e hora que serão formatadas. |
| `locale` | Locale usado para definir o formato da saída. |

**Exemplo**

```php
DateHelper::dateWithHours('2026-05-19 10:30:15', 'pt-BR');
```

**Saída**

```
19/05/2026 às 10:30
```

### `simpleDate`

Formata uma data simples com dia, mês e ano.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data que será formatada. |
| `locale` | Locale usado para definir o formato da saída. |

**Exemplo**

```php
DateHelper::simpleDate('2026-05-19', 'pt-BR');
```

**Saída**

```
19/05/2026
```

### `isTodayCheck`

Verifica se a data informada corresponde ao dia atual.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data que será comparada com o dia atual. |

**Exemplo**

```php
DateHelper::isTodayCheck('2026-05-21');
```

**Saída**

```
true
```

### `daysDifference`

Retorna a diferença em dias entre duas datas.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `startDate` | Data inicial usada no cálculo. |
| `endDate` | Data final usada no cálculo. |

**Exemplo**

```php
DateHelper::daysDifference('2026-05-19', '2026-05-22');
```

**Saída**

```
3
```

### `shortDate`

Exibe apenas o dia e o mês no formato curto do locale.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data que será formatada. |
| `locale` | Locale usado para definir o formato curto. |

**Exemplo**

```php
DateHelper::shortDate('2026-05-19', 'pt-BR');
```

**Saída**

```
19/05
```

### `shortTime`

Exibe apenas hora e minuto.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data e hora que serão formatadas. |
| `locale` | Locale usado para definir o formato do horário. |

**Exemplo**

```php
DateHelper::shortTime('2026-05-19 10:30:15', 'pt-BR');
```

**Saída**

```
10:30
```

### `emailDate`

Formata uma data para exibição em e-mails, combinando data curta e tempo relativo.

**Parâmetros**

| Parâmetro | Descrição |
| --- | --- |
| `date` | Data e hora que serão formatadas. |
| `locale` | Locale usado para traduzir a data e o tempo relativo. |

**Exemplo**

```php
DateHelper::emailDate('2026-05-19 11:58:00', 'pt-BR');
```

**Saída**

```
Ter, 19 de mai., 11:58 (2 minutos atrás)
```
