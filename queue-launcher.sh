#!/bin/bash

nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
