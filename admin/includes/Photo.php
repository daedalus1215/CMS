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
        'photo_id',
        'title',
        'description',
        'filename',
        'type',
        'size'
    );

    public $photo_id;
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
     * Update or create a photo.
     */
    public function save()
    {
        // photo_id already exists - lets update just update.
        if ($this->photo_id) {
            $this->update();
        }
        // photo_id does not already exist.
        else {

            if (!empty($this->errors)) {
                return false;
            }

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



}