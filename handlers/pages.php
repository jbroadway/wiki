<?php

$res = Wiki::query ('id')
	->order ('id asc')
	->fetch_orig ();

if (! $this->internal) {
	$page->title = i18n_get ('All Pages');
}

echo '<p>';
foreach ($res as $pg) {
	printf ('<a href="/wiki/%s">%s</a><br />', $pg->id, str_replace ('-', ' ', $pg->id));
}
echo '</p>';

?>