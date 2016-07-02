<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Photo extends Db_object
{
    /*Table that this object maps to.*/
    protected static $db_table = "photo";
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
    public $titlephoto_id;
    public $description;
    public $filename;
    public $type;
    public $size;































}