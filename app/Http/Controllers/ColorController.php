<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'hex' => 'required|regex:/^#?[0-9A-Fa-f]{6}$/'
        ]);

        if ($validator->fails()) {
            return $this->failApiResponse($validator->errors(), message: 'Incorrect data');
        }

        $data = new Color;
        $data->name = $request->input('name');
        $data->hex = str_replace('#', '', $request->input('hex'));
        if ($data->save()) {
            return $this->successApiResponse($data, httpCode: 201);
        } else {
            return $this->failApiResponse(message: 'Add record error');
        }

    }

    public function index(): JsonResponse
    {
        $colors = Color::orderBy('name', 'ASC')->get();
        return $this->successApiResponse($colors);
    }

    public function destroy(int $colorId): JsonResponse
    {
        $data = ['id' => $colorId];

        $validator = Validator::make($data, [
            'id' => 'exists:colors',
        ]);

        if ($validator->fails()) {
            return $this->failApiResponse($validator->errors(), 'Incorrect data');
        }

        $color = Color::find($colorId);
        if ($color->delete()) {
            return $this->successApiResponse(message: 'Record has been deleted');
        } else {
            return $this->failApiResponse(message: 'Delete error');
        }
    }
}
