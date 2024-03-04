# e-commerce api

Este projeto conta com alguns endpoints básicos para o funcionamento de e-commerce. Não tratamos de assuntos como autenticação, validações de dados em abundância entre outros. Temos apenas uma amostragem de uma API no contexto de criação de pedidos para uma loja.

A API foi desenvolvida com Laravel 10, banco de dados MySQL e utiliza o Sail para gerenciamento do Docker.

Para executar este projeto localmente deverá clonar este repositório e seguir alguns comandos abaixo:

Criar um alias para o Sail (facilita o desenvolvimento e os comandos futuros):

```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)
```

Buildar o projeto com Sail:
``` 
sail build --no-cache
sail up -d
sail artisan sail:install
sail down && sail up -d
 ```
Rodar as migrations e popular o banco de dados com Seeds:

```
sail artisan migrate
sail artisan db:seed
```

E finalmente poderemos testar os endpoints da aplicação. Sendo assim, temos:
- Lista de produtos disponíveis: ```GET /api/product ```
- Consultar vendas realizadas: ``` GET /api/order ```
- Cadastrar nova venda: ``` POST /api/order ``` com o payload neste formato:
```
{
  "sales_id": 2403041,
  "total_price": 1999.99,
  "products": [
    {
      "product_id": 1,
      "nome": "Celular 1",
      "price": 1999.99,
      "amount": 1
    }
  ]
}
```
- Consultar uma venda específica: ``` GET /api/order/{order_id} ```
- Cancelar uma venda: ``` DELETE /api/order/{order_id} ```
- Cadastrar novos produtos a uma venda: ``` POST /api/order/{order_id}/add_products ``` com o payload neste formato:
```
{
  "products": [
    {
      "product_id": 1,
      "name": "Celular 1",
      "price": 1999.99,
      "amount": 1
    }
  ]
}
```

