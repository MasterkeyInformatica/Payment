<?php namespace Masterkey\Payment\Pagseguro;

    use Exception;

    /**
     * Sanitize
     *
     * Realiza a sanitização de alguns elementos que realizam a composição do pagamento
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   23/06/2016
     */
    class Sanitize
    {
        /**
         * Recebe os dados da requisição de pagamento
         *
         * @var array
         */
        protected $paymentRequest;

        /**
         * Construtor da classe
         *
         * @param   array  $paymentRequest
         * @throws  Exception
         */
        public function __construct($paymentRequest = null)
        {
            if(empty($paymentRequest) || !is_array($paymentRequest)) {
                throw new Exception("Para realizar a sanitização é necessário informar os dados do pedido", 1);
                return false;
            }

            $this->paymentRequest = $paymentRequest;
        }

        /**
         * Realiza a sanitização dos parâmetros
         *
         * @return  $this
         */
        public function sanitizeParams()
        {
            $this->clearDocuments();
            $this->clearPhone();

            $this->convertToIso();

            return $this;
        }

        /**
         * Converte os parâmetros de UTF-8 para ISO-8859-1
         *
         * @return  $this
         */
        private function convertToIso()
        {
            $this->paymentRequest = array_map('utf8_decode', $this->paymentRequest);

            return $this;
        }

        /**
         * Retorna os parâmetros de pagamento
         *
         * @return  array
         */
        public function getPaymentParams()
        {
            return $this->paymentRequest;
        }

        /**
         * Realiza a limpeza de documentos
         */
        private function clearDocuments()
        {
            if($this->verifyKeyExists('senderCPF')) {
                $this->clearString('senderCPF');
            }

            if($this->verifyKeyExists('senderCNPJ')) {
                $this->clearString('senderCNPJ');
            }

            if($this->verifyKeyExists('creditCardHolderCPF')) {
                $this->clearString('creditCardHolderCPF');
            }
        }

        /**
         * Realiza a limpeza de números de telefone e códigos de area
         */
        private function clearPhone()
        {
            $this->clearString('senderAreaCode');
            $this->clearString('senderPhone');

            if($this->verifyKeyExists('creditCardHolderAreaCode')) {
                $this->clearString('creditCardHolderAreaCode');
            }

            if($this->verifyKeyExists('creditCardHolderPhone')) {
                $this->clearString('creditCardHolderPhone');
            }
        }

        /**
         * Verifica se determinada key existe no array de pagamento
         *
         * @param   string  $key
         * @return  bool
         */
        private function verifyKeyExists($key) {
            return array_key_exists($key, $this->paymentRequest);
        }

        /**
         * Realiza a limpeza de determinada key no array
         *
         * @param   string  $key
         */
        private function clearString($key)
        {
            $toRemove = ['.', '-', '/', '(', ')'];
            $this->paymentRequest[$key] = (int) str_replace($toRemove, '', $this->paymentRequest[$key]);
        }
    }
