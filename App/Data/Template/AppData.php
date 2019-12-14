<?php


namespace App\Data\Template;

use Core\SessionInterface;

class AppData
{
    /**
     * @var SessionInterface
     */
    private $session;


    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    /**
     * @param SessionInterface $session
     * @return AppData
     */
    public function setSession(SessionInterface $session): AppData
    {
        $this->session = $session;

        return $this;
    }

    public function isAdmin()
    {
        return in_array('ROLE_ADMIN', $this->session->getUserRoles());
    }
}