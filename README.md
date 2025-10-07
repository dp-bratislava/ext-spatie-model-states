# Laravel model states extension

Extension for [spatie laravel extension for model states handling](https://spatie.be/docs/laravel-model-states/v2/01-introduction)

## This extension adds

* Polymorphic pivot table to bind model, old state, new state and user that made thae change
* Custom event listener for logging state change history
* Trait for accessing model state history on models

# TO DO 

* handle user morphTo via class in config or some other method  
* handle console commands and situations when we dont have current user set.
  * create system user for this or something
