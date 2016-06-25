<?php


class Database
{
    protected $connection;


    public function __construct()
    {
        $this->open_db_connect();
    }


    public function open_db_connect()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno()) {

            die("DB fail " . mysqli_error());
        }
    }


    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        if (!$result) {
            die("Query Failed");
        }

        return $result;
    }

}
