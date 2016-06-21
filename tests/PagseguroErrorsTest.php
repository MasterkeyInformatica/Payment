<?php

    use Masterkey\Payment\Pagseguro\PagseguroErrors;

    /**
     * Realiza os testes da classe PagseguroErrors
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   21/06/2016
     */
    class PagseguroErrorsTest extends PHPUnit_Framework_TestCase
    {
        /**
         * @expectedException   Exception
         * @expectedExceptionMessage O array de erros enviados pelo Pagseguro é inválido
         */
        public function testGerErrors()
        {
            $error = [
                'error' => [
                    [
                        'code'      => "5003",
                        'message'   => 'Falha de comunicação com a instituição financeira.'
                    ]
                ]
            ];

            $errors = new PagseguroErrors($error);
            $result = $errors->getErrors();

            $this->assertInstanceOf('Masterkey\Payment\Pagseguro\PagseguroErrors', $errors);
            $this->assertInternalType('array', $result);
            $this->assertEquals($result[0], $error['error'][0]['message']);

            $errors = null;
            $errors = new PagseguroErrors([]);
            $result = $errors->getErrors();
        }
    }
