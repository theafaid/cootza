<?php

namespace Tests\Setup;

use App\App\Advertisements\Domain\Models\Advertisement;
use Facades\Tests\Setup\CategoryFactory;
use Facades\Tests\Setup\UserFactory;

class AdvertisementFactory
{
    protected $preferredSwapWith;
    protected $owner ;
    protected $offersCount = null;

    /**
     * @param $category
     * @return $this
     */
    public function preferredSwapWith($category)
    {
        $this->preferredSwapWith = $category;

        return $this;
    }

    /**
     * @param $user
     * @return $this
     */
    public function ownedBy($user)
    {
        $this->owner = $user;

        return $this;
    }

    /**
     * Create new advertisement in a specific category
     * @param $child
     * @param null $count
     * @return mixed
     */
    public function createIn($child, $count = null)
    {
        return $this->generate($child, $count);
    }

    /**
     * Create new advertisement in random category
     * @param null $count
     * @return mixed
     */
    public function create($count = null)
    {
        return $this->generate(CategoryFactory::createChild(), $count);
    }

    /**
     * @param $child
     * @param null $count
     * @return mixed
     */
    protected function generate($child, $count = null)
    {
        return factory(Advertisement::class, $count)
            ->create([
                'category_id' => $child->id,
                'preferably_swap_with' => $this->preferredSwapWith ?: null,
                'user_id' => $this->getOwner()
            ]);
    }

    /**
     * @return mixed
     */
    protected function getOwner()
    {
        return $this->owner ? $this->owner->id : UserFactory::create();
    }
}
