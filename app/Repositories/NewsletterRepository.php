<?php

namespace App\Repositories;

use App\Models\Newsletter;

class NewsletterRepository
{
    protected $model;

    /**
     * NewsletterRepository constructor.
     *
     * @param Newsletter $newsletter
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->model = $newsletter;
    }

    /**
     * Get all newsletters.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create a newsletter with specified user IDs.
     *
     * @param array $data     Data for creating the newsletter.
     * @param array $userIds  Array of user IDs to attach to the newsletter.
     * @return Newsletter     The created newsletter instance with attached users.
     */
    public function createWithUsers(array $data)
    {
        $newsletter = $this->model->create($data);
        $newsletter->users()->attach($data['user_ids']);
        
        return $newsletter;
    }
}
