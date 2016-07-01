<?php
class User
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');

    // Properties or Attributes of the User class.
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function verify_user($username, $password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table
                . " WHERE username = '$username' "
                . " AND password = '$password' "
                . " LIMIT 1";


        $result = self::find_this_query($sql);

        return !empty($result) ? array_shift($result) : false;
    }


    public static function find_all_users()
    {
        return self::find_this_query("SELECT * FROM " . self::$db_table);
    }


    /**
     * Retrieve a user by their id.
     * @global Database $database
     * @param Integer $id, a user's id.
     * @return User object of the user.
     */
    public static function find_user_by_id($id)
    {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table
            . " WHERE id = {$database->escape_string($id)} LIMIT 1";

        $result_set = self::find_this_query($sql);
        //var_dump($result_sets);

        return !empty($result_set) ? array_shift($result_set) : new User();
    }


    /**
     * This method will return query results.
     * @global Database $database
     * @param String $sql
     * @return \User the result in a User object.
     */
    public static function find_this_query($sql)
    {
        // execute any query and return it to us.
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while($row = mysqli_fetch_assoc($result_set)) {
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }


    /**
     * Instantiates User instance out of the passed in query associated array.
     * @param AssociativeArray $row is a returned record, a array of the row.
     * @return \self $the_object is a User object.
     */
    public static function instantiation($row)
    {
        $the_object = new self();

        foreach ($row as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }


    /**
     * Check to see if this String matches the object's attribute or property
     * @param String $the_attribute of a property this object should have.
     * @return Boolean - whether or not this User object has a property that matches $the_attribute string.
     */
    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }


    protected function properties()
    {

        $properties = array();
        foreach (self::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }

        return $properties;
    }


    // <----------------------------------------------------
    //              CRUD STUFF
    // <----------------------------------------------------
    public function save()
     {
        return isset($this->id) ? $this->update() : $this->create();
     }


    public function create()
    {
        global $database;
        $properties = $this->properties();

        $sql = "INSERT INTO " . self::$db_table
                . " (" . implode(", ", array_keys($properties)) . ") ";
        $sql .= "VALUES ( '". implode("','", array_values($properties)) . "')";

        // running the query and grabbing the id of the last inserted query.
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }


    public function update()
    {
        global $database;

        $properties = $this->properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[$key] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . self::$db_table. " SET "
                . implode(",", $properties_pairs)
                . " WHERE id = {$database->escape_string($this->id)}";
        
        $database->query($sql);

        return (mysqli_affected_rows($database->getConnection()) == 1) ? true : false;
    }


    public function delete()
    {
        global $database;

        $sql = "DELETE FROM " . self::$db_table
            . " WHERE id = {$database->escape_string($this->id)} "
            . " LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->getConnection())) ? true : false;
    }

} // End of class User

