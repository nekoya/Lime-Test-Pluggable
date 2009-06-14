<?php
/**
 * Lime Test Pluggable  - added plugin support for lime -
 *
 * lime_test_pluggable based on test framework -lime- for symfony.
 *  - http://trac.symfony-project.org/browser/tools/lime/
 *
 * @author     nekoya as Ryo Miyake <ryo.studiom@gmail.com>
 * @copyright  2009 nekoya
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @version    1.0.0
 */
if (!class_exists('lime_test', false)) {
    require 'lime.php';
}
class lime_test_pluggable extends lime_test {
    protected $plugins = array();

    public function loadPlugins($plugins) {
        if (!is_array($plugins)) {
            $plugins = array($plugins);
        }
        foreach ($plugins as $class) {
            if (empty($class)) continue;
            if (!is_string($class)) {
                throw new Exception("plugin name must be string: " . gettype($class));
            }
            $class = 'lime_plugin_' . $class;
            if (!class_exists($class, false)) {
                $basedir = dirname(dirname(__FILE__));
                $filename = str_replace('_', '/', $class) . '.php';
                $realpath = realpath($basedir . DIRECTORY_SEPARATOR . $filename);
                if (file_exists($realpath)) {
                    require $realpath;
                } else {
                    throw new Exception("class file not found: $filename");
                }
                if (!class_exists($class, false)) {
                    throw new Exception("failed load class: $class");
                }
                array_push($this->plugins, new $class());
            }
        }
        return true;
    }

    public function listPlugins() {
        $list = array();
        foreach ($this->plugins as $plugin) {
            array_push($list, get_class($plugin));
        }
        return $list;
    }

    public function __call($method, $args) {
        array_unshift($args, $this);
        foreach ($this->plugins as $plugin) {
            $func = array($plugin, $method);
            if (is_callable($func)) {
                return call_user_func_array($func, $args);
            }
        }
        throw new Exception("undefined method: $method");
    }
}
