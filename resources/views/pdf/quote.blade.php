<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Proposal - {{ $quote->quote_number }}</title>
    <style>
        body {
            font-family: "Helvetica", sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
        }

        h1 {
            color: #000000;
            font-size: 24pt;
            margin-bottom: 5px;
            border-bottom: 2px solid #000000;
            padding-bottom: 5px;
        }

        h2 {
            color: #1e293b;
            font-size: 18pt;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        h3 {
            color: #334155;
            font-size: 14pt;
            margin-top: 20px;
        }

        p {
            margin-bottom: 15px;
            text-align: justify;
        }

        ul {
            margin-bottom: 15px;
            margin-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        .page-break {
            page-break-before: always;
        }

        .customer-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .customer-card table {
            width: 100%;
            border: none;
        }

        .customer-card td {
            vertical-align: top;
            padding: 5px;
        }

        .label {
            font-weight: bold;
            color: #64748b;
            font-size: 10pt;
            text-transform: uppercase;
        }

        table.pricing {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        table.pricing th {
            background-color: #000000;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 10pt;
            border: 1px solid #000000;
        }

        table.pricing td {
            border: 1px solid #cbd5e1;
            padding: 10px;
            font-size: 10pt;
        }

        table.pricing tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .product-card {
            padding-top: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ccc;
        }

        .product-img {
            max-width: 300px;
            max-height: 200px;
            display: block;
            margin-top: 15px;
        }

        .timeline-table-wrapper table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 10pt;
        }

        .timeline-table-wrapper th {
            background-color: #f1f5f9;
            color: #1e293b;
            padding: 10px;
            text-align: left;
            border: 1px solid #cbd5e1;
        }

        .timeline-table-wrapper td {
            border: 1px solid #cbd5e1;
            padding: 10px;
        }
    </style>
</head>

<body>

    <!-- Headers and Footers -->
    <htmlpageheader name="common-header">
        <table width="100%" style="border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 5px;">
            <tr>
                <td width="50%" style="text-align: left; vertical-align: bottom;">
                    @if(file_exists(public_path('images/products/image11.png')))
                        <img src="{{ public_path('images/products/image11.png') }}" height="45" />
                    @else
                        <strong>Sphere Global</strong>
                    @endif
                </td>
                <td width="50%" style="text-align: right; vertical-align: bottom;">
                    @if(file_exists(public_path('images/products/image12.png')))
                        <img src="{{ public_path('images/products/image12.png') }}" height="35" />
                    @else
                        <strong>PRISM</strong>
                    @endif
                </td>
            </tr>
        </table>
    </htmlpageheader>

    <htmlpagefooter name="common-footer">
        <table width="100%" style="border-top: 1px solid #ccc; padding-top: 5px; font-size: 9pt;">
            <tr>
                <td width="33%">Sphere Global PRISM &copy; {{ date('Y') }}</td>
                <td width="33%" align="center">Page {PAGENO} of {nbpg}</td>
                <td width="33%" style="text-align: right;">Confidential</td>
            </tr>
        </table>
    </htmlpagefooter>

    <sethtmlpageheader name="common-header" value="on" show-this-page="1" />
    <sethtmlpagefooter name="common-footer" value="on" show-this-page="1" />

    <!-- Cover / Customer Details -->
    <div style="font-family: inherit;">
        <table width="100%">
            <tr>
                <td colspan="2" style="text-align: right;">
                    <p style="font-size: 16pt; margin-top: 40px; font-weight: bold;">Vehicle Inspection Solution</p>
                    <p style="font-size: 14pt; font-weight: bold;">Pre-Proposal</p>
                    <p style="font-size: 12pt; font-weight: bold;">Dated: {{ $quote->created_at->format('F Y') }}</p>
                </td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td width="50%" style="text-align: right; vertical-align: top;">
                    <br><br><br><br>
                    <p style="font-weight: bold; margin-bottom: 5px;">Submitted to</p>
                    @if($quote->company_logo && file_exists(public_path(ltrim($quote->company_logo, '/'))))
                        <p><img src="{{ public_path(ltrim($quote->company_logo, '/')) }}"
                                style="max-width: 150px; max-height: 80px; margin-bottom: 5px;" /></p>
                    @endif

                    @if($quote->company_name)
                        <p style="font-weight: bold; margin: 0;">{{ $quote->company_name }}</p>
                    @endif
                    @if($quote->customer_name)
                        <p style="font-size: 11pt; margin: 0;">c/o {{ $quote->customer_name }}</p>
                    @endif
                    @if($quote->address || $quote->city)
                        <p style="font-size: 10pt; color:#666; margin-top: 5px;">
                            {{ $quote->address }}<br>
                            @if($quote->city){{ $quote->city }}, {{ $quote->state }} {{ $quote->pincode }}@endif
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td width="50%" style="text-align: right; vertical-align: bottom;">
                    <br><br>
                    <p style="font-weight: bold; margin-bottom: 5px;">Submitted by</p>
                    @if(file_exists(public_path('images/products/image11.png')))
                        <p><img src="{{ public_path('images/products/image11.png') }}" width="140"
                                style="margin-bottom: 5px;" /></p>
                    @else
                        <p><strong>Sphere Global</strong></p>
                    @endif
                    <p style="margin: 0;">
                        Somerset, NJ 08902<br>
                        Tel: (732) 357 8600
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- Static Content from Extract -->
    <h1>Proposal Overview</h1>
    <p>Sphere Global – Customized Damage Prevention Solution for {{ $quote->company_name ?: $quote->customer_name }}</p>
    <p>This proposal presents a comprehensive, customized solution developed by Sphere Global to address
        {{ $quote->company_name ?: $quote->customer_name }}’s need for enhanced damage prevention, inspection, and data
        visibility across its
        vehicle logistics ecosystem. The proposed solution leverages Sphere’s advanced PRISM product suite — a family of
        AI-driven, vision-based inspection technologies — specifically tailored to meet operational workflows at key
        handoff points such as production exit, dispatch yards, release gates, and dealerships.
    </p>
    <p>Sphere Global has extensive experience building and deploying intelligent inspection systems for global
        customers, logistics providers, and port operators. The PRISM solution is designed to be modular, scalable, and
        seamlessly integrable into existing systems and infrastructure. With this deployment,
        {{ $quote->company_name ?: $quote->customer_name }} will gain near real-time inspection data, high-resolution
        vehicle imagery, automated
        damage detection, and a centralized portal for holistic oversight and auditing — significantly reducing claims,
        disputes, and downstream operational friction.
    </p>

    <h2>Scope of the Solution</h2>
    <p>The proposed solution can deliver high-resolution, multi-angle vehicle imaging and automated damage detection
        capabilities at each stage of the finished vehicle logistics process. The solution will consist of the following
        integrated PRISM components:</p>
    <ul>
        <li>PRISM POD: A fixed outdoor system for automated inspections in dispatch and storage yards</li>
        <li>PRISM TUNL: An indoor line-mounted solution for image capture at the production exit (Care Line)</li>
        <li>PRISM ARCH: Overhead gate-based capture at vehicle release points</li>
        <li>PRISM Mobile App: A mobile inspection tool for Logistics Service Providers (LSPs) and dealer personnel</li>
        <li>PRISM Portal: A centralized cloud-based platform that aggregates images, video, AI detection logs, and
            inspection history</li>
    </ul>
    <p>The proposed solution can deliver a modular and customizable vehicle inspection platform to support finished
        vehicle logistics operations. The scope includes — but is not limited to — the following capabilities, which
        will be tailored based on specific site conditions, operational workflows, and compliance requirements:</p>
    <ul>
        <li><strong>Comprehensive Vehicle Imaging:</strong> High-resolution image and video capture from multiple angles
            — including underbody imaging where applicable — to establish a visual record of vehicle condition at
            critical transition points.</li>
        <li><strong>AI-Based Damage Detection:</strong> Automated identification and classification of visible defects
            such as scratches, dents, dings, scuffs, and cracks using trained AI vision models, where AI-based detection
            is feasible.</li>
        <li><strong>VIN and Event Metadata Tagging:</strong> Intelligent tagging of inspection records with vehicle
            identifiers (VIN), timestamps, and event-specific metadata, if such data is available or implemented.</li>
        <li><strong>System Integration:</strong> Seamless API-driven integration with enterprise systems, including but
            not limited to claims management, quality assurance, logistics tracking, and operations visibility
            platforms.</li>
        <li><strong>Data Retention & Storage:</strong> Secure retention of all captured media and inspection data for
            the duration specified by policies. Older media assets can be archived to controlled cloud environments
            (e.g., Azure Blob, AWS S3) as needed.</li>
        <li><strong>Security & Access Controls:</strong> Role-based access is enforced across all components of the
            solution. External user access is restricted unless specifically prescribed. Each deployment maintains
            strict data isolation and ensures full control of cloud tenancy and permissions.</li>
        <li><strong>Hardware & Software Customization:</strong> Every deployment — whether POD, TUNL, ARCH, or Mobile —
            includes full-stack customization of on-prem hardware, software, AI models (where applicable), and
            configuration. The solution is delivered as a turnkey system, pre-integrated, calibrated, and tested to
            align with the requirements of each individual site.</li>
    </ul>

    <p>This scope is intended to be flexible and extensible, with additional modules or capabilities deployable in
        future phases or locations based on evolving operational needs and feedback.</p>

    <div class="page-break"></div>

    <!-- Dynamic Products Catalog -->
    @foreach($uniqueProducts as $product)
        @if(!$loop->first)
            <br>
        @endif
        <h1
            style="color: #000000; font-size: 20pt; border-bottom: 1px solid #000000; margin-top: 10px; margin-bottom: 5px; padding-bottom: 2px;">
            {{ $product->name }}
        </h1>
        <div class="product-card"
            style="page-break-inside: avoid; border-bottom: none; padding-top: 5px; padding-bottom: 5px;">
            <div style="margin-bottom: 10px;">{!! $product->description !!}</div>

            @if($product->image_path)
                @php
                    $imgPath = public_path(ltrim($product->image_path, '/'));
                @endphp
                @if(file_exists($imgPath))
                    <div align="center" style="text-align: center; margin-top: 10px; margin-bottom: 10px; width: 100%;">
                        <center>
                            <img src="{{ $imgPath }}" class="product-img" alt="{{ $product->name }}"
                                style="margin: 0 auto; max-width: 350px; display: block;" />
                        </center>
                    </div>
                @endif
            @endif

            @if($product->deliverables)
                @if($product->name !== 'Technology Architecture' && $product->name !== 'Support, Warranty, and Maintenance Services')
                    <h2>Proposed Deliverables</h2>
                @endif
                <div>{!! $product->deliverables !!}</div>
            @endif

            @if(!empty($product->project_timeline))
                <h2>Project Timeline</h2>
                <div class="timeline-table-wrapper">
                    {!! $product->project_timeline !!}
                </div>
            @endif
        </div>
    @endforeach

    <div class="page-break"></div>

    <!-- Pricing Tables -->
    <h1>Hardware Cost & Pricing Models</h1>

    @if($fixedItems->count() > 0)
        <h2>Hardware Cost - Capital</h2>
        <table class="pricing">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Actual Cost (per item)</th>
                    <th>Total Capital Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fixedItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}<br><small>Setup & Configuration Included</small></td>
                        <td align="center">{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price->setup_fee, 2) }}</td>
                        <td><strong>${{ number_format($item->price->setup_fee * $item->quantity, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($saasItems->count() > 0 || $haasItems->count() > 0)
        <h2>Hardware Cost - Lease to Buy</h2>
    @endif

    @if($saasItems->count() > 0)
        <h3>Software as a Service (SaaS)</h3>
        <table class="pricing">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Term</th>
                    <th>Capital / Setup Cost</th>
                    <th>SaaS / Month</th>
                </tr>
            </thead>
            <tbody>
                @foreach($saasItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td align="center">{{ $item->quantity }}</td>
                        <td align="center">{{ $item->price->term_months }} Months</td>
                        <td>${{ number_format($item->price->setup_fee, 2) }}</td>
                        <td><strong>${{ number_format($item->price->monthly_fee, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($haasItems->count() > 0)
        <h3>Hardware as a Service (HaaS)</h3>
        <table class="pricing">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Term</th>
                    <th>HaaS Capital / Setup Cost</th>
                    <th>HaaS / Month</th>
                </tr>
            </thead>
            <tbody>
                @foreach($haasItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td align="center">{{ $item->quantity }}</td>
                        <td align="center">{{ $item->price->term_months }} Months</td>
                        <td>${{ number_format($item->price->setup_fee, 2) }}</td>
                        <td><strong>${{ number_format($item->price->monthly_fee, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="page-break"></div>

    <!-- Assumptions -->
    <h1>Assumptions and Dependencies</h1>
    <ul>
        <li>Customer to provide access to the facility for setup, configuration and day to day operations.</li>
        <li>Customer to provide power and data (sufficient bandwidth).</li>
        <li>Customer to provide foundational base to install solutions.</li>
        <li>Vendor will not be responsible for any structural modifications, changes or construction apart from the
            solution and its related builds.</li>
        <li>Customer to provide VIN number of the vehicle in a real-time basis in a mutually agreed upon format.</li>
        <li>Damages to cameras, structure or any part of the solution caused by accidents or acts of God, will not be
            covered.</li>
    </ul>

</body>

</html>