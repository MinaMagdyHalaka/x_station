<?php

namespace Modules\Auth\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public User $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function show(): Model|Builder|User
    {
        return $this->userModel::whereId(Auth::user()->id)->first();
    }

    public function update(array $data): bool
    {
        $user = $this->show();
        $user->update($data);

        return true;
    }
}
