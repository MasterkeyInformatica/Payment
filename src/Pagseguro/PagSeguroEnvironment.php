<?php namespace Masterkey\Payment\PagSeguro;

    /**
     * PagSeguroEnvironment
     *
     * Realiza o gerenciamento dos parâmetros de configuração do pagseguro. Define
     * de acordo com o valor de sandbox, as urls que o sistema deve parametrizar
     * para geração do environment correto
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @author  Cassio Almeida <cassio.almeidaa@gmail.com>
     * @version 2.0.0
     * @since   15/06/2016
     */
    class PagSeguroEnvironment
    {
        /**
         * Define if the system is runnig in Sandbox
         *
         * @var bool
         */
        protected $sandbox;

        /**
         * Sandbox configuration data
         *
         * @var array
         */
        protected $sandboxData;

        /**
         * Production configuration data
         *
         * @var array
         */
        protected $productionData;

        /**
         * Constructor
         *
         * @param   bool  $sandbox
         * @param   array  $sandboxData
         * @param   array  $productionData
         */
        public function __construct($sandbox, $sandboxData, $productionData)
        {
            $this->sandbox          = $sandbox;
            $this->sandboxData      = $sandboxData;
            $this->productionData   = $productionData;
        }

        /**
         * Return the needed key according with the environment
         *
         * @param   string  $key
         * @return  string
         */
        private function getEnvironmentData($key)
        {
            return ($this->sandbox) ? $this->sandboxData[$key] : $this->productionData[$key];
        }

        /**
         * Get the session URL
         *
         * @return  string
         */
        public function getSessionURL()
        {
            return $this->getEnvironmentData('sessionURL');
        }

        /**
         * Get the transaction URL
         *
         * @return  string
         */
        public function getTransactionsURL() {
            return $this->getEnvironmentData('transactionsURL');
        }

        /**
         * Get the notification URL
         *
         * @return  string
         */
        public function getNotificationsURL(){
            return $this->getEnvironmentData('notificationURL');
        }

        /**
         * Get the javascript URL
         *
         * @return  string
         */
        public function getJavascriptURL() {
            return $this->getEnvironmentData('javascriptURL');
        }

        /**
         * Get the user's credencials
         *
         * @return  array
         */
        public function getCredentials() {
            return $this->getEnvironmentData('credentials');
        }

        /**
         * Verify the actual environment of sandbox
         *
         * @return  boolean
         */
        public function isSandbox() {
            return (bool)$this->sandbox;
        }
    }
