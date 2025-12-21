<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('backup:run')->daily()->at('02:00');
