<?php


class Comment extends Db_object
{
    /*Table that this object maps to.*/
    protected static $db_table = "comments";


    /* Array we used to iterate over the properties of the class. */
    protected static $db_table_fields = array('$photo_id', '$author', '$body');
    
    // Properties or Attributes of the User class.
    public $id;
    public $photo_id;    
    public $author;
    public $body;

    
    public static function create_comment($photo_id, $author="John", $body)
    {

        if (!empty($photo_id)       && $photo_id != ""
                && !empty($author)  && $author != ""
                && !empty($body)    && $body != "") {
            $comment            = new Comment();
            $comment->photo_id  = (int) $photo_id;
            $comment->author    = $author;
            $comment->body         = $body;
            
            return $comment;            
        } else {
            return false;
        }
    }
    
    
    
    public static function find_the_comments($photo_id = 0) 
    {
        global $database;
        if ($database instanceof Database) {
            $sql  =  " SELECT * FROM " . self::$db_table . " ";
            $sql .= " WHERE photo_id = {$database->escape_string($photo_id)} ";            
            $database->query($sql);
            return self::find_by_query($sql);
        } 
    }
    
    public function save()
    {
        global $database;        

        $sql = "INSERT INTO " . self::$db_table
                . " (photo_id, author, body) ";
        $sql .= "VALUES ($this->photo_id, '$this->author', '$this->body')";

        // running the query and grabbing the id of the last inserted query.
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }
    


} // End of class User
