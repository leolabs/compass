<?php

class JSON_Input extends CI_Input {
    private static $request_params  = null;

    public function json() {
        if ( !self::$request_params ) {
            $payload    = file_get_contents( 'php://input' );

            if ( is_array( $payload ) ) {
                self::$request_params   = $payload;
            } else if ( ( substr( $payload, 0, 1 ) == "{" ) && ( substr( $payload, ( strlen( $payload ) - 1 ), 1 ) == "}" ) ) {
                self::$request_params   = json_decode( $payload );
            } else {
                parse_str( $payload, self::$request_params );
            }
        }

        return (object) self::$request_params;
    }

    public function post( $index = NULL, $xss_clean = FALSE ) {
        $request_vars   = ( array ) $this->json();
        if ( $index === NULL && !empty( $request_vars ) ) {
            $post       = array();
            foreach( array_keys( $request_vars ) as $key ) {
                $post[$key]  = $this->_fetch_from_array( $request_vars, $key, $xss_clean );
            }
            return $post;
        }
        return $this->_fetch_from_array( $request_vars, $index, $xss_clean );
    }

    public function put( $index = NULL, $xss_clean = FALSE ) {
        $request_vars   = ( array ) $this->json();
        if ( $index === NULL && !empty( $request_vars ) ) {
            $put = array();
            foreach( array_keys( $request_vars ) as $key ) {
                $put[$key]   = $this->_fetch_from_array( $request_vars, $key, $xss_clean );
            }
            return $put;
        }
        return $this->_fetch_from_array( $request_vars, $index, $xss_clean );
    }

    public function delete( $index = NULL, $xss_clean = FALSE ) {
        $request_vars   = ( array ) $this->json();
        if ( $index === NULL && !empty( $request_vars ) ) {
            $delete = array();
            foreach( array_keys( $request_vars ) as $key ) {
                $delete[$key]   = $this->_fetch_from_array( $request_vars, $key, $xss_clean );
            }
            return $delete;
        }
        return $this->_fetch_from_array( $request_vars, $index, $xss_clean );
    }
}