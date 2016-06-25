<?php
class User
{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;





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

    /**
     *
     * @param Array $the_record is a returned record, a array of the row.
     * @return \self
     */
    public static function instantiation($the_record)
    {
        $the_object               = new self();

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->the_attribute = $value;
            }
        }


        return $the_object;
    }

    /**
     * Check to see if this String matches the object's attribute or property
     * @param String Name of a property this object should have.
     */
    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        array_key_exists($the_attribute, $object_properties);
    }
}

