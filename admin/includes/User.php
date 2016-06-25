<?php
class User
{

    public static function find_all_users()
    {
        global $database;
        $result_set = $database->query('SELECT * FROM users');
        return $result_set;
    }


    /**
     * Retrieve a user by their id.
     * @global Database $database
     * @param Integer $id, a user's id.
     * @return Array of an user.
     */
    public static function find_user_by_id($id)
    {
        global $database;
        $sql = "SELECT * FROM users WHERE id = $id LIMIT 1";
        $result_set = $database->query($sql);
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;
    }

}

