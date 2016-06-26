<?php
class Session
{
    /**
     * If the current user is logged in or not.
     * @var boolean
     */
    private $signed_in;
    /**
     * The user's id.
     * @var Integer
     */
    public $user_id;

    function __construct()
    {
        session_start();
    }

    /**
     * Check if we have a saved user_id in the global Session, if not, we will unset the user_id and make sure we
     * set our signed_in boolean to false.
     */
    private function check_the_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }


}

$Session = new Session();