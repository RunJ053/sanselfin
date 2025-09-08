<?php

use GuzzleHttp\Psr7\ServerRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Notificacion;

class ViewServiceProvider extends ServiceProvider {

    public function boot()
{
    View::composer('components.navbar', function ($view) {
        $notificaciones = auth()->check()
            ? Notificacion::where('usuario_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get()
            : collect();

        $view->with('notificaciones', $notificaciones);
    });
}
}
