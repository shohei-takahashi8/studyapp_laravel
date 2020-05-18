<?php

namespace App\Policies;

use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * カテゴリーの閲覧権限
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function view(User $user, Category $category)
    {
        return $user->id == $category->user_id;
    }
}
