#!/usr/bin/env bash

# php artisan optimize

#//            "Illuminate\\Foundation\\ComposerScripts::postUpdate",


# "Illuminate\\Foundation\\ComposerScripts::postInstall",
#            "php artisan optimize"


##!/bin/bash
#
### copy env vars into www pool
#
## For running the db in the container, ran externally, set in .env
#php artisan migrate:install
php artisan migrate
#php artisan db:seed --class=InspirationTableSeeder
