<?php


class Comment extends Db_object
{
    /*Table that this object maps to.*/
    protected static $db_table = "comments";


    /* Array we used to iterate over the properties of the class. */
    protected static $db_table_fields = array('$id', '$photo_id', '$author', '$body');
    
    // Properties or Attributes of the User class.
    public $id;
    public $photo_id;    
    public $author;
    public $body;

    
    public static function create_comment($photo_id, $author="John", $body)
    {
        $photo_id = trim(htmlspecialchars($photo_id));
        $author = trim(htmlspecialchars($author));
        $body = trim(htmlspecialchars($body));
        
        if (!empty($photo_id)       && $photo_id != ""
                && !empty($author)  && $author != ""
                && !empty($body)    && $body != "") {
            $comment            = new Comment();
            $comment->photo_id  = (int) $photo_id;
            $comment->author    = $author;
            $body->body         = $body;
            
            return $comment;            
        } else {
            return false;
        }
    }
    
    
    
    public static function find_the_comments($photo_id = 0) 
    {
        global $database;
        if ($database instanceof Database) {
            $sql  =  "SELECT * " . self::$db_table . " ";
            $sql .= "WHERE photo_id = {$photo_id} ";
            $sql .= "ORDER BY photo_id ASC";
            $database->query($database->escape_string($sql));
        } 
    }
    


} // End of class User
