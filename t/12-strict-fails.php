<?php
require dirname(__FILE__) . '/../lib/lime/pluggable.php';
$t = new lime_test_pluggable();
$t->output = new lime_output_color();
$t->loadPlugins('strict');

$t->comment('failure tests');

$t->comment('true');
$t->true( 1, "1 === true" );
$t->true( '1', "'1' === true" );

$t->comment('false');
$t->false( 0, "0 === false");
$t->false( '0', "'0' === false");
$t->false( null, "null === false" );

$t->comment('is strict');
$t->iss( 1, '1', "1 === '1'" );
$t->iss( 1, true, "1 === true" );
