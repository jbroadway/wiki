<?php

$page->layout = 'admin';

if (! User::require_admin ()) {
	header ('Location: /admin');
	exit;
}

$cur = $this->installed ('wiki', $appconf['Admin']['version']);

if ($cur === true) {
	$page->title = 'Already installed';
	echo '<p><a href="/">Home</a></p>';
	return;
} elseif ($cur !== false) {
	header ('Location: /' . $appconf['Admin']['upgrade']);
	exit;
}

$page->title = 'Installing app: wiki';

$error = false;
$sqldata = sql_split (file_get_contents ('apps/wiki/conf/install_' . conf ('Database', 'driver') . '.sql'));
foreach ($sqldata as $sql) {
	if (! db_execute ($sql)) {
		$error = db_error ();
		echo '<p class="notice">Error: ' . db_error () . '</p>';
		break;
	}
}

if ($error) {
	echo '<p class="notice">Error: ' . $error . '</p>';
	echo '<p>Install failed.</p>';
	return;
}

echo '<p>Done.</p>';

$this->mark_installed ('wiki', $appconf['Admin']['version']);

?>