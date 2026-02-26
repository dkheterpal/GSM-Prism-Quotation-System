<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pod = Product::create([
            'name' => 'PRISM POD',
            'description' => 'Sphere Global proposes the deployment of the PRISM POD — a fully enclosed, AI-powered, fixed-camera inspection solution designed to automate and enhance the damage detection process for vehicles at GM yards.',
            'deliverables' => '<ul><li>Custom Engineered POD Structure</li><li>High-Definition Imaging System</li><li>Optional Underbody Camera</li><li>AI Processing Server (On-Premise)</li><li>Secure Image Capture and Storage Infrastructure</li><li>Cloud-Hosted Prism Web Portal License</li><li>On-Site Support Services</li><li>Hybrid Maintenance Plan</li><li>Warranty and SLA Coverage</li></ul>',
            'image_path' => '/images/products/img_3.png'
        ]);

        $pod->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 1, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 60],
        ]);

        $tunl = Product::create([
            'name' => 'PRISM TUNL – Care Line Inspection',
            'description' => 'A purpose-built, intelligent tunnel structure designed for inline vehicle inspection at the Care Line or other end-of-line checkpoints.',
            'deliverables' => '<ul><li>Custom-Fabricated TUNL Structure</li><li>High-Speed, High-Resolution Camera Arrays</li><li>Integrated Lighting & Sensors</li><li>Underbody Camera Module (Optional)</li><li>Gap & Flush Inspection Module (Optional)</li><li>Control Panel & PLC Integration</li><li>Infrastructure & Hardware</li><li>Software & Interface Licenses</li><li>Installation and Commissioning</li></ul>',
            'image_path' => '/images/products/img_4.png'
        ]);

        $tunl->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 1, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 1, 'monthly_fee' => 1, 'term_months' => 60],
            ['type' => 'HaaS', 'setup_fee' => 2, 'monthly_fee' => 2, 'term_months' => 60],
        ]);

        $arch = Product::create([
            'name' => 'PRISM ARCH – Gate Inspection',
            'description' => 'A compact, high-performance inspection structure engineered specifically for Check-In and Check-Out gate applications.',
            'deliverables' => '<ul><li>Custom-Designed PRISM ARCH Structure</li><li>High-Speed, High-Resolution Camera Arrays</li><li>Underbody Camera Module (Optional)</li><li>Integrated Lighting</li><li>All Required Hardware & Infrastructure</li><li>Software Licenses & Interfaces</li><li>Installation Supervision</li></ul>',
            'image_path' => '/images/products/img_5.png'
        ]);

        $arch->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 1, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 1, 'monthly_fee' => 1, 'term_months' => 60],
            ['type' => 'HaaS', 'setup_fee' => 2, 'monthly_fee' => 2, 'term_months' => 60],
        ]);

        $mobile = Product::create([
            'name' => 'PRISM Mobile App',
            'description' => 'A versatile, end-to-end vehicle movement and inspection tracking system designed for seamless use by dealers, road haulers, LSPs, and rail operators.',
            'deliverables' => '<ul><li>Secure User Authentication</li><li>VIN-Driven Workflow</li><li>Location & Time Stamping</li><li>Real-Time Damage Annotation</li><li>Video & Image Capture</li><li>Customizable Inspection Checklists</li><li>Live Alerts & Reporting</li><li>Integration with Prism Ecosystem</li></ul>',
            'image_path' => '/images/products/img_6.png'
        ]);

        $mobile->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 0, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 60],
            ['type' => 'HaaS', 'setup_fee' => 0, 'monthly_fee' => 2, 'term_months' => 60],
        ]);
    }
}
