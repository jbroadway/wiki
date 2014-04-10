<?php

$this->require_acl ('wiki/delete');

if (! isset ($_POST['page'])) {
	$this->redirect ('/wiki');
}

$lock = new Lock ('Wiki', $_POST['page']);
if ($lock->exists ()) {
	$page->title = __ ('Editing Locked');
	echo $tpl->render ('wiki/locked', $lock->info ());
	return;
}

$wiki = new Wiki ($_POST['page']);
$_POST = array_merge ($_POST, (array) $wiki->orig ());
$_POST['page'] = 'wiki/' . $_POST['page'];

if (! $wiki->remove ()) {
	$page->title = __ ('An Error Occurred');
	echo __ ('Error Message') . ': ' . $wp->error;
	return;
}

$this->hook ('wiki/delete', $_POST);

$page->title = __ ('Page deleted');
printf ('<p><a href="/wiki">%s</a></p>', __ ('Continue'));

?>