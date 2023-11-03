<?php
    namespace App\Request;

    class Request {
        private static Request $instance;
        private string $requestURI;
        private \stdClass $requestParams;
        private string $requestMethod;
        private ?\stdClass $requestBody;

        private function __clone() {}

        private function __construct() {
            $this->requestURI = strtolower($_SERVER['REQUEST_URI']);
            $this->requestURI = substr($this->requestURI, -1)=="/" ?
                                substr($this->requestURI, 0, -1) :
                                $this->requestURI;

            $this->requestParams = new \stdClass();

            $this->requestMethod = $_SERVER["REQUEST_METHOD"];

            $this->requestBody = json_decode(file_get_contents("php://input"));
        }

        public static function getInstance(): self {
            if(!isset(self::$instance)) self::$instance = new self();
            return self::$instance;
        }

        public function uri(): string {
            return $this->requestURI;
        }

        public function params(): \stdClass {
            return $this->requestParams;
        }

        public function setParam(string $key, string $value): void {
            $this->requestParams->{$key} = $value;
        }

        public function method(): string {
            return $this->requestMethod;
        }

        public function body(): ?\stdClass {
            return $this->requestBody;
        }
    }
?>