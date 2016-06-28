<?php
session_start();
class Session
{
    /**
     * If the current user is logged in or not.
     * @var boolean
     */
    private $signed_in = false;
    /**
     * The user's id.
     * @var Integer
     */
    public $user_id;

    function __construct()
    {
        $this->check_the_login();
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



    /**
     * Tells us if we are signed in.
     * @return Boolean $this->signed_in
     */
    public function is_signed_in()
    {
        return $this->signed_in;
    }


    /**
     * Log in a particular user.
     * @param User $user: passed in from the database.
     */
    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    /**
     * Log out the user.
     */
    public function logout()
    {
        print "logged out";
        unset($this->user_id);
        $_SESSION = Array();
        $this->signed_in = false;
    }

}
$session = new Session();
