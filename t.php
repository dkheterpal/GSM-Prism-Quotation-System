<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$q = \App\Models\Quote::create([
    'quote_number' => 'GSM-TEST-123',
    'customer_name' => 'General Motors',
    'email' => 'test@gm.com',
    'address' => '100 GM Way'
]);

// 1. Fixed Price for POD (price_id=1)
$q->items()->create(['product_id' => 1, 'price_id' => 1, 'quantity' => 1]);

// 2. SaaS Price for TUNL (price_id=4)
$q->items()->create(['product_id' => 2, 'price_id' => 4, 'quantity' => 2]);

// 3. HaaS Price for ARCH (price_id=8)
$q->items()->create(['product_id' => 3, 'price_id' => 8, 'quantity' => 5]);

echo "Created quote: " . $q->id . "\n";
