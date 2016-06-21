<?php namespace Masterkey\Payment\Pagseguro\Contracts;

    /**
     * Arrayable
     *
     * Interface para padronização dos métodos de pagamento
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   17/06/2016
     */
    interface Arrayable
    {
        /**
         * Transforma os atributos em array
         *
         * @return  array
         */
        public function toArray();
    }
