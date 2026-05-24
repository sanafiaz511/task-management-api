<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->user_id || $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->user_id || $user->role === 'admin';
    }
}