# Desafio EngSoftware

CRUD para registro de pedidos. Onde a soma dos valores dos pedidos em parcelas devem conter apenas 2 casas decimais,também é utilizado o serviço ipgeolocation.io para caputrar a localização do usuario que realiza o pedido de forma automatica.


Requisitos funcionais: 

- O sistema deve permitir que usuário insira o valor total do pedido. 
- O sistema deve permitir que o usuário insira a quantidade de parcelas. 
- O usuário deve informar seu nome e CPF. 
- O sistema deve possibilitar três formas de pagamento (Cartão, Débito ou à Vista). 
- O sistema deve capturar a localização do pedido através do IP.
- O sistema deve exibir o pedido. 
- O sistema deve exibir as parcelas do pedido. 

Requisistos não funcionais: 

- O sistema deve ser escrito em PHP.
- O sistema devera se comunicar com o banco de dados MySQL.
- O sistema não poderá utilizar nenhum framework.
- O sistema deve utilizar um repositório público. 


Regras de negócio: 

- Os usuários que utilizar cartão como forma de pagámento terá um acréscimo de 3% 
- Os usuários que utilizar débito como forma de pagámento terá um desconto de 5% 
- Os usuários que utilizar à vista como forma de pagamento terá um desconto de 10% 


OBS: A key para utilizar o ipgeolocation.io expira no dia 19/05/2019. A key deve ser substituida por uma nova para que o sistema capture as informações de Localização
