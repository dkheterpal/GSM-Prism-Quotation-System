<?php

$html = file_get_contents(__DIR__ . '/storage/app/public/extracted.html');

$sections = explode('<h1>', $html);
array_shift($sections); // Remove preamble

foreach ($sections as $section) {
    preg_match('/^(.*?)<\/h1>/', $section, $titleMatch);
    if (!$titleMatch)
        continue;
    $title = trim(strip_tags($titleMatch[1]));

    echo "========= TITLE: $title =========\n";

    if (strpos($section, '<h2>Project Timeline</h2>') !== false) {
        $parts = explode('<h2>Project Timeline</h2>', $section);
        $afterTimeline = $parts[1];

        // Find the table
        preg_match('/<table(.*?)<\/table>/s', $afterTimeline, $tableMatch);
        if ($tableMatch) {
            echo "TIMELINE FOUND AND EXTRACTED (Length: " . strlen($tableMatch[0]) . ")\n";
        } else {
            echo "TIMELINE HEADER BUT NO TABLE!\n";
        }
    } else {
        echo "NO TIMELINE.\n";
    }
}
