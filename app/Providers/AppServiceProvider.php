<?php

namespace App\Providers;

use App\Repositories\base\BaseRepository;
use App\Repositories\base\BaseRepositoryInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Services\OrderInterface;
use App\Services\OrderService;
use App\Services\sms\SmsFactory;
use App\Services\sms\SmsInterface;
use App\Services\sms\smsStrategy\AdapterInterface;
use App\Services\sms\smsStrategy\kavehnegar\KavehnegarAdapter;
use App\Services\sms\smsStrategy\parsasms\ParsasmsAdapter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        $this->app->bind(OrderInterface::class,OrderService::class);
        $this->app->bind(CustomerRepositoryInterface::class,CustomerRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        $this->app->bind(BaseRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(SmsInterface::class,SmsFactory::class);
        $this->app->bind(AdapterInterface::class,ParsasmsAdapter::class);
        $this->app->bind(AdapterInterface::class,KavehnegarAdapter::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
