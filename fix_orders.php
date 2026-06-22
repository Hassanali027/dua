<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$orders = App\Models\Order::where('order_number', '')->orWhereNull('order_number')->get();
foreach($orders as $order) {
    $order->update(['order_number' => 'ORD-' . strtoupper(uniqid())]);
}
echo "Updated " . $orders->count() . " orders.";
