<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
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
            'description' => '<p>Sphere Global proposes the deployment of the PRISM POD — a fully enclosed, AI-powered, fixed-camera inspection solution designed to automate and enhance the damage detection process for vehicles at GM yards.</p><p>The PRISM POD consists of a custom-designed smart structure equipped with high-resolution, high-frame-rate imaging systems and GM provided on-premise hardware for AI-powered detection. It captures detailed images of every vehicle — including optional underbody views — as it passes through the structure, identifying visible damages such as dents, scratches, cracks, and scuffs. Where required, manual review or annotation is available to supplement AI-based detection.</p><p>Each POD installation is customized to the operational requirements and process flow of the specific GM yard, taking into account lane widths, lighting conditions, traffic patterns, and vehicle types. The solution is delivered as a turnkey system — inclusive of physical infrastructure, imaging hardware, AI processing equipment, software access, and integration with GM’s broader logistics or claims systems.</p><p>Optional accessories — such as high-speed roll-up doors, air curtains, and heated flooring — can be included to ensure environmental control and imaging consistency in regions with high wind, dust, or low temperatures. These accessories are offered where applicable and based on site-specific needs.</p>',
            'deliverables' => '<ul><li>Custom Engineered POD Structure</li><li>High-Definition Imaging System</li><li>Optional Underbody Camera</li><li>AI Processing Server (On-Premise)</li><li>Secure Image Capture and Storage Infrastructure</li><li>Cloud-Hosted Prism Web Portal License</li><li>On-Site Support Services</li><li>Hybrid Maintenance Plan</li><li>Warranty and SLA Coverage</li></ul>',
            'project_timeline' => '<table><thead><tr><th><p>Phase</p></th><th><p>Timeline (Approx.)</p></th><th><p>Key Activities</p></th></tr></thead><tbody><tr><td><p>Requirements Finalization</p></td><td><p>Week 0–2</p></td><td><p>Site visit, layout analysis, accessory selection, and final specs approval</p></td></tr><tr><td><p>Fabrication &amp; Assembly</p></td><td><p>Week 3–8</p></td><td><p>POD structure fabrication, camera calibration, hardware integration</p></td></tr><tr><td><p>Delivery &amp; Installation</p></td><td><p>Week 9–12</p></td><td><p>Transport to site, physical install, network and power provisioning</p></td></tr><tr><td><p>System Configuration</p></td><td><p>Week 13</p></td><td><p>Calibration, connectivity, data routing, and software configuration</p></td></tr><tr><td><p>Testing &amp; Training</p></td><td><p>Week 14</p></td><td><p>UAT, performance validation, user training</p></td></tr><tr><td><p>Go-Live</p></td><td><p>Week 14</p></td><td><p>Handover to GM operations, monitoring begins</p></td></tr></tbody></table>',
            'image_path' => '/images/products/img_3.png'
        ]);

        $pod->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 1, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 60],
        ]);

        $tunl1 = Product::create([
            'name' => 'PRISM TUNL – Damage Detection & Spec Check',
            'description' => '<p>Sphere Global proposes the deployment of the PRISM TUNL, a purpose-built, intelligent tunnel structure designed for inline vehicle inspection at the Care Line or other end-of-line checkpoints. The solution enables fast, reliable, and consistent capture of high-resolution images and videos of each vehicle as it passes through the tunnel—helping identify potential quality issues before vehicles leave the plant.</p><p>Each TUNL system is customized to meet the operational workflow, vehicle flow, space constraints, and quality control objectives of the installation site. Optional enhancements include an underbody camera module, a Gap & Flush inspection module for panel alignment verification, and accessory features such as air curtains, heated floors, and high-speed doors, which may be added based on plant-specific environmental and operational requirements.</p><p>The TUNL is designed for durability in high-throughput environments and includes all necessary imaging infrastructure and hardware to support high-speed inspections. It also integrates with PRISM’s broader ecosystem, enabling centralized review, analysis, and decision support across multiple facilities.</p>',
            'deliverables' => '<ul><li>Custom-Fabricated TUNL Structure</li><li>High-Speed, High-Resolution Camera Arrays</li><li>Integrated Lighting & Sensors</li><li>Underbody Camera Module (Optional)</li><li>Gap & Flush Inspection Module (Optional)</li><li>Control Panel & PLC Integration</li><li>Infrastructure & Hardware</li><li>Software & Interface Licenses</li><li>Installation and Commissioning</li></ul>',
            'project_timeline' => '<table><thead><tr><th><p>Phase</p></th><th><p>Timeline (Approx.)</p></th><th><p>Key Activities</p></th></tr></thead><tbody><tr><td><p>Project Kickoff</p></td><td><p>Weeks 1–2</p></td><td><p>Site surveys, requirement finalization, detailed planning</p></td></tr><tr><td><p>Fabrication &amp; Assembly</p></td><td><p>Weeks 3–8</p></td><td><p>Structure manufacturing, camera integration, pre-shipment testing</p></td></tr><tr><td><p>Delivery &amp; Installation</p></td><td><p>Weeks 9–12</p></td><td><p>Site delivery, physical install, electrical setup, calibration</p></td></tr><tr><td><p>Testing &amp; Commissioning</p></td><td><p>Weeks 12–14</p></td><td><p>Image capture validation, workflow testing, user signoff</p></td></tr><tr><td><p>Proving Phase &amp; Optimization</p></td><td><p>Weeks 15–20</p></td><td><p>Operational monitoring, system tuning, performance validation</p></td></tr></tbody></table>',
            'image_path' => '/images/products/img_4.png'
        ]);

        $tunl1->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 0, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 36],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 60],
        ]);

        $tunl2 = Product::create([
            'name' => 'PRISM TUNL – Gap & Flush',
            'description' => '<p>Sphere Global proposes the deployment of the PRISM TUNL, a purpose-built, intelligent tunnel structure designed for inline vehicle inspection at the Care Line or other end-of-line checkpoints. The solution enables fast, reliable, and consistent capture of high-resolution images and videos of each vehicle as it passes through the tunnel—helping identify potential quality issues before vehicles leave the plant.</p><p>Each TUNL system is customized to meet the operational workflow, vehicle flow, space constraints, and quality control objectives of the installation site. Optional enhancements include an underbody camera module, a Gap & Flush inspection module for panel alignment verification, and accessory features such as air curtains, heated floors, and high-speed doors, which may be added based on plant-specific environmental and operational requirements.</p><p>The TUNL is designed for durability in high-throughput environments and includes all necessary imaging infrastructure and hardware to support high-speed inspections. It also integrates with PRISM’s broader ecosystem, enabling centralized review, analysis, and decision support across multiple facilities.</p>',
            'deliverables' => '<ul><li>Custom-Fabricated TUNL Structure</li><li>High-Speed, High-Resolution Camera Arrays</li><li>Integrated Lighting & Sensors</li><li>Underbody Camera Module (Optional)</li><li>Gap & Flush Inspection Module (Optional)</li><li>Control Panel & PLC Integration</li><li>Infrastructure & Hardware</li><li>Software & Interface Licenses</li><li>Installation and Commissioning</li></ul>',
            'project_timeline' => '<table><thead><tr><th><p>Phase</p></th><th><p>Timeline (Approx.)</p></th><th><p>Key Activities</p></th></tr></thead><tbody><tr><td><p>Project Kickoff</p></td><td><p>Weeks 1–2</p></td><td><p>Site surveys, requirement finalization, detailed planning</p></td></tr><tr><td><p>Fabrication &amp; Assembly</p></td><td><p>Weeks 3–8</p></td><td><p>Structure manufacturing, camera integration, pre-shipment testing</p></td></tr><tr><td><p>Delivery &amp; Installation</p></td><td><p>Weeks 9–12</p></td><td><p>Site delivery, physical install, electrical setup, calibration</p></td></tr><tr><td><p>Testing &amp; Commissioning</p></td><td><p>Weeks 12–14</p></td><td><p>Image capture validation, workflow testing, user signoff</p></td></tr><tr><td><p>Proving Phase &amp; Optimization</p></td><td><p>Weeks 15–20</p></td><td><p>Operational monitoring, system tuning, performance validation</p></td></tr></tbody></table>',
            'image_path' => '/images/products/img_4.jpeg'
        ]);
        $tunl2->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 0, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 36],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 60],
        ]);

        $arch = Product::create([
            'name' => 'PRISM ARCH – Gate Inspection',
            'description' => '<p>Sphere Global proposes the PRISM ARCH, a compact, high-performance inspection structure engineered specifically for Check-In and Check-Out gate applications—where real estate is limited and vehicle flow is constrained. The ARCH is ideal for inbound/outbound inspection points such as shipping yards, storage depots, and handoff zones between logistics providers.</p><p>The ARCH enables automated image capture as vehicles pass beneath, documenting vehicle condition with minimal disruption to existing flow. Each deployment is customized based on the customer’s location layout, throughput requirements, and inspection objectives. The system is optimized for constrained environments while still offering full image coverage, with optional accessories based on site-specific needs.</p>',
            'deliverables' => '<ul><li>Custom-Designed PRISM ARCH Structure</li><li>High-Speed, High-Resolution Camera Arrays</li><li>Underbody Camera Module (Optional)</li><li>Integrated Lighting</li><li>All Required Hardware & Infrastructure</li><li>Software Licenses & Interfaces</li><li>Installation Supervision</li></ul>',
            'project_timeline' => '<table><thead><tr><th><p>Phase</p></th><th><p>Timeline (Approx.)</p></th><th><p>Key Activities</p></th></tr></thead><tbody><tr><td><p>Project Initiation</p></td><td><p>Weeks 1–2</p></td><td><p>Kickoff, site walkthrough, space and traffic flow analysis</p></td></tr><tr><td><p>Fabrication &amp; Integration</p></td><td><p>Weeks 3–7</p></td><td><p>ARCH frame build, camera installation, and infrastructure prep</p></td></tr><tr><td><p>Delivery &amp; Installation</p></td><td><p>Weeks 8–10</p></td><td><p>Site delivery, on-ground setup, and equipment configuration</p></td></tr><tr><td><p>System Commissioning</p></td><td><p>Weeks 10–12</p></td><td><p>Image capture verification and system testing</p></td></tr><tr><td><p>Operational Go-Live</p></td><td><p>Weeks 13–15</p></td><td><p>Full system use with monitoring and fine-tuning</p></td></tr></tbody></table>',
            'image_path' => '/images/products/img_5.png'
        ]);

        $arch->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 1, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 1, 'monthly_fee' => 1, 'term_months' => 60],
            ['type' => 'HaaS', 'setup_fee' => 2, 'monthly_fee' => 2, 'term_months' => 60],
        ]);

        $mobile = Product::create([
            'name' => 'PRISM Mobile App',
            'description' => '<p>Sphere Global proposes the PRISM Mobile App, a versatile, end-to-end vehicle movement and inspection tracking system designed for seamless use by dealers, road haulers, LSPs, and rail operators throughout the vehicle’s journey—from assembly plant to final dealership handover.</p><p>By scanning the Vehicle Identification Number (VIN) at each stage, users are guided through a customized inspection process that supports compliance, damage recording, and secure chain of custody. The system allows for fully configurable workflows aligned with each OEM’s policies, ensuring that required inspection steps are dynamically displayed based on vehicle status, location, or handoff type.</p>',
            'deliverables' => '<ul><li>Secure User Authentication</li><li>VIN-Driven Workflow</li><li>Location & Time Stamping</li><li>Real-Time Damage Annotation</li><li>Video & Image Capture</li><li>Customizable Inspection Checklists</li><li>Live Alerts & Reporting</li><li>Integration with Prism Ecosystem</li></ul>',
            'project_timeline' => null,
            'image_path' => '/images/products/img_6.png'
        ]);

        $mobile->prices()->createMany([
            ['type' => 'Fixed', 'setup_fee' => 0, 'monthly_fee' => 0, 'term_months' => null],
            ['type' => 'SaaS', 'setup_fee' => 0, 'monthly_fee' => 1, 'term_months' => 60],
            ['type' => 'HaaS', 'setup_fee' => 0, 'monthly_fee' => 2, 'term_months' => 60],
        ]);

        $tech = Product::create([
            'name' => 'Technology Architecture',
            'description' => '<p>The Prism solution is built on a hybrid architecture combining on-premise processing with cloud-based data aggregation and analytics, ensuring maximum flexibility, performance, and scalability for enterprise customers such as General Motors (GM). The architecture supports seamless deployment across a variety of operational footprints, including PRISM POD, TUNL, and ARCH, as well as mobile inspection environments.</p>',
            'deliverables' => '<h2>On-Premise System Components</h2><p>Each Prism installation includes an on-premise system stack responsible for real-time data acquisition, processing, and — where applicable — AI-based damage detection. Key components include:</p><ul><li>High-Resolution Camera Arrays (visible, underbody, and specialty optics as applicable)</li><li>Edge Processing Units for real-time video analysis and inference</li><li>Local Database & Application Server to store, tag, and sync inspection data</li><li>On-Prem AI Engine trained on OEM-specific vehicle imagery for high-accuracy detection</li></ul><p>Hardware infrastructure (servers, networking, power backup, etc.) is to be provisioned by GM at each site.</p><p>Sphere Global licenses and supports the on-premise software component, including AI modules and system application.</p><h2>Cloud-Based Prism Platform</h2><p>All validated media and metadata from on-premise systems are securely synchronized to the Prism Cloud Platform, hosted on AWS infrastructure. Key features of the Prism Cloud solution include:</p><ul><li>Multi-Tenant Architecture: Each enterprise customer operates within their own logically isolated tenant, ensuring data segregation, security, and compliance.</li><li>Customer-Owned Tenancy: GM will retain full ownership of its Prism cloud tenant, with the ability to manage user access, configure retention policies, and audit activity logs.</li><li>Transparent Cost Structure: Cloud infrastructure costs (e.g., compute, storage, backups) are borne by GM and fully visible through standard AWS billing dashboards.</li><li>Data Archival & Backup: Customers may choose to archive historical data to their own cloud storage (e.g., Azure Blob, AWS S3) with automated backup workflows supported.</li></ul><h2>Software Licensing and Updates</h2><p>All Prism software components — including the on-premise application, AI models, and cloud portal — are licensed, maintained, and updated by Sphere Global. Updates include:</p><ul><li>Security patches</li><li>Model retraining and performance tuning</li><li>Feature enhancements</li><li>API version control</li></ul><h2>Integration and Extensibility</h2><p>Prism is designed as an open and extensible platform, capable of integrating with GM’s internal systems as well as third-party tools. This includes:</p><ul><li>Claims & Warranty Systems</li><li>Enterprise Logistics Platforms</li><li>Quality Inspection Tools</li><li>BI & Reporting Dashboards</li></ul><p>The Prism Cloud Platform exposes a robust library of Open REST APIs, allowing secure, role-based integration without additional licensing or professional services fees.</p>',
            'project_timeline' => null,
            'image_path' => '/images/products/img_10.png'
        ]);

        $tech->prices()->createMany([
            ['type' => 'Included', 'setup_fee' => 0, 'monthly_fee' => 0, 'term_months' => null]
        ]);

        $support = Product::create([
            'name' => 'Support, Warranty, and Maintenance Services',
            'description' => '<p>Sphere Global is committed to ensuring continuous, high-performance operation of the Prism solution across all deployment types — including PRISM POD, TUNL, ARCH, and Mobile. Our post-deployment support structure is built on three pillars: Warranty, Support, and Maintenance. Each pillar is designed to deliver maximum uptime, proactive monitoring, and rapid incident response.</p>',
            'deliverables' => '<h2>Warranty</h2><p>Sphere offers an industry-leading 60-month comprehensive warranty covering all hardware and software supplied under this solution. The warranty includes:</p><ul><li>Full repair, replacement, and service coverage</li><li>Minimal downtime assurance with rapid diagnostics and component swap</li><li>Loaner equipment to minimize service disruption during part replacement</li><li>Complete parts and labor support for any system failure not caused by external misuse</li></ul><p>This worry-free warranty provides GM with a performance-guaranteed solution backed by expert support and tangible operational reliability.</p><h2>Support</h2><p>Sphere’s support services are structured to provide priority response, remote troubleshooting, and onsite intervention when required. Our support offering includes but is not limited to:</p><ul><li>Emergency help desk support with response within 4 to 8 business hours</li><li>Remote diagnostics and troubleshooting</li><li>Service calls and parts replacement for covered components</li><li>Loaner hardware availability to minimize operational interruptions</li><li>Limited after-hours support, as needed</li></ul><p>This high-availability support model ensures any potential service-impacting issue is swiftly resolved to maintain GM’s operational continuity.</p><h2>Software License and Updates</h2><p>All Prism software (on-premise and cloud) is provided as a licensed service managed by Sphere Global. The license includes:</p><ul><li>Regular feature enhancements and security patches</li><li>OS and third-party application updates as part of the software lifecycle</li><li>Portal and AI model upgrades delivered remotely and seamlessly</li><li>Failover and recovery assurance to minimize data loss in the event of hardware issues</li></ul><p>GM’s deployed systems will benefit from Sphere’s continuous improvement roadmap, with no additional costs for minor version upgrades and vulnerability patches.</p><h2>Preventive Maintenance</h2><p>Sphere performs structured daily, weekly, and monthly maintenance activities to ensure sustained system health and high accuracy of damage detection. In addition to remote monitoring, on-site preventive maintenance visits will be scheduled and include:</p><ul><li>Cleaning and inspection of all cameras, controllers, and peripherals</li><li>Inspection and testing of dome housings, heaters, and blowers</li><li>Verification of camera focus, positioning, and field-of-view integrity</li><li>Power supply testing, including UPS and battery backup health checks</li><li>Review of software logs, programming settings, and diagnostic alerts</li><li>Functional testing of software operations and data capture integrity</li></ul><p>All maintenance tasks are documented and tracked in a centralized support portal for transparency and audit readiness.</p>',
            'project_timeline' => null,
            'image_path' => null
        ]);

        $support->prices()->createMany([
            ['type' => 'Included', 'setup_fee' => 0, 'monthly_fee' => 0, 'term_months' => null]
        ]);
    }
}
