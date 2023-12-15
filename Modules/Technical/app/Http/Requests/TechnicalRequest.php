<?php

namespace Modules\Technical\app\Http\Requests;

use App\Helpers\ValidationRuleHelper;
use App\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Modules\Auth\Http\Requests\RegisterRequest;

class TechnicalRequest extends RegisterRequest
{
    use HttpResponse;
    public function __construct()
    {
        parent::__construct();
        static::$inUpdate =! preg_match('/.*technicals$/', $this->url());
    }

    public function rules(): array
    {
        $userRequest = (new RegisterRequest())->rules();
        unset($userRequest['type']);
        return array_merge($userRequest,[
            'user_id' => ValidationRuleHelper::foreignKeyRules(['required' => 'sometimes']),
            'category_id' => ValidationRuleHelper::foreignKeyRules(),
            'national_id' => ValidationRuleHelper::phoneRules(),
            'experience_years' => ValidationRuleHelper::integerRules(),
        ]);
    }

}
