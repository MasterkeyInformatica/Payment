<?php
    use Masterkey\Payment\Pagseguro\Sanitize;

    class SanitizeTest extends PHPUnit_Framework_TestCase
    {
        /**
         * @expectedException   Exception
         * @expectedExceptionMessage    Para realizar a sanitização é necessário informar os dados do pedido
         */
        public function testInstance()
        {
            $sanitize = new Sanitize([]);
            $this->assertInstanceOf('Masterkey\Payment\Pagseguro\Sanitize', $sanitize);
        }

        public function testSanitizeParams()
        {
            $params = [
                'paymentMethod'             => 'boleto',
                'senderEmail'               => 'email@email.com.br',
                'senderName'                => 'João José da Silva',
                'senderCPF'                 => '999.999.999-99',
                'senderAreaCode'            => '(000)',
                'senderPhone'               => '00000-0000',
                'shippingAddressPostalCode' => '12345-678',
                'shippingAddressStreet'     => 'Rua das Nações',
                'shippingAddressNumber'     => '0001',
                'shippingAddressComplement' => 'fundos',
                'shippingAddressDistrict'   => 'MonteVidéu',
                'shippingAddressCity'       => 'Guanhães',
                'shippingAddressState'      => 'MT',
                'shippingAddressCountry'    => "BRA",
                'senderHash'                => 'um_hash_qualquer',
                'shippingType'              => 3,
                'shippingCost'              => "0.00",
                'itemId1'                   => '1',
                'itemDescription1'          => 'Cursos - Iniciando em Licitações',
                'itemAmount1'               => "1.00",
                'itemQuantity1'             => 1,
            ];

            $sanitize   = new Sanitize($params);
            $newParams  = $sanitize->sanitizeParams()
                                   ->getPaymentParams();

            $this->assertEquals('99999999999', $newParams['senderCPF']);
            $this->assertEquals('000', $newParams['senderAreaCode']);
            $this->assertEquals('000000000', $newParams['senderPhone']);
            $this->assertEquals(utf8_decode($params['shippingAddressDistrict']), $newParams['shippingAddressDistrict']);
            $this->assertEquals(utf8_decode($params['senderName']), $newParams['senderName']);
        }

        public function testSanitizeCNPJ()
        {
            $params = [
                'senderCNPJ'                => '01.000.015/0001-99',
                'senderAreaCode'            => '(000)',
                'senderPhone'               => '00000-0000'
            ];

            $sanitize   = new Sanitize($params);
            $newParams  = $sanitize->sanitizeParams()
                                   ->getPaymentParams();

            $this->assertEquals('01000015000199', $newParams['senderCNPJ']);
            $this->assertEquals('000', $newParams['senderAreaCode']);
            $this->assertEquals('000000000', $newParams['senderPhone']);
        }
    }
