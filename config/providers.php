<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Provider Groups
     |--------------------------------------------------------------------------
     |
     | You may configure your environments with provider groups. Providers
     | and aliases in a provider group will only be loaded in when your
     | application's environment is present in the group. Effortless.
     |
     */
    [
        'environments' => ['local', 'development', 'dev'],

        'providers' => [
            //DebugBar
            Barryvdh\Debugbar\ServiceProvider::class,
            //IdeaHelper
            \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class
        ],

        'aliases' => [
            //
        ],
    ],

    /*
     |--------------------------------------------------------------------------
     | Customize
     |--------------------------------------------------------------------------
     |
     | Of course you may modify this file as much as you want.
     | Play around and find provider groups that are right
     | for you. I'll leave you to it now. Happy hacking!
     |
     */
    [
        'environments' => ['production'],
        'providers' => [],
        'aliases' => [],
    ],

];