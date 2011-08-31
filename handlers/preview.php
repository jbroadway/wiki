<?php

$page->template = 'wiki/preview';
$page->layout = false;

require_once ('apps/wiki/lib/markdown.php');
require_once ('apps/wiki/lib/Functions.php');

echo wiki_parse_links (Markdown ($_POST['body']));

?>