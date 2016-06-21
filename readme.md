[![Build Status](https://travis-ci.org/MasterkeyInformatica/Payment.svg?branch=master)](https://travis-ci.org/MasterkeyInformatica/Payment)

Masterkey Payment
========================

Este pacote foi desenvolvido no intuito de auxiliar a integração de sistemas de pagamento com a API de checkout transparente do PagSeguro.

O pacote fornece uma API para integração entre sua aplicação e a API do PagSeguro, mas, antes de mais nada, leia atentamente o manual da API disponível em: http://download.uol.com.br/pagseguro/docs/pagseguro-checkout-transparente.pdf

Adicionando ao Projeto
----------------------

Para adicionar ao seu projeto, faça o download do Zip ou utilize o composer:
```sh
$ composer require masterkey/payment
```
Caso utilize Laravel 5, adicione o *Service Provider* e a *Facade* em `config/app.php`
```php
'providers' => [
  // Outros providers acima
  Masterkey\Payment\Pagseguro\PagseguroServiceProvider::class
],
'aliases' => [
  // Outras aliases acima
  'PagSeguro' => Masterkey\Payment\Pagseguro\Facades\PagSeguro::class,
]
```

Após isto, basta rodar `php artisan vendor:publish` para copiar o arquivo de configuração `pagseguro.php` para o diretório `config`.

Configurando o Ambiente
-----------------------

Trabalhando nisso...
