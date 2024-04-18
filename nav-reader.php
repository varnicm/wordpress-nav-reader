<?php
// Function to fetch the HTML content of a URL
function fetchHTML($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    if(curl_errno($ch)) {
        return false; // If there is an error, return false
    }
    curl_close($ch);
    return $html;
}

// Function to get the first <nav> tag from HTML content
function getFirstNavTag($html) {
    $dom = new DOMDocument();
    @$dom->loadHTML($html); // Use @ to suppress warnings from invalid HTML structures
    $xpath = new DOMXPath($dom);
    $navs = $xpath->query('//nav');

    if ($navs->length > 0) {
        return $dom->saveHTML($navs->item(0));
    }
    return "No <nav> tag found.";
}

// URL of the webpage to scrape
$url = "https://example.com";

// Fetch HTML content
$html = fetchHTML($url);
if ($html) {
    // Get the first <nav> tag
    echo getFirstNavTag($html);
} else {
    echo "Failed to fetch the webpage.";
}
?>
