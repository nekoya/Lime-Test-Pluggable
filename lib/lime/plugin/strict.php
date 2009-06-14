<?php
/**
 * Lime Plugin Strict
 *
 * Plugin for lime_test_pluggable.
 * Compare values strict by '===' operator.
 *
 * This plugin provide methods
 * - true
 * - false
 * - iss   (is strict)
 * - isnts (isnt strict)
 *
 * @author     nekoya as Ryo Miyake <ryo.studiom@gmail.com>
 * @copyright  2009 nekoya
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @version    1.0.0
 */
class lime_plugin_strict {
    public function true($t, $expr, $msg = 'expression is true') {
        return $t->ok( $expr === true, $msg );
    }

    public function false($t, $expr, $msg = 'expression is false') {
        return $t->ok( $expr === false, $msg );
    }

    public function iss($t, $got, $expected, $msg) {
        return $t->ok( $got === $expected, $msg );
    }

    public function isnts($t, $got, $expected, $msg) {
        return $t->ok( $got !== $expected, $msg );
    }
}
