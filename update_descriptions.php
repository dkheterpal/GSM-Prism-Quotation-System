<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

Product::where('name', 'Like', '%PRISM POD%')->update([
    'description' => '<p>Sphere Global proposes the deployment of the PRISM POD — a fully enclosed, AI-powered, fixed-camera inspection solution designed to automate and enhance the damage detection process for vehicles at GM yards.</p><p>The PRISM POD consists of a custom-designed smart structure equipped with high-resolution, high-frame-rate imaging systems and GM provided on-premise hardware for AI-powered detection. It captures detailed images of every vehicle — including optional underbody views — as it passes through the structure, identifying visible damages such as dents, scratches, cracks, and scuffs. Where required, manual review or annotation is available to supplement AI-based detection.</p><p>Each POD installation is customized to the operational requirements and process flow of the specific GM yard, taking into account lane widths, lighting conditions, traffic patterns, and vehicle types. The solution is delivered as a turnkey system — inclusive of physical infrastructure, imaging hardware, AI processing equipment, software access, and integration with GM’s broader logistics or claims systems.</p><p>Optional accessories — such as high-speed roll-up doors, air curtains, and heated flooring — can be included to ensure environmental control and imaging consistency in regions with high wind, dust, or low temperatures. These accessories are offered where applicable and based on site-specific needs.</p>'
]);

Product::where('name', 'Like', '%Damage Detection%')->update([
    'description' => '<p>Sphere Global proposes the deployment of the PRISM TUNL, a purpose-built, intelligent tunnel structure designed for inline vehicle inspection at the Care Line or other end-of-line checkpoints. The solution enables fast, reliable, and consistent capture of high-resolution images and videos of each vehicle as it passes through the tunnel—helping identify potential quality issues before vehicles leave the plant.</p><p>Each TUNL system is customized to meet the operational workflow, vehicle flow, space constraints, and quality control objectives of the installation site. Optional enhancements include an underbody camera module, a Gap & Flush inspection module for panel alignment verification, and accessory features such as air curtains, heated floors, and high-speed doors, which may be added based on plant-specific environmental and operational requirements.</p><p>The TUNL is designed for durability in high-throughput environments and includes all necessary imaging infrastructure and hardware to support high-speed inspections. It also integrates with PRISM’s broader ecosystem, enabling centralized review, analysis, and decision support across multiple facilities.</p>'
]);

Product::where('name', 'Like', '%Gap & Flush%')->update([
    'description' => '<p>Sphere Global proposes the deployment of the PRISM TUNL, a purpose-built, intelligent tunnel structure designed for inline vehicle inspection at the Care Line or other end-of-line checkpoints. The solution enables fast, reliable, and consistent capture of high-resolution images and videos of each vehicle as it passes through the tunnel—helping identify potential quality issues before vehicles leave the plant.</p><p>Each TUNL system is customized to meet the operational workflow, vehicle flow, space constraints, and quality control objectives of the installation site. Optional enhancements include an underbody camera module, a Gap & Flush inspection module for panel alignment verification, and accessory features such as air curtains, heated floors, and high-speed doors, which may be added based on plant-specific environmental and operational requirements.</p><p>The TUNL is designed for durability in high-throughput environments and includes all necessary imaging infrastructure and hardware to support high-speed inspections. It also integrates with PRISM’s broader ecosystem, enabling centralized review, analysis, and decision support across multiple facilities.</p>'
]);

Product::where('name', 'Like', '%ARCH%')->update([
    'description' => '<p>Sphere Global proposes the PRISM ARCH, a compact, high-performance inspection structure engineered specifically for Check-In and Check-Out gate applications—where real estate is limited and vehicle flow is constrained. The ARCH is ideal for inbound/outbound inspection points such as shipping yards, storage depots, and handoff zones between logistics providers.</p><p>The ARCH enables automated image capture as vehicles pass beneath, documenting vehicle condition with minimal disruption to existing flow. Each deployment is customized based on the customer’s location layout, throughput requirements, and inspection objectives. The system is optimized for constrained environments while still offering full image coverage, with optional accessories based on site-specific needs.</p>'
]);

Product::where('name', 'Like', '%Mobile App%')->update([
    'description' => '<p>Sphere Global proposes the PRISM Mobile App, a versatile, end-to-end vehicle movement and inspection tracking system designed for seamless use by dealers, road haulers, LSPs, and rail operators throughout the vehicle’s journey—from assembly plant to final dealership handover.</p><p>By scanning the Vehicle Identification Number (VIN) at each stage, users are guided through a customized inspection process that supports compliance, damage recording, and secure chain of custody. The system allows for fully configurable workflows aligned with each OEM’s policies, ensuring that required inspection steps are dynamically displayed based on vehicle status, location, or handoff type.</p>'
]);

Product::where('name', 'Like', '%Technology%')->update([
    'description' => '<p>The Prism solution is built on a hybrid architecture combining on-premise processing with cloud-based data aggregation and analytics, ensuring maximum flexibility, performance, and scalability for enterprise customers such as General Motors (GM). The architecture supports seamless deployment across a variety of operational footprints, including PRISM POD, TUNL, and ARCH, as well as mobile inspection environments.</p>'
]);

Product::where('name', 'Like', '%Support, Warranty%')->update([
    'description' => '<p>Sphere Global is committed to ensuring continuous, high-performance operation of the Prism solution across all deployment types — including PRISM POD, TUNL, ARCH, and Mobile. Our post-deployment support structure is built on three pillars: Warranty, Support, and Maintenance. Each pillar is designed to deliver maximum uptime, proactive monitoring, and rapid incident response.</p>'
]);

echo "Done updating scopes.\n";
