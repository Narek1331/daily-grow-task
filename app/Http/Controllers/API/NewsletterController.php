<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\NewsletterService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Resources\NewsletterResource;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    /**
     * Get all newsletters.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $datas = $this->newsletterService->getAll();

        return response()->json([
            'status' => true,
            'data' => NewsletterResource::collection($datas)
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsletterRequest $request)
    {

        $newsletter = $this->newsletterService->store($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Newsletter created successfully.',
            'data' => new NewsletterResource($newsletter),
        ], 201);
    }
}
