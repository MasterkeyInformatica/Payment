<?php namespace Masterkey\Payment\Pagseguro\PaymentMethods;

    /**
     * Possui os atributos para efetuar uma compra utilizando o boleto bancário
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   17/06/2016
     */
    class Boleto extends Common
    {
        /**
         * Método de Pagamento
         *
         * @var string
         */
        protected $paymentMethod = 'boleto';
    }
