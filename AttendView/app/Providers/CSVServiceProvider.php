<?php
/**
 * Created by PhpStorm.
 * User: Sorarinu
 * Date: 2017/04/20
 * Time: 22:45
 */

namespace app\Providers;

use app\Facades\CSV;
use Illuminate\Support\ServiceProvider;

class CSVServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bindshared('csv', function()
        {
            return new CSV;
        });

    }
}