<?php

namespace Tests\Setup;

use App\App\Advertisements\Domain\Models\Advertisement;
use App\App\Categories\Domain\Models\Category;

class AdvertisementFactory
{
    public function createNewIn(Category $child, $count = null)
    {
        return factory(Advertisement::class, $count)
                ->create(['category_id' => $child->id]);
    }
}
