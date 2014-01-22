<?php namespace PragmaRX\Skeleton\Vendor\Laravel;
 
use PragmaRX\Skeleton\Skeleton;

use PragmaRX\Skeleton\Services\Authentication;

use PragmaRX\Skeleton\Support\Config;
use PragmaRX\Skeleton\Support\MobileDetect;
use PragmaRX\Skeleton\Support\UserAgentParser;
use PragmaRX\Skeleton\Support\FileSystem;

use PragmaRX\Skeleton\Data\Repositories\Session;
use PragmaRX\Skeleton\Data\Repositories\Access;
use PragmaRX\Skeleton\Data\Repositories\Agent;
use PragmaRX\Skeleton\Data\Repositories\Device;
use PragmaRX\Skeleton\Data\Repositories\Cookie;

use PragmaRX\Skeleton\Data\RepositoryManager;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Foundation\AliasLoader as IlluminateAliasLoader;

class ServiceProvider extends IlluminateServiceProvider {

    const PACKAGE_NAMESPACE = 'pragmarx/tracker';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package(self::PACKAGE_NAMESPACE, self::PACKAGE_NAMESPACE, __DIR__.'/../..');

        if( $this->app['config']->get(self::PACKAGE_NAMESPACE.'::create_tracker_alias') )
        {
            IlluminateAliasLoader::getInstance()->alias(
                                                            $this->getConfig('tracker_alias'),
                                                            'PragmaRX\Skeleton\Vendor\Laravel\Facade'
                                                        );
        }

        $this->wakeUp();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {   
        // Unfortunately, we are stuck with PHP session, because
        // Laravel's Session ID changes every time user logs in.
        session_start(); 

        new UserAgentParser($this->app->make('path.base'));

        $this->registerConfig();

        $this->registerAuthentication();

        $this->registerRepositories();

        $this->registerSkeleton();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('tracker');
    }

    /**
     * Takes all the components of Skeleton and glues them
     * together to create Skeleton.
     *
     * @return void
     */
    private function registerSkeleton()
    {
        $this->app['tracker'] = $this->app->share(function($app)
        {
            $app['tracker.loaded'] = true;

            return new Skeleton(
                                    $app['tracker.config'],
                                    $app['tracker.repositories'],
                                    $app['request']
                                );
        });
    }

    public function registerRepositories()
    {
        $this->app['tracker.repositories'] = $this->app->share(function($app)
        {
            $sessionModel = $this->getConfig('session_model');
            $accessModel = $this->getConfig('access_model');
            $agentModel = $this->getConfig('agent_model');
            $deviceModel = $this->getConfig('device_model');
            $cookieModel = $this->getConfig('cookie_model');

            return new RepositoryManager(
                                        new Session(new $sessionModel, 
                                                    $app['tracker.config'], 
                                                    $app['session.store']),

                                        new Access(new $accessModel),

                                        new Agent(new $agentModel),

                                        new Device(new $deviceModel),

                                        new Cookie(new $cookieModel,
                                                    $app['tracker.config'],
                                                    $app['request'],
                                                    $app['cookie']),

                                        new MobileDetect,

                                        new UserAgentParser($app->make('path.base')),

                                        $app['tracker.authentication'],

                                        $app['session.store'],

                                        $app['tracker.config']
                                    );
        });
    }

    public function registerAuthentication()
    {
        $this->app['tracker.authentication'] = $this->app->share(function($app)
        {
            return new Authentication($app['tracker.config'], $app);
        });
    }

    public function registerConfig()
    {
        $this->app['tracker.config'] = $this->app->share(function($app)
        {
            return new Config($app['config'], self::PACKAGE_NAMESPACE);
        });
    }

    private function wakeUp()
    {
        $this->app['tracker']->boot();
    }

    private function getConfig($key)
    {
        return $this->app['config']->get(self::PACKAGE_NAMESPACE.'::'.$key);
    }

}
