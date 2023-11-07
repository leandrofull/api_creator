<?php
    namespace App\Request;

    require_once REQUEST_PATH."/Request.php";
    require_once REQUEST_PATH."/Response.php";

    class Route {
        private static function add(string $mt, string $ep, array $ct): void {
            $request = Request::getInstance();

            if($request->method() != $mt) return;
    
            $pattern = preg_replace("/\:[a-z0-9]+/", "[a-z0-9]+", str_replace('/', '\/', $ep));
    
            if(preg_match("/^$pattern$/", $request->uri())) {
                $uri = explode("/", substr($request->uri(), 1));
                $ep = explode("/", substr($ep, 1));
    
                $count = count($uri);
                for($i=0;$i<$count;$i++) {
                    if(preg_match("/\:[a-z0-9]+/", $ep[$i])) {
                        $request->setParam(substr($ep[$i], 1), $uri[$i]);
                    }
                }
    
                require_once CONTROLLERS_PATH."/".$ct[0].".php";
                $obj = new ("App\\Controllers\\".$ct[0])();
                $obj->{$ct[1]}($request, Response::getInstance());
                exit;
            }
        }

        public static function get(string $ep, array $ct): void {
            self::add('GET', $ep, $ct);
        }

        public static function post(string $ep, array $ct): void {
            self::add('POST', $ep, $ct);
        }

        public static function put(string $ep, array $ct): void {
            self::add('PUT', $ep, $ct);
        }

        public static function default(\Closure $cb): void {
            $cb(Response::getInstance());
            exit;
        }
    }
?>