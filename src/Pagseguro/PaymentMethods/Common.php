<?php namespace Masterkey\Payment\Pagseguro\PaymentMethods;

    use Masterkey\Payment\Pagseguro\Contracts\Arrayable;

    /**
     * Common
     *
     * Possui os atributos comuns para os tipos de pagamento
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   17/06/2016
     */
    class Common implements Arrayable
    {
        /**
         * Email do comprador
         *
         * @var string
         */
        protected $senderEmail;

        /**
         * Nome do comprador
         *
         * @var string
         */
        protected $senderName;

        /**
         * CPF do comprador
         *
         * @var string
         */
        protected $senderCPF;

        /**
         * CNPJ do comprador
         *
         * @var string
         */
        protected $senderCNPJ;

        /**
         * Código de área
         *
         * @var string
         */
        protected $senderAreaCode;

        /**
         * Telefone
         *
         * @var string
         */
        protected $senderPhone;

        /**
         * CEP
         *
         * @var string
         */
        protected $shippingAddressPostalCode;

        /**
         * Endereço do comprador
         *
         * @var string
         */
        protected $shippingAddressStreet;

        /**
         * Número da Residência
         *
         * @var string
         */
        protected $shippingAddressNumber;

        /**
         * Complemento da residência
         *
         * @var string
         */
        protected $shippingAddressComplement;

        /**
         * Bairro
         *
         * @var string
         */
        protected $shippingAddressDistrict;

        /**
         * Cidade
         *
         * @var string
         */
        protected $shippingAddressCity;

        /**
         * Estado
         *
         * @example MG
         * @var     string
         */
        protected $shippingAddressState;

        /**
         * País do comprador
         *
         * @var string
         */
        protected $shippingAddressCountry = 'BRA';

        /**
         * Sender hash gerado pela API do PagSeguro
         *
         * @var string
         */
        protected $senderHash;

        /**
         * Tipo de frete
         *
         * @example 1 PAC
         * @example 2 Sedex
         * @example 3 Desconhecido
         * @var     int
         */
        protected $shippingType;

        /**
         * Valor do Frete
         *
         * @example 0.00 Decimal, duas casas após o ponto
         * @var     string
         */
        protected $shippingCost = "0.00";

        /**
         * Id do produto no banco de dados
         *
         * @var int
         */
        protected $itemId1;

        /**
         * Descrição do produto
         *
         * @var string
         */
        protected $itemDescription1;

        /**
         * Valor do produto
         *
         * @example 13.56  Decimal, duas casas após o ponto
         * @var     string
         */
        protected $itemAmount1 = '0.00';

        /**
         * Quantidade do Produto
         *
         * @var int
         */
        protected $itemQuantity1;

        /**
         * Seta os atributos de forma dinâmica
         *
         * @param   string $attribute
         * @param   string $value
         */
        public function __set($attribute, $value)
        {
            $this->$attribute = $value;
        }

        /**
         * Retorna os atributos da classe em forma de array
         *
         * @return  array
         */
        public function toArray()
        {
            $finalArray = [];

            foreach ($this as $key => $value) {
                $finalArray[$key] = $value;
            }

            return $finalArray;
        }
    }
