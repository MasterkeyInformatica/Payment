<?php namespace Masterkey\Payment\Pagseguro\Facades;

    use Illuminate\Support\Facades\Facade;

    /**
     * Pagseguro
     *
     * Enable the facade for the package
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   15/06/2016
     */
    class PagSeguro extends Facade
    {
        /**
         * Register the name of the component
         *
         * @return  string
         */
        protected static function getFacadeAccessor()
        {
            return 'pagseguro';
        }
    }
