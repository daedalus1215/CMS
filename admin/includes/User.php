<?php
class User
{

    public static function find_all_users()
    {
        return self::find_this_query('SELECT * FROM users');
    }


    /**
     * Retrieve a user by their id.
     * @global Database $database
     * @param Integer $id, a user's id.
     * @return Array of an user.
     */
    public static function find_user_by_id($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id LIMIT 1";
        $result_sets = self::find_this_query($sql);
        $found_user = mysqli_fetch_array($result_sets);
        return $found_user;
    }

    /**
     * This method will return query results.
     * @global Database $database
     * @param String $sql
     * @return Array the result in an array.
     */
    public static function find_this_query($sql)
    {
        // execute any query and return it to us.
        global $database;
        $result_set = $database->query($sql);
        return $result_set;
    }

}

