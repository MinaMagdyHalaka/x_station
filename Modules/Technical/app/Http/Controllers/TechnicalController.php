<?php

namespace Modules\Technical\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Technical\app\Http\Requests\TechnicalRequest;
use Modules\Technical\app\Resources\TechnicalResource;
use Modules\Technical\Services\TechnicalService;

class TechnicalController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly TechnicalService $technicalService)
    {
    }

    public function index()
    {
        return view('technical::index');
    }

    public function store(TechnicalRequest $request)
    {
        $result = $this->technicalService->store($request->validated());
        if (isset($result['errors'])){
            return $this->validationErrorsResponse($result['errors']);
        }

        return $this->createdResponse($result, message: translate_success_message('user','created'));
    }

    public function show($id)
    {
        return view('technical::show');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getCategoryTechnicals($categoryId)
    {
        $result = $this->technicalService->getCategoryTechnicals($categoryId);

        return $this->resourceResponse(TechnicalResource::collection($result));
    }
}
