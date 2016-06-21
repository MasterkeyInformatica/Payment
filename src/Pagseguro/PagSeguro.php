<?php namespace Masterkey\Payment\Pagseguro;

    use Exception;
    use Masterkey\Payment\HttpConnection;
    use Masterkey\Payment\XmlParser;
    use Masterkey\Payment\PagSeguro\Contracts\Arrayable;

    /**
     * PagSeguro
     *
     * Realiza o gerenciamento das transações envolvendo o sistema de pagamentos
     * PagSeguro
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @author  Cassio Almeida <cassio.almeidaa@gmail.com>
     * @version 2.0.0
     * @since   15/06/2016
     */
    class PagSeguro
    {
        /**
         * Sandbox environment
         *
         * @var bool
         */
        protected $sandbox;

        /**
         * Pagseguro Environment
         *
         * @var PagSeguroEnvironment
         */
        protected $pagseguroData;

        public function __construct($sandbox = true, $sandboxData, $productionData)
        {
            $this->sandbox          = $sandbox;
            $this->pagseguroData    = new PagSeguroEnvironment($sandbox, $sandboxData, $productionData);
        }

        /**
         * Define se o aplicativo está rodando em modo sandbox
         *
         * @return boolean
         */
        public function isSandbox()
        {
            return ($this->sandbox) ? true : false;
        }

        /**
         * Retorna os dados do environment atual
         *
         * @return PagSeguroEnvironment
         */
        public function getPagSeguroData()
        {
            return $this->pagseguroData;
        }

        /**
         * Imprime o ID de seção do Pagseguro
         *
         * @return  string|exception
         * @throws  Exception
         */
        public function printSessionId()
        {
            $httpConnection = new HttpConnection();

            $httpConnection->post($this->pagseguroData->getSessionURL(), $this->pagseguroData->getCredentials());

            if ($httpConnection->getStatus() === 200) {
                $data       = $httpConnection->getResponse();
                $sessionId  = $this->parseSessionIdFromXml($data);

                echo $sessionId;
            } else {
                throw new Exception("API Request Error: " . $httpConnection->getStatus());
            }
        }

        /**
         * Retorna o ID de seção do Pagseguro
         *
         * @return  string|exception
         * @throws  Exception
         */
        public function getSessionId()
        {
            $httpConnection = new HttpConnection();
            $httpConnection->post($this->pagseguroData->getSessionURL(), $this->pagseguroData->getCredentials());

            if ($httpConnection->getStatus() === 200) {
                $data       = $httpConnection->getResponse();
                $sessionId  = $this->parseSessionIdFromXml($data);

                return $sessionId;
            } else {
                throw new Exception("API Request Error: " . $httpConnection->getStatus());
            }
        }

        /**
         * Realiza uma requisição de pagamento
         *
         * @param   Arrayable  $paymentMethod
         * @param   array $params
         * @return  array
         */
        public function doPayment(Arrayable $paymentMethod)
        {
            $params = $paymentMethod->toArray();
            $params += $this->pagseguroData->getCredentials();

            $params['paymentMode']  = 'default';
            $params['currency']     = 'BRL';

            $httpConnection = new HttpConnection();
            $httpConnection->post($this->pagseguroData->getTransactionsURL(), $params);

            $xmlArray = $this->paymentResultXml($httpConnection->getResponse());

            if(isset($xmlArray['errors'])) {
                $erro = new PagseguroErrors($xmlArray['errors']);
                return $erro->getErrors();
            }

            return $xmlArray;
        }

        /**
         * Realiza o parse do ID de seção recebido do XML
         *
         * @param   mixed  $data
         * @return  mixed
         * @throws  Exception
         */
        private function parseSessionIdFromXml($data)
        {
            $xmlParser = new XmlParser($data);
            if ($xml = $xmlParser->getResult("session")) {
                return $xml['id'];
            } else {
                throw new Exception("[$data] is not an XML");
            }
        }

        /**
         * Recebe o resultado do pagamento
         *
         * @param   mixed  $data
         * @return  null|string
         * @throws  Exception
         */
        private function paymentResultXml($data)
        {
            $xmlParser = new XmlParser($data);
            if ($xml = $xmlParser->getResult()) {
                return $xml;
            } else {
                throw new Exception("[$data] is not an XML");
            }
        }

        /**
         * Realiza uam consulta de uma ordem de pagamento
         *
         * @param   int  $codeNotification
         * @return  null|string
         * @throws  Exception
         */
        public function paymentOrderConsult($codeNotification)
        {
            $params = $this->pagseguroData->getCredentials();

            $httpConnection = new HttpConnection();
            $httpConnection->get($this->pagseguroData->getNotificationsURL().$codeNotification, $params);
            $xmlArray = $this->paymentResultXml($httpConnection->getResponse());

            header("HTTP/1.1 ".$httpConnection->getStatus());

            return $xmlArray;
        }
    }
