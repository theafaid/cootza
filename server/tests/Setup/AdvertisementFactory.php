<?php

namespace Tests\Setup;

use App\App\Advertisements\Domain\Models\Advertisement;
use Facades\Tests\Setup\CategoryFactory;

class AdvertisementFactory
{
    protected $preferredSwapWith;

    public function preferredSwapWith($category)
    {
        $this->preferredSwapWith = $category;

        return $this;
    }

    public function createIn($child, $count = null)
    {
        return $this->generate($child, $count);
    }

    public function create($count = null)
    {
        return $this->generate(CategoryFactory::createChild(), $count);
    }

    protected function generate($child, $count = null)
    {
        return factory(Advertisement::class, $count)
            ->create([
                'category_id' => $child->id,
                'preferably_swap_with' => $this->preferredSwapWith ?: null
            ]);
    }
}
