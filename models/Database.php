<?php
    namespace App\Models;

    use App\Request\Response;

    abstract class Database {
        private static \PDO $connection;

        private static function connect(): void {
            $dsn = getenv('DATABASE_DRIVER').":dbname=".getenv('DATABASE_NAME');
            $dsn .= ";host=".getenv('DATABASE_HOST');
            $user = getenv('DATABASE_USER');
            $password = getenv('DATABASE_PASS');

            for($i=0;$i<3;$i++) {
                try {
                    self::$connection = new \PDO($dsn, $user, $password);
                    return;
                } catch(\PDOException $e) {
                    continue;
                }
            }

            Response::getInstance()->error(500, "Internal Server Error!");
        }

        private static function execute(\PDOStatement $sttm): void {
            try {
                if(!$sttm->execute()) {
                    Response::getInstance()->error(500, "Internal Server Error!");
                }
            } catch(\PDOException $e) {
                Response::getInstance()->error(500, "Internal Server Error!");
            }
        }

        protected static function prepare(string $sql): \PDOStatement {
            if(!isset(self::$connection)) self::connect();
            return self::$connection->prepare($sql);
        }

        protected static function createOrFail(\PDOStatement $sttm): int {
            self::execute($sttm);
            return self::$connection->lastInsertId();
        }

        protected static function updateOrFail(\PDOStatement $sttm): bool {
            self::execute($sttm);
            return true;
        }

        protected static function findOne(\PDOStatement $sttm): \stdClass|false {
            self::execute($sttm);
    
            $result = $sttm->fetch(\PDO::FETCH_OBJ);

            if($sttm->rowCount() > 0) {
                return $result;
            }

            return false;
        }

        protected static function findMany(\PDOStatement $sttm): array|false {
            self::execute($sttm);
    
            $result = $sttm->fetchAll(\PDO::FETCH_OBJ);

            if($sttm->rowCount() > 0) {
                return $result;
            }

            return false;
        }
    }
?>