<?php

namespace sp_n1_v3\Middleware;

use Slim\Middleware;

class BeforeRequest extends Middleware
{
    public function call()
    {
        $this->app->hook('slim.before', [$this, 'run']);
        $this->next->call();
    }

    public function run()
    {
        if (isset($_SESSION[$this->app->config->get('auth.session')])) {
            $this->app->auth = $this->app->user->where('id', $_SESSION[$this->app->config->get('auth.session')])->first();
            $this->app->current_user_info = $this->app->user_info->where('user_id', $_SESSION[$this->app->config->get('auth.session')])->first();
        }
        $this->app->view()->appendData([
            'auth' => $this->app->auth,
            'current_user_info' => $this->app->current_user_info,
            'base_url' => $this->app->config->get('app.url'),
        ]);
    }
}
