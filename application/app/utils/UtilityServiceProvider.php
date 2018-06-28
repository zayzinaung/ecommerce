<?php namespace Utils;

use Illuminate\Support\ServiceProvider;

class UtilsServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        
        $app->bind('Utils\FacebookInterface', 'Utils\Facebook');
    }

}

?>