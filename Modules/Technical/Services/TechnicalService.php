<?php

namespace Modules\Technical\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Category\Service\categoryService;
use Modules\Technical\app\Models\Technical;

class TechnicalService
{
    public Technical $technicalModel;
    public User $userModel;
    public function __construct()
    {
        $this->technicalModel = new Technical();
        $this->userModel = new User();
    }

    public function store($data)
    {
        $errors = [];
        $user = null;

        (new categoryService())->categoryExists($data['category_id'], $errors);
        if ($errors){
            return ['errors' => $errors];
        }

        DB::transaction(function () use ($data, &$user){
            $user = $this->userModel::create($data + ['type' => 'technical']);
            $technical = $this->technicalModel;
            $technical->forceFill([
                'user_id' => $user->id,
                'category_id' => $data['category_id'],
                'national_id' => $data['national_id'],
                'experience_years' => $data['experience_years'],
            ]);
            $technical->save();
        });
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $user->token = $token;
        return $user;
    }

    public function getCategoryTechnicals($categoryId)
    {
        return $this->technicalModel::where('category_id', $categoryId)->with('user')->get();
    }

}
