<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$expected = [
    'PRISM POD',
    'PRISM TUNL – Damage Detection & Spec Check',
    'PRISM TUNL – Gap & Flush',
    'PRISM ARCH – Gate Inspection',
    'PRISM Mobile App',
    'Technology Architecture',
    'Support, Warranty, and Maintenance Services'
];

foreach ($expected as $e) {
    if (!Product::where('name', $e)->exists()) {
        echo "Missing: $e" . PHP_EOL;
    }
}
echo "Checked all expected products." . PHP_EOL;
