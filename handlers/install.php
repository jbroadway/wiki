<?php

$page->layout = 'admin';

$this->require_admin ();

$cur = $this->installed ('wiki', $appconf['Admin']['version']);

if ($cur === true) {
	$page->title = __ ('Already installed');
	echo '<p><a href="/wiki/index">' . __ ('Home') . '</a></p>';
	return;
} elseif ($cur !== false) {
	header ('Location: /' . $appconf['Admin']['upgrade']);
	exit;
}

$page->title = __ ('Installing App') . ': ' . __ ('Wiki');

if (ELEFANT_VERSION < '1.1.0') {
	$driver = conf ('Database', 'driver');
} else {
	$conn = conf ('Database', 'master');
	$driver = $conn['driver'];
}

$error = false;
$sqldata = sql_split (file_get_contents ('apps/wiki/conf/install_' . $driver . '.sql'));
foreach ($sqldata as $sql) {
	if (! DB::execute ($sql)) {
		$error = DB::error ();
		echo '<p class="notice">' . __ ('Error') . ': ' . DB::error () . '</p>';
		break;
	}
}

if ($error) {
	echo '<p class="notice">' . __ ('Error') . ': ' . $error . '</p>';
	echo '<p>' . __ ('Install failed.') . '</p>';
	return;
}

echo '<p><a href="/wiki/index">' . __ ('Done.') . '</p>';

$this->mark_installed ('wiki', $appconf['Admin']['version']);

?>