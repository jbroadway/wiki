<?php

function wiki_parse_links ($body) {
	return preg_replace (
		'/\[\[(.+)\]\]/e',
		'\'<a href="/wiki/\' . str_replace (\' \', \'-\', \'\\1\') . \'">\\1</a>\'',
		$body
	);
}

?>