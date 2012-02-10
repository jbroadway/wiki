<?php

/**
 * Run the body through the chain of parsing functions.
 */
function wiki_parse_body ($body) {
	return wiki_parse_headers (wiki_parse_html (wiki_parse_links (Markdown ($body))));
}

/**
 * Parse internal links of the form `[[Link name]]`.
 */
function wiki_parse_links ($body) {
	return preg_replace (
		'/\[\[(.+?)\]\]/e',
		'\'<a href="/wiki/\' . str_replace (\' \', \'-\', \'\\1\') . \'">\\1</a>\'',
		$body
	);
}

/**
 * Add class to code blocks for syntax highlighting.
 */
function wiki_parse_html ($body) {
	return str_replace (
		'<pre><code>&lt;',
		'<pre><code class="brush-html">&lt;',
		$body
	);
}

/**
 * Add anchors to headers.
 */
function wiki_parse_headers ($body) {
	return preg_replace (
		'/<h([1-6])>([^<\']+)/e',
		'\'<a name="\' . strtolower (str_replace (\' \', \'-\', \'\\2\')) . \'"></a><h\1>\2\'',
		$body
	);
}

?>