<?php

    use Masterkey\Payment\Pagseguro\PagSeguro;
    use Masterkey\Payment\Pagseguro\PagSeguroEnvironment;

    class PagSeguroTest extends PHPUnit_Framework_TestCase
    {
        protected $sandbox = true;

        protected $sandboxData = [
            'credentials'   =>   [
                'email' =>  'seu-email',
                'token' =>  'seu-token',
            ],
            'sessionURL'        => "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions",
            'transactionsURL'   => "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions",
            'javascriptURL'     => "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js",
            'notificationURL'   => 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/'
        ];

        protected $productionData = [
            'credentials'   =>   [
                'email' =>  'email@email.com',
                'token' =>  '10110110110154asd54as2',
            ],
            'sessionURL'      => "https://ws.pagseguro.uol.com.br/v2/sessions",
            'transactionsURL' => "https://ws.pagseguro.uol.com.br/v2/transactions",
            'javascriptURL'   => "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js",
            'notificationURL' => 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/'
        ];

        public function testIsSandbox()
        {
            $pagseguro = new PagSeguro($this->sandbox, $this->sandboxData, $this->productionData);

            $this->assertEquals(true, $pagseguro->isSandbox());
        }

        public function testGetPagseguroData()
        {
            $pagseguro = new PagSeguro($this->sandbox, $this->sandboxData, $this->productionData);

            $this->assertInstanceOf('Masterkey\Payment\PagSeguro\PagSeguroEnvironment', $pagseguro->getPagSeguroData());
        }

        /**
         * @expectedException Exception
         * @expectedExceptionMessage    API Request Error
         */
        public function testPrintSessionId()
        {
            $pagseguro = new PagSeguro($this->sandbox, $this->sandboxData, $this->productionData);
            $pagseguro->printSessionId();
        }

        /**
         * @expectedException   Exception
         * @expectedExceptionMessage    Os dados do pedido são obrigatórios para continuar
         */
        public function testDoPaymentException()
        {
            $pagseguro = new PagSeguro($this->sandbox, $this->sandboxData, $this->productionData);
            $pagseguro->doPayment();
        }
    }
