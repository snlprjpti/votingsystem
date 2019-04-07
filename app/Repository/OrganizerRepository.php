<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 4/7/19
 * Time: 3:32 PM
 */

namespace App\Repository;


use App\Candidate;
use App\Post;
use App\User;

class OrganizerRepository
{
    /**
     * @var Post
     */
    private $post;
    /**
     * @var Candidate
     */
    private $candidate;
    /**
     * @var User
     */
    private $user;


    /**
     * OrganizerRepository constructor.
     */
    public function __construct(Post $post, Candidate $candidate, User $user)
    {
        $this->post = $post;
        $this->candidate = $candidate;
        $this->user = $user;
    }


    public function findPostByOrgId($id)
    {
        $result = $this->post->where('organizer_id',$id)->get();
        return $result;
    }

    public function getCandidateByOrgId($id)
    {
        $result = $this->candidate->where('organizer_id',$id)->get();
        return $result;
    }

    public function voterByOrg($id)
    {
        $result = $this->user->where('organizer_id',$id)->get();
        return $result;
    }


    public static function getPostByOrganizer($id)
    {
        $result = Post::where('organizer_id',$id)->get();
        return $result;
    }

    public static function getCandidateByPost($id)
    {
        $result = Candidate::where()
    }

}