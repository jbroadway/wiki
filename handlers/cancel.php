<?php

/**
 * Cancel handler for edit forms. Unlocks the object
 * if there was a lock held on it, then forwards to
 * the specified return location.
 */

$this->require_acl ('wiki/edit');

// unlock cancelled object
$lock = new Lock ('Wiki', $_GET['id']);
$lock->remove ();

$this->redirect ($_GET['return']);

?>