<?php

namespace App\App\Categories\Responders;

class CategoryIndexResponder
{
    public function respond($categories)
    {
        return response()->json(['data' => $categories], 200);
    }
}
