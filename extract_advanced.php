<?php
$html = file_get_contents(__DIR__ . '/storage/app/public/extracted.html');
$sections = explode('<h1>', $html);

foreach ($sections as $section) {
    if (strpos($section, 'Technology Architecture') !== false) {
        $parts = explode('<h2>', $section);
        $desc = strip_tags($parts[0], '<p><img>');
        $delivs = "";
        for ($i = 1; $i < count($parts); $i++) {
            $delivs .= '<h2>' . $parts[$i];
        }
        file_put_contents('tech.json', json_encode(['desc' => $desc, 'delivs' => $delivs]));
        echo "Saved tech\n";
    }

    if (strpos($section, 'Support, Warranty, and Maintenance Services') !== false) {
        $parts = explode('<h2>', $section);
        $desc = strip_tags($parts[0], '<p><img>');
        $delivs = "";
        for ($i = 1; $i < count($parts); $i++) {
            $delivs .= '<h2>' . $parts[$i];
        }
        file_put_contents('support.json', json_encode(['desc' => $desc, 'delivs' => $delivs]));
        echo "Saved support\n";
    }
}
