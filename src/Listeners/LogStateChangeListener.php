<?php

namespace Dpb\Extension\ModelState\Listeners;

use Spatie\ModelStates\Events\StateChanged;
use Dpb\Extension\ModelState\Models\StateChange;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class LogStateChangeListener
{
    public function __construct(protected Guard $auth) {}

    public function handle(StateChanged $event): void
    {
        // Resolve the actor
        // $userId = $auth->->id() ?? 1; // fallback if queued job stored actor
        // $userType = $this->guard?->user()->getMorphClass() ?? config('ext-spatie-model-states.user_morph_uri', Authenticatable::class);
        $userType =  config('ext-spatie-model-states.user_morph_uri', Authenticatable::class);

        StateChange::create([
            'model_type' => $event->model->getMorphClass(),
            'model_id'   => $event->model->id,
            'from_state' => $event->initialState,
            'to_state'   => $event->finalState,
            'user_type'    => $userType, //config('ext-spatie-model-states.user_morph_uri'),
            'user_id'    => $this->getUserId(),
            'changed_at' => now(),
            'source'     => app()->runningInConsole() ? 'system' : 'http',
        ]);
    }

    protected function getUserId() {
        if (app()->runningInConsole()) {
            return 1;
        }
        return $this->auth->id();
    }
}
