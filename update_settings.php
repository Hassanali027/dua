<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

\App\Models\Setting::updateOrCreate(
    ['key' => 'footer_address'],
    ['value' => '9933 Franklin Ave,<br>Franklin Park, IL 60131']
);

echo "Settings updated successfully.\n";
