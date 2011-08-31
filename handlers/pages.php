<?php

$res = Wiki::query ('id')
	->order ('id asc')
	->fetch_orig ();

echo '<p>';
foreach ($res as $pg) {
	printf ('<a href="/wiki/%s">%s</a><br />', $pg->id, str_replace ('-', ' ', $pg->id));
}
echo '</p>';

?>