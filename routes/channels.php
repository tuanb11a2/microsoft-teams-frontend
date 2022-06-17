<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('one-to-one-chat', function () {
    return true;
});
