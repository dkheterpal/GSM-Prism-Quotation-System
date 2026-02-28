<?php
$html = file_get_contents(__DIR__ . '/storage/app/public/extracted.html');
$sections = explode('<h1>', $html);
array_shift($sections);

$timelines = [];
foreach ($sections as $section) {
    preg_match('/^(.*?)<\/h1>/', $section, $titleMatch);
    if (!$titleMatch)
        continue;
    $title = trim(strip_tags($titleMatch[1]));

    if (strpos($section, '<h2>Project Timeline</h2>') !== false) {
        $parts = explode('<h2>Project Timeline</h2>', $section);
        preg_match('/<table(.*?)<\/table>/s', $parts[1], $tableMatch);
        if ($tableMatch) {
            $timelines[$title] = $tableMatch[0];
        }
    }
}
file_put_contents('timelines.json', json_encode($timelines, JSON_PRETTY_PRINT));
echo "Saved timelines.json\n";
