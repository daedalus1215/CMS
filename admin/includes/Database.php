<?php

class Database
{
    protected $connection;

    public function getConnection()
    {
        return $this->connection;
    }

    public function __construct()
    {
        $this->open_db_connect();
    }


    private function open_db_connect()
    {
        $this->connection = new mysqli(
                                    DB_HOST,
                                    DB_USER,
                                    DB_PASS,
                                    DB_NAME
                                  );

        if ($this->connection->connect_errno) {
            die("Db failed " . $this->connection->connect_error);
        }
    }


    public function query($sql)
    {
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }


    private function confirm_query($result)
    {
        if (!$result) {
            die("Query Failed" . $this->connection->error);
        }
    }

    public function escape_string($string)
    {
        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;
    }

    /**
     * Give us the last id of an insert query.
     * @return Integer - the ID of the last inserted query.
     */
    public function the_insert_id()
    {
        return mysqli_insert_id($this->connection);
    }

}
$database = new Database();