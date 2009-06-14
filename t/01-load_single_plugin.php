<?php
require dirname(__FILE__) . '/../lib/lime/pluggable.php';
$t = new lime_test_pluggable();
$t->output = new lime_output_color();

$t->comment('initial condition');
$t->is_deeply($t->listPlugins(), array(), 'no plugin loaded');

$t->comment('load a plugin');
try {
    $threw = false;
    $t->loadPlugins($t);
} catch (Exception $e) {
    $threw = true;
    $t->is(
        $e->getMessage(),
        "plugin name must be string: object",
        "Exception message is 'plugin name must be string: object'"
    );
}
$t->ok( $threw === true, 'threw Exception' );
$t->is_deeply($t->listPlugins(), array(), 'no plugin loaded');

try {
    $threw = false;
    $t->loadPlugins('none');
} catch (Exception $e) {
    $threw = true;
    $t->is(
        $e->getMessage(),
        "class file not found: lime/plugin/none.php",
        "Exception message is 'class file not found: lime/plugin/none.php'"
    );
}
$t->ok( $threw === true, 'threw Exception' );
$t->is_deeply($t->listPlugins(), array(), 'no plugin loaded');

$t->ok( $t->loadPlugins('exception'), 'load exception plugin' );
$t->is_deeply( $t->listPlugins(), array('lime_plugin_exception'), 'exception plugin loaded' );
