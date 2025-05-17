# Como rodar site depois da implementação das imagens

Geração dos dados
---------------------------
Nesta altura, as propriedades já tem imagens em forma de ficheiros.
Antes de fazer seeding, é necessário:
- Adicionar imagens
    - Criar pasta "property-images" na pasta storage/seed
    - Encher pelo menos 10 com imagens da sua escolha (mais - melhor).
    - Ratmir pode partilhar zip com imagens das casas.
- Ajustar PropertySeeder
    - por exemplo se é preciso gerar muitos dados para **testar pesquisa**,
    - deixar $count = 1 para resuzir quantidade das imagens por propriedade
- Finalmente rodar o comando:
```sh
  php artisan migrate:fresh --seed
```

Definições para imagens
--------------------------
Para que não houve erros na inserção e processão das imagens,
é necessário aumentar limites certos nas definições do PHP no Herd:
- Tamanho máximo de upload: pelo menos 5MB
- Limite de memória: pelo menos 512MB

![img.png](img/herd.png)

> Mesmo assim, o desempenho do site pode ser afetado
com carregamento constante das imagens em qualidade inteira.
Por isso implementamos um sistema para gerar thumbnails e previews das imagens,
que são gerados após a inserção das imagens.

Para ligar transformação pode **escolher uma das seguintes opções**:

```sh
  php artisan queue:work
```
Rodar num terminal separado enquanto desenvolvimento (como <i>npm run dev</i>):


WebSockets (realtime)
--------------------------
Para que funcionalidades de *sockets* 
(por exemplo atualização instantânea de pedidos de verificação de anunciante) 
funcionem, é necessário correr o comando:
```sh
  php artisan reverb:start
```


Notas finais
----------------------
> Tentem excluir Seeders e .env dos seus commits, para cada um ficar
com a versão propria ajustada para propósitos específicos.

Bom trabalho a todos!
