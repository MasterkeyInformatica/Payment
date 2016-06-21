<?php namespace Masterkey\Payment\Pagseguro\PaymentMethods;

    /**
     * Cartao
     *
     * Possui os atributos para efetuar uma compra utilizando o cartão de crédito
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   17/06/2016
     */
    class Cartao extends Common
    {
        /**
         * Método de pagamento
         *
         * @var string
         */
        protected $paymentMethod = 'creditCard';

        /**
         * Token do cartão, gerado pelo PagSeguro
         *
         * @var string
         */
        protected $creditCardToken;

        /**
         * Numero de parcelas
         *
         * @var int
         */
        protected $installmentQuantity;

        /**
         * Valor de cada parcela
         *
         * @var string
         */
        protected $installmentValue;

        /**
         * Quantidade de parcelas sem juros
         *
         * @example 3  Ao mudar esta quantidade, a mema quantidade deve ser informada
         *             na API javascript do pagseguro
         * @var int
         */
        protected $noInterestInstallmentQuantity = 5;

        /**
         * Nome impresso no cartão
         *
         * @var string
         */
        protected $creditCardHolderName;

        /**
         * CPF do dono do cartão
         *
         * @var string
         */
        protected $creditCardHolderCPF;

        /**
         * Nascimento do Dono do cartão
         *
         * @var date
         */
        protected $creditCardHolderBirthDate;

        /**
         * Código de área telefone
         *
         * @var int
         */
        protected $creditCardHolderAreaCode;

        /**
         * Telefone do dono cartão
         *
         * @var int
         */
        protected $creditCardHolderPhone;

        /**
         * Enderereço de cobrança
         *
         * @var string
         */
        protected $billingAddressStreet;

        /**
         * Numero da residência
         *
         * @var int
         */
        protected $billingAddressNumber;

        /**
         * Complemento do endereço de cobrança
         *
         * @var string
         */
        protected $billingAddressComplement;

        /**
         * Bairro do endereço de cobrança
         *
         * @var string
         */
        protected $billingAddressDistrict;

        /**
         * CEP do endereço de cobrança
         *
         * @var string
         */
        protected $billingAddressPostalCode;

        /**
         * Cidade de cobrança
         *
         * @var string
         */
        protected $billingAddressCity;

        /**
         * Estado de cobrança
         *
         * @example MG
         * @var     string
         */
        protected $billingAddressState;

        /**
         * País de Cobrança
         *
         * @var string
         */
        protected $billingAddressCountry = 'BRA';
    }
