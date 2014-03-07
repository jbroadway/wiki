; <?php

[Wiki]

; This is the title for the wiki in the site navigation.

title = Wiki

; This is the layout to use for the wiki pages.

layout = default

; Whether to include this app in the list of pages
; available to the Tools > Navigation tree.

include_in_nav = On

[Admin]

handler = wiki/index
name = Wiki
install = wiki/install
upgrade = wiki/upgrade
version = 0.9.1-beta
sitemap = "Wiki::sitemap"
search = "Wiki::search"

; */ ?>