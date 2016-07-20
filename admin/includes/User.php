<?php








class User extends Db_object {
    /*Table that this object maps to.*/
    protected static $db_table = "users";


    /* Array we used to iterate over the properties of the class. */
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    
    // Properties or Attributes of the User class.
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/400x400&text=image";

    // Properties that relate to the file specifically.
    public $tmp_path; // tmp path for the image, before we move it. But it is also a flag when we go to save, whether we save user_image into the db.
    public $size;
    public $type;
    
    /*Custom errors*/
    public $errors = array();
    /*Common upload errors*/
    public $upload_errors = array(
        UPLOAD_ERR_OK           => "There is no error",
        UPLOAD_ERR_INI_SIZE     => "The uploaded file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE    => 'The upload file exceeds the MAX_FILE_SIZE directive',
        UPLOAD_ERR_PARTIAL      => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE      => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR   => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE   => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION    => 'A PHP extension stopped the file upload.'
    );
    
    
    
    
    
    
    public function getImage() 
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }
    
    
    
    
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


/**
     * Retrieve a user by their id.
     * @global Database $database
     * @param Integer $id, a user's id.
     * @return User object of the user.
     */
    public static function find_by_id($id)
    {
        global $database;
        $sql = "SELECT * FROM " . static::$db_table
            . " WHERE id = {$database->escape_string($id)} LIMIT 1";

        $result_set = static::find_by_query($sql);
        //var_dump($result_sets);

        return !empty($result_set) ? array_shift($result_set) : new User();
    }


/**
     * Set the name of the file and not the location of where it is.
     * 
     *
     * sets the user object's properties as well.
     *
     * @param $_FILES $file: is the $_FILES superglobal, e.g. $_FILES['user_image'].
     */
    public function set_file($file)
    {

        // error when method was called, no file was passed in.
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        }
        // error flagged.
        elseif($file['errors'] != 0) {
            $this->errors[] = $this->upload_errors_array($file['error']);
            return false;
        }
        // No errors - set properties
        else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }
    
    
    /**
     * Update or create a photo.
     */
    public function save_user_and_image()
    {
        global $session;
        // id already exists - lets update.
        if ($this->id) {
            $this->moveFiles();
            $this->update();
        }
        // id does not already exist.
        else {

            if (!empty($this->errors)) {
                return false;
            }

            if (empty($this->user_image) || empty($this->tmp_path)) {
                $this->errors[] = "the file was not available.";
                return false;
            }
            
            if ($this->moveFiles()) {
                $session->setMessage('Issue with moving user image files over.');    
            }
        }
    }
    
    /**
     * Used to move the tmp file into a permanent storage.
     * @return boolean
     */
    public function moveFiles() 
    {
        // we call this function and it may not actually be prudent to do so, so we are checking if a tmp_path is saved.
        if (!empty($this->tmp_path)) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
            //echo "TaRGET PATH = " . $target_path;
            // because sometimes there is a file already there.
            if (file_exists($target_path)) {
                // Don't move files, just save the user.
                return $this->save();                
            }
        }

        if (move_uploaded_file($this->tmp_path, $target_path)) {
            return $this->save();                           
        }else {
            $this->errors[] = "Moving the file over had an issue - it maybe because you do not have permissions.";
            return false;
        }
    }
            
      
    

    // <----------------------------------------------------
    //              CRUD STUFF
    // <----------------------------------------------------
    
    
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }
    
          
    public function delete()
    {
        global $database;
        $d = self::$db_table;
        $sql = "DELETE FROM " . self::$db_table
            . " WHERE `id` = {$database->escape_string($this->id)} "
            . " LIMIT 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->getConnection())) ? true : false;
    }
    
    
    
    public function create()
    {
        global $database;
        $properties = $this->clean_properties();

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

        $properties = $this->clean_properties();
        $properties_pairs = array();        
        
        // we want to make sure we remove user_image property from the $properties array if we dont even have a tmp_path,
        // because there is nothing new to save for the user_image
        if (empty($this->tmp_path)) {
            unset($properties['user_image']);
        } else {
            unset($this->tmp_path);
        }
        
        foreach ($properties as $key => $value) {
            $properties_pairs[$key] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . self::$db_table. " SET "
                . implode(",", $properties_pairs)
                . " WHERE id = {$database->escape_string($this->id)}";

        $database->query($sql);
        
        $isTrue = (mysqli_affected_rows($database->getConnection()) == 1) ? true : false;
        return $isTrue;
    }


    /**
     * We will save the user's image, through an ajax response (probably edit_user.php > ajax_code.php
     * 
     * @param string $user_image : the string name of the new user's image.     
     */
    public function ajax_save_user_image($user_image) 
    {
        $this->user_image = $user_image;        
        $this->tmp_path = "filler"; // need this so that way in the update() we save the image. It really can be anything other than nothing :-).
        $this->save();
    }
    
    
    
} // End of class User
