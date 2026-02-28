<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

if (!Product::where('name', 'PRISM TUNL – Gap & Flush')->exists()) {
    $tunl2 = Product::create([
        'name' => 'PRISM TUNL – Gap & Flush',
        'description' => '<p>Sphere Global proposes the deployment of the PRISM TUNL, a purpose-built, intelligent tunnel structure designed for inline vehicle inspection at the Care Line or other end-of-line checkpoints. The solution enables fast, reliable, and consistent capture of high-resolution images and videos of each vehicle as it passes through the tunnel—helping identify potential quality issues before vehicles leave the plant.</p><p>Each TUNL system is customized to meet the operational workflow, vehicle flow, space constraints, and quality control objectives of the installation site. Optional enhancements include an underbody camera module, a Gap & Flush inspection module for panel alignment verification, and accessory features such as air curtains, heated floors, and high-speed doors, which may be added based on plant-specific environmental and operational requirements.</p><p>The TUNL is designed for durability in high-throughput environments and includes all necessary imaging infrastructure and hardware to support high-speed inspections. It also integrates with PRISM’s broader ecosystem, enabling centralized review, analysis, and decision support across multiple facilities.</p>',
        'deliverables' => '<ul><li>Custom-Fabricated TUNL Structure</li><li>High-Speed, High-Resolution Camera Arrays</li><li>Integrated Lighting & Sensors</li><li>Underbody Camera Module (Optional)</li><li>Gap & Flush Inspection Module (Optional)</li><li>Control Panel & PLC Integration</li><li>Infrastructure & Hardware</li><li>Software & Interface Licenses</li><li>Installation and Commissioning</li></ul>',
        'project_timeline' => '<table><thead><tr><th><p>Phase</p></th><th><p>Timeline (Approx.)</p></th><th><p>Key Activities</p></th></tr></thead><tbody><tr><td><p>Project Kickoff</p></td><td><p>Weeks 1–2</p></td><td><p>Site surveys, requirement finalization, detailed planning</p></td></tr><tr><td><p>Fabrication &amp; Assembly</p></td><td><p>Weeks 3–8</p></td><td><p>Structure manufacturing, camera integration, pre-shipment testing</p></td></tr><tr><td><p>Delivery &amp; Installation</p></td><td><p>Weeks 9–12</p></td><td><p>Site delivery, physical install, electrical setup, calibration</p></td></tr><tr><td><p>Testing &amp; Commissioning</p></td><td><p>Weeks 12–14</p></td><td><p>Image capture validation, workflow testing, user signoff</p></td></tr><tr><td><p>Proving Phase &amp; Optimization</p></td><td><p>Weeks 15–20</p></td><td><p>Operational monitoring, system tuning, performance validation</p></td></tr></tbody></table>',
        'image_path' => '/images/products/img_4.png' // Changed from .jpeg to .png here directly
    ]);

    $tunl2->prices()->createMany([
        ['type' => 'Fixed', 'setup_fee' => 0, 'monthly_fee' => 0, 'term_months' => null],
        ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 36],
        ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 60],
    ]);
    echo "Product restored." . PHP_EOL;
} else {
    $tunl2 = Product::where('name', 'PRISM TUNL – Gap & Flush')->first();
    $tunl2->update(['image_path' => '/images/products/img_4.png']);
    echo "Product already exists, image updated." . PHP_EOL;
}
