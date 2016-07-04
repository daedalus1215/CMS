<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Photo extends Db_object
{
    /*Table that this object maps to.*/
    protected static $db_table = "photos";
    /* Array we used to iterate over the properties of the class. */
    protected static $db_table_fields = array(        
        'title',
        'description',
        'filename',
        'type',
        'size'
    );

    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";

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

    /**
     * Get the name of the file and not the location of where it is.
     * basename() cleans up the path.
     *
     * Set the properties as well.
     *
     * @param $_FILES $file: is the $_FILES superglobal.
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
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }
   
    /**
     * Retrieve upload directory and image name
     * @return String: the path and filename of the picture we need to show.
     */
    public function picture_path() 
    {
        return $this->upload_directory.DS.$this->filename;
    }
    
    
    /**
     * Update or create a photo.
     */
    public function save()
    {
        // id already exists - lets update just update.
        if ($this->id) {
            $this->update();
        }
        // id does not already exist.
        else {

            if (!empty($this->errors)) {
                return false;
            }
//            echo "Photo debug - filename= $this->filename";
//            echo "Photo debug - tmp path= $this->tmp_path";
            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "the file was not available.";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            //echo "TaRGET PATH = " . $target_path;
            // because sometimes there is a file already there.
            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
                else {
                    $this->errors[] = "Moving the file over had an issue - it maybe because you do not have permissions.";
                    return false;
                }
            }
        }
    }

    
    public function delete_photo() 
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
            // delete file from db 
            // delete file from dir            
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }
    
    
    
    
    public function create()
    {
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . self::$db_table
                . " (`" . implode("`,`", array_keys($properties)) . "`) ";
        $sql .= "VALUES ('". implode("','", array_values($properties)) . "')";
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

        return !empty($result_set) ? array_shift($result_set) : new Photo();
    }


}