<?php
require dirname(__FILE__) . '/../lib/lime/pluggable.php';
$t = new lime_test_pluggable();
$t->output = new lime_output_color();

$t->comment('undefined method called');
try {
    $threw = false;
    $t->none();
} catch (Exception $e) {
    $threw = true;
    $t->is(
        $e->getMessage(),
        "undefined method: none",
        "Exception message is 'undefined method: none'"
    );
}
$t->ok( $threw === true, 'threw Exception' );
