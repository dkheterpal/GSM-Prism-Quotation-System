<?php
$ch = curl_init('http://127.0.0.1:8055/quotes');
$payload = json_encode([
    'customer_name' => 'Test',
    'company_name' => 'Company',
    'items' => [['product_id' => 1, 'price_id' => 1, 'quantity' => 1]]
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "HTTP $httpcode\n$response\n";
curl_close($ch);
