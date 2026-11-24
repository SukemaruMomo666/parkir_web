<?php
$lines = file("resources/views/search.blade.php");
// Line 16 is index 15. We want up to line 669 (index 668).
$length = 669 - 16 + 1; // 654 lines
$extracted = array_slice($lines, 15, $length);
$content = "@props(['isAuthenticated' => false])\n\n" . implode("", $extracted);
file_put_contents("resources/views/components/parking-discovery.blade.php", $content);
echo "Extraction successful.\n";
