<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Enums;

use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;

enum PostStatus: string
{
    case ACTIVE = 'Active';
    case DRAFT = 'Draft';
    case PENDING = 'Pending';
    case EXPIRED = 'Expired';
    case ARCHIVED = 'Archived';

    public function getId()
    {
        return match ($this->value) {
            'Active' => 1,
            'Draft' => 2,
            'Pending' => 3,
            'Expired' => 4,
            'Archived' => 5,
            default => null,
        };
    }

    public function isExpired(Post $post): bool
    {
        if ($post->valid_at->isAfter(now())) {
            return true;
        }
        return false;
    }
}
