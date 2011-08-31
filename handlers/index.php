<?php

$page->layout = 'admin';

if (! User::require_admin ()) {
	$this->redirect ('/admin');
}

if (isset ($this->params[0])) {
	$id = $this->params[0];
} else {
	$this->redirect ('/wiki/Home');
}

require_once ('apps/wiki/lib/markdown.php');
require_once ('apps/wiki/lib/Functions.php');

$title = str_replace ('-', ' ', $id);

$wiki = new Wiki ($id);
if ($wiki->error || (isset ($this->params[1]) && $this->params[1] == 'edit')) {
	$f = new Form ('post', 'wiki/edit');
	if ($f->submit ()) {
		if ($wiki->error) {
			$wiki = new Wiki (array (
				'id' => str_replace (' ', '-', $_POST['id']),
				'body' => $_POST['body']
			));
		} else {
			$wiki->id = str_replace (' ', '-', $_POST['id']);
			$wiki->body = $_POST['body'];
		}
		$wiki->put ();
		Versions::add ($wiki);
		$this->redirect ('/wiki/' . $wiki->id);
	} else {
		$o = new StdClass;
		$o->id = $title;
		$o->body = $wiki->body;
		$o->failed = $f->failed;
		$o = $f->merge_values ($o);

		$page->title = i18n_get ('Edit Page');
		echo $tpl->render ('wiki/edit', $o);
		return;
	}
}

$page->title = $title;

echo $tpl->render ('wiki/index', array (
	'id' => $id,
	'title' => $title,
	'body' => wiki_parse_links (Markdown ($wiki->body))
));

?>