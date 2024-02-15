<?php

namespace App\Services;

use App\Repositories\NewsletterRepository;
use GuzzleHttp\Client;
use App\Services\SmscService;

class NewsletterService
{
    protected $newsletterRepository;
    protected $smscService;

    /**
     * NewsletterService constructor.
     *
     * @param NewsletterRepository $newsletterRepository The repository for newsletters.
     * @param SmscService $smscService The service for smsc.
     */
    public function __construct(
        NewsletterRepository $newsletterRepository,
        SmscService $smscService,
        )
    {
        $this->newsletterRepository = $newsletterRepository;
        $this->smscService = $smscService;
    }

    /**
     * Create a new newsletter.
     *
     * @param array $data The data for creating the newsletter.
     *
     * @return mixed The created newsletter.
     */
    public function store(array $data)
    {

        $newsletter = $this->newsletterRepository->createWithUsers($data);
        
        if($data['type'] == 'now'){
            foreach($newsletter->users as $user){
                $this->smscService->sendMessage($newsletter['text'],$user['phone_number']);
            }
        }

        return $newsletter;
    }

    /**
     * Get all newsletter.
     *
     * @param array|null $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(?array $filters = null)
    {
        return $this->newsletterRepository->all();
    }
}
