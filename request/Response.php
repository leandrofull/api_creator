<?php
    namespace App\Request;

    class Response {
        private static Response $instance;

        private function __clone() {}

        private function __construct() {}

        public static function getInstance(): self {
            if(!isset(self::$instance)) self::$instance = new self();
            return self::$instance;
        }

        public function json(array $data, int $code = 200): void {
            header("Content-Type: application/json; charset=utf-8");
            http_response_code($code);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit;
        }

        public function success(int $code, string $msg): void {
            $this->json(["message"=>$msg], $code);
        }

        public function error(int $code, string $error): void {
            $this->json(["error"=>$error], $code);
        }

        public function headers(array $headers): self {
            foreach($headers as $key => $value) {
                header("{$key}: {$value}");
            }

            return $this;
        }
    }
?>