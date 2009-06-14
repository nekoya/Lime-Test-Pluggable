<?php
require dirname(__FILE__) . '/../lib/lime/pluggable.php';
$t = new lime_test_pluggable();
$t->output = new lime_output_color();

$t->comment('load plugin');
$t->ok( $t->loadPlugins('strict'), 'load strict plugin' );

$t->comment('true');
$t->true( true, 'true' );

$t->comment('false');
$t->false( false, 'false' );

$t->comment('is strict');
$t->iss( 1, 1, '1 is 1 as strict' );

$t->comment('isnt strict');
$t->isnts( 1, true, '1 isnt true as strict' );
$t->isnts( 1, '1', "1 isnt '1' as strict" );
$t->isnts( '', null, "'' isnt null as strict" );
