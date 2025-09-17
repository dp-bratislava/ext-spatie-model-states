<?php

namespace Dpb\Extension\ModelState\Listeners;

use Spatie\ModelStates\Events\StateChanged;
use Dpb\Extension\ModelState\StateChange;
use Illuminate\Contracts\Auth\Guard;

class LogStateChangeListener
{
    public function __construct(protected Guard $guard) {}

    public function handle(StateChanged $event): void
    {
        // Resolve the actor
        $userId = $this->guard->id() ?? null; // fallback if queued job stored actor

        StateChange::create([
            'model_type' => $event->model->getMorphClass(),
            'model_id'   => $event->model->id,
            'from_state' => $event->initialState,
            'to_state'   => $event->finalState,
            'user_type'    => $userId,
            'user_id'    => $userId,
            'changed_at' => now(),
            'source'     => app()->runningInConsole() ? 'system' : 'http',
        ]);
    }
}
