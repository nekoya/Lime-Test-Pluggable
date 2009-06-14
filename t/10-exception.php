<?php
require dirname(__FILE__) . '/../lib/lime/pluggable.php';
$t = new lime_test_pluggable();
$t->output = new lime_output_color();

$t->comment('load plugin');
$t->ok( $t->loadPlugins('exception'), 'load exception plugin' );

$t->comment('throws_ok');
$t->throws_ok( array(), 'throw new Exception("hoge");' );
$t->throws_ok( array(), 'throw new Exception("hoge");', 'hoge' );
$t->throws_ok( array(), 'throw new ErrorException("hoge");', 'ErrorException' );
