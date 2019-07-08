<?php

namespace App\App\Categories\Actions;

use App\App\Categories\Domain\Services\CategoryIndexService;
use App\App\Categories\Responders\CategoryIndexResponder;

class CategoryIndexAction
{
    protected $service;
    protected $responder;

    public function __construct(CategoryIndexService $service, CategoryIndexResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        return $this->responder->respond(
            $this->service->handle()
        );
    }
}
