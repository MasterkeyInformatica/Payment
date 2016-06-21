<?php namespace Masterkey\Payment\Pagseguro;

    use Illuminate\Support\ServiceProvider;

    class PagseguroServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot()
        {
            $this->publishes([
                __DIR__.'/../../config/pagseguro.php'   => config_path('pagseguro.php')
            ]);
        }

        /**
         * Register the application services.
         *
         * @return void
         */
        public function register()
        {
            $this->app->singleton('pagseguro', function ($app) {

                $sandbox        = config('pagseguro.sandbox');
                $sandboxData    = config('pagseguro.sandboxData');
                $productionData = config('pagseguro.productionData');

                return new PagSeguro($sandbox, $sandboxData, $productionData);
            });
        }

        /**
         * Get the services provided by the provider.
         *
         * @return  array
         */
        public function provides()
        {
            return ['pagseguro'];
        }
    }
