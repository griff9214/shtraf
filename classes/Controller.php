<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 015 15.03.19
 * Time: 14:49
 */

namespace classes;


class Controller
{
    private $componentCache = [];
    private $definitions = [];

    public function set($id, callable $callback)
    {
        if (!array_key_exists($id, $this->definitions)) {
            $this->definitions[$id] = [
                'callback' => $callback,
                'cached' => false,
            ];
        }
    }

    public function setCached($id, callable $callback)
    {
        if (!array_key_exists($id, $this->definitions)) {
            $this->definitions[$id] = [
                'callback' => $callback,
                'cached' => true,
            ];
        } else {
            $this->definitions[$id]['cached'] = true;
        }
    }

    public function get($id)
    {
        if (isset($this->componentCache[$id])) {
            return $this->componentCache[$id];
        }

        if (!array_key_exists($id, $this->definitions)) {
            throw new \Exception('');
        } else {
            if ($this->definitions[$id]['cached'] == true) {
                $this->componentCache[$id] = call_user_func($this->definitions[$id]['callback']);
                return $this->componentCache[$id];
            } else {
                return call_user_func($this->definitions[$id]['callback']);
            }
        }
    }
}