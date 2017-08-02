<?php
/**
 * Created by PhpStorm.
 * User: shunpingqi
 * Date: 2017/8/2
 * Time: 下午2:00
 */

namespace EasyLaravel\BaiduOcr;

use Illuminate\Support\ServiceProvider;


class BaiduOcrServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot(){
        $config_file = __DIR__ . '/../config/config.php';
        $this->mergeConfigFrom($config_file, 'baiduocr');
        $this->publishes([
            $config_file => config_path('baiduocr.php')
        ], 'baiduocr');
    }
    public function register()
    {
        $this->app->bind('baiduOcr', function ()
        {
            return new AipOcr(config('baiduocr.APP_ID'),config('baiduocr.API_KEY'),config('baiduocr.SECRET_KEY'));
        });
        $this->app->alias('baiduOcr', AipOcr::class);
    }
    public function provides()
    {
        return ['baiduOcr', AipOcr::class];
    }
}