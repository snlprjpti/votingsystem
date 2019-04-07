<?php
/**
 * Created by PhpStorm.
 * User: sunil
 * Date: 4/6/2019
 * Time: 7:54 PM
 */

namespace App\Repository;


use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private $user;


    /**
     * UserRepository constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function findById($id)
    {
        $user = $this->user->find($id);
        return $user;
    }

    public function getAdmin()
    {
        $result = $this->user->where('type','admin')->get();
        return $result;
    }

    public function getOrganizer()
    {
        $result = $this->user->where('type','org')->get();
        return $result;
    }

    public function getVoters()
    {
        $result = $this->user->where('type','voter')->get();
        return $result;
    }
}