<?php
    use Masterkey\Payment\Pagseguro\Facades\PagSeguro;

    class PagSeguroFacadeTest extends PHPUnit_Framework_TestCase
    {
        public function testGetFacadeAccessor()
        {
            $facade = new PagSeguro();
            $this->assertInstanceOf('Illuminate\Support\Facades\Facade', $facade);
        }
    }
