# ImagePreview

Preview visual de imagens para formulários Livewire de criação e edição.

## Quando Usar

- Use ImagePreview quando um formulário precisa exibir o preview de um upload selecionado ou mostrar uma imagem já salva antes da substituição.
- Mantenha a persistência do arquivo no formulário ou componente Livewire pai. ImagePreview apenas renderiza o preview e expõe o upload temporário selecionado por `wire:model.live`.
- Use em produtos, posts, banners, perfis, categorias e fluxos em modal onde o comportamento de upload deve continuar reutilizável.

## Variações

### Modo Create

Mostra uma área vazia de preview até uma nova imagem ser selecionada.

- Começa com o texto de estado vazio.
- Usa o upload temporário selecionado como preview.
- Envia o arquivo selecionado para a propriedade pai por `wire:model.live`.
- Não precisa de `path`, `disk`, `placeholder` nem `existing`.

```blade
<livewire:global.image-preview
    mode="create"
    name="banner_image"
    size="col-span-12"
    wire:model.live="banner_image"
/>
```

### Modo Edit

Mostra a imagem atual primeiro e troca o preview quando um novo upload é selecionado.

- Lê a imagem atual por `path` e `disk` quando `existing` é true.
- Usa `placeholder` quando o arquivo salvo não é encontrado.
- Mantém a imagem existente visível até o usuário selecionar um upload substituto.
- Mantém o botão de salvar configurável para formulários que salvam a imagem separadamente.

```blade
<livewire:global.image-preview
    mode="edit"
    name="banner_image"
    size="col-span-12"
    :existing="filled($banner->banner_image)"
    :path="$banner->banner_image"
    disk="banners"
    placeholder="img/placeholders/banner-image-not-found.jpg"
    wire:model.live="banner_image"
/>
```

## Configuração

| Opção | Tipo | Padrão | Descrição |
| --- | --- | --- | --- |
| `mode` | string | `create` | Controla o fluxo visual. Use `create` para novos registros e `edit` para registros existentes. |
| `name` | string | `image` | Nome do input file e chave de erro de validação usada pelo formulário pai. |
| `size` | string | `col-span-3` | Classes de layout aplicadas ao wrapper do componente. |
| `existing` | bool | `false` | Informa se o componente deve renderizar uma imagem já salva. |
| `path` | string|null | `null` | Caminho relativo da imagem existente dentro do disk configurado. |
| `disk` | string|null | `public` | Disk do filesystem Laravel usado para resolver a imagem existente. |
| `placeholder` | string|null | `null` | Asset público exibido quando a imagem existente não é encontrada. |
| `accept` | string | `image/*` | Valor nativo de accept do input file. |
| `hasError` | bool | `false` | Força a borda de erro quando o componente pai valida o upload fora do componente. |
| `showSaveButton` | bool|null | `null` | Quando null, o modo edit mostra o botão de salvar e o modo create esconde. Passe false quando o formulário pai já tiver seu próprio submit. |

## Fluxo De Salvamento No Pai

Use `NormalizesLivewireUploads` quando um modal ou componente aninhado reutiliza a mesma propriedade para o caminho persistido e o upload temporário.

```php
use App\Livewire\Traits\NormalizesLivewireUploads;

public $banner_image;

public function save(): void
{
    $this->normalizeUpload('banner_image');

    $data = $this->validate([
        'banner_image' => ['required', 'image', 'max:2048'],
    ]);

    $path = DiskHelper::saveFile($data['banner_image'], 'banners');
}
```

## Fluxo De Substituição No Pai

```php
use App\Livewire\Traits\NormalizesLivewireUploads;

public $banner_image;

public function updateImage(): void
{
    $this->normalizeUpload('banner_image');

    $data = $this->validate([
        'banner_image' => ['required', 'image', 'max:2048'],
    ]);

    $path = DiskHelper::updateFile($data['banner_image'], $this->banner->banner_image, 'banners');
}
```

## Observações

- ImagePreview apenas exibe o preview. Salvar, substituir e remover arquivos fisicamente é responsabilidade do formulário ou componente Livewire pai.
- Fluxos em modal que reutilizam a mesma propriedade para o caminho persistido e o upload temporário devem chamar `NormalizesLivewireUploads` antes da validação.
- `MediaHelper` e `DiskHelper` são dependências esperadas da base do dashboard.
