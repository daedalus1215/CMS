<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This will handle all our paginations.
 *
 * @author larry
 */
class Paginate 
{
    // The page we are on.
    public $current_page;
    // Essentially our limit.
    public $items_per_page;
    // The total.
    public $items_total_count;
    
    /**
     * 
     * @param int $page - The page we are on.
     * @param int $items_per_page - Essentially our limit.
     * @param int $items_total_count - The total.
     */
    public function __construct($page=1, $items_per_page=4, $items_total_count=0) 
    {
       $this->current_page   = (int) $page;
       $this->items_per_page = (int) $items_per_page;
       $this->items_total_count    = (int) $items_total_count;
    }
    
    
    
}
