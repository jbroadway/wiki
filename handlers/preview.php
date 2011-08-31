<?php

$page->template = 'wiki/preview';
$page->layout = false;

require_once ('apps/wiki/lib/markdown.php');

echo Markdown ($_POST['body']);

?>