<?php

namespace visualCaptcha;

class Session {
    private $namespace = '';

    public function __construct( $namespace = 'visualcaptcha' ) {
        $this->namespace = $namespace;
    }

    public function clear() {
		app('session')->put($this->namespace, array());
    }

    public function get( $key ) {
        if ( app('session')->has($this->namespace) == FALSE ) {
            $this->clear();
        }

        if ( app('session')->has("$this->namespace.$key") ) {
            return app('session')->get("$this->namespace.$key");
        }

        return null;
    }

    public function set( $key, $value ) {
        if ( app('session')->has($this->namespace) == FALSE ) {
            $this->clear();
        }
		app('session')->put("$this->namespace.$key", $value);
    }
};

?>