<?php








class User extends Db_object
{
    /*Table that this object maps to.*/
    protected static $db_table = "users";


    /* Array we used to iterate over the properties of the class. */
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

        $result = self::find_by_query($sql);

        return !empty($result) ? array_shift($result) : false;
    }







    // <----------------------------------------------------
    //              CRUD STUFF
    // <----------------------------------------------------
    public function save()
     {
        return isset($this->id) ? $this->update() : $this->create();
     }


//    public function create()
//    {
//        global $database;
//        $properties = $this->clean_properties();
//
//        $sql = "INSERT INTO " . self::$db_table
//                . " (" . implode(", ", array_keys($properties)) . ") ";
//        $sql .= "VALUES ( '". implode("','", array_values($properties)) . "')";
//
//        // running the query and grabbing the id of the last inserted query.
//        if ($database->query($sql)) {
//            $this->id = $database->the_insert_id();
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//
//    public function update()
//    {
//        global $database;
//
//        $properties = $this->clean_properties();
//        $properties_pairs = array();
//
//        foreach ($properties as $key => $value) {
//            $properties_pairs[$key] = "{$key} = '{$value}'";
//        }
//
//        $sql = "UPDATE " . self::$db_table. " SET "
//                . implode(",", $properties_pairs)
//                . " WHERE id = {$database->escape_string($this->id)}";
//
//        $database->query($sql);
//
//        return (mysqli_affected_rows($database->getConnection()) == 1) ? true : false;
//    }
//
//
//    public function delete()
//    {
//        global $database;
//
//        $sql = "DELETE FROM " . self::$db_table
//            . " WHERE id = {$database->escape_string($this->id)} "
//            . " LIMIT 1";
//
//        $database->query($sql);
//        return (mysqli_affected_rows($database->getConnection())) ? true : false;
//    }

} // End of class User

