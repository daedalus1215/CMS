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
    
    
    /**
     * Go to next set of items (next page)
     * @return int - the page we want to go to
     */
    public function next() 
    {
        return $this->current_page + 1;
    }
    
    
    /**
     * Go to last set of items (next page)
     * @return int - the page we want to go to
     */
    public function previous() 
    {
        return $this->current_page - 1;
    }
    
    /**
     * 
     * @return int $total_pages - are the total amount of pages we will 
     * have for all the items we are throwing at the Paginator.
     */
    public function page_total()
    {
        $total_pages = (int) ceiling($this->items_total_count / $this->items_per_page);
        return $total_pages;
    }
    
}
