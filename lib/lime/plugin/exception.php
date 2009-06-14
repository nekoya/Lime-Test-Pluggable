<?php
/**
 * Lime Plugin Exception
 *
 * Plugin for lime_test_pluggable.
 * Testing exception based code.
 *
 * This plugin provide methods
 * - throws_ok
 *
 * @author     nekoya as Ryo Miyake <ryo.studiom@gmail.com>
 * @copyright  2009 nekoya
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @version    1.0.0
 */
class lime_plugin_exception {
    public function throws_ok($t, $args, $expr, $expected = null) {
        $func = create_function('$p', $expr);
        try {
            $func($args);
        } catch (Exception $e) {
            if ($expected === null) {
                $t->pass('threw Exception');
            } else if (get_class($e) !== 'Exception') {
                $t->isa_ok( $e, $expected, "threw $expected" );
            } else {
                $t->is( $e->getMessage(), $expected, $expected );
            }
            return $e;
        }
        $t->fail('Exception does not threw');
    }
}
