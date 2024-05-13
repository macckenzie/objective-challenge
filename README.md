## Configurando o projeto

A aplicação está em um container Docker e é necessário te-lo previamente configurado, buildar, acessar o bash e rodar o comando de migração. Segue instruções com o uso do docker-compose:
- Clonar o projeto. É necessário deixar liberado a porta 8000.
  <br><br>
- Na pasta raiz (com docker-compose também instalado) rodar: <br> ```docker-compose up --build -d```
  <br><br>
- Após o container estar iniciado (aguarde o composer install), acessar o bash: <br> ```docker-compose exec objective-app bash```
  <br><br>
- Rodar o comando para criar a base de dados e popular as contas: <br> ```php artisan migrate --seed```
<br><br>```Atençaõ: será solicitado a criação do arquivo de banco de dados. Selecionar a opção "Yes".```
<br><br>
- Testes de integração (Contas e Transações): <br> ```php artisan test```

## Acessando o projeto

- As operações de 1 a 6 solicitadas no desafio estão disponíveis em [localhost](http://127.0.0.1:8000) (porta 8000), e o código é executado em Controllers\Controller.php. 
- As rotas de API estão disponíveis em /api:<br>
```(GET) /api/conta?id=?```<br>
```(POST) /api/conta```<br>
```(POST) /api/transacao```
<br><br>
- Segundo a recrutadora o idioma a ser utilizado ficaria a meu critério, então com exceção das rotas o restante do projeto e os commits estão em Inglês.
<br><br>

- Créditos: [Nathanael Mendes](https://github.com/macckenzie)
