<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryCollection;
use App\Http\Controllers\ApiBaseController;

class CategoryController extends ApiBaseController
{
    public function index(Request $request)  {

        try {
            $auth = auth('sanctum')->user();
            $categories = Category::query();

            if(!is_null($request->keyword)){
                $categories = $categories->where(function ($query) use  ($request) {
                    $query->orWhere('name', 'LIKE', "%$request->keyword%");
                });
            }

            $categories = new CategoryCollection($categories->where('user_id', $auth->id)->orderBy('created_at', 'desc')->paginate($request->limit ? $request->limit : 5));
            return $this->sendResponse($categories, 'Category data getting successfully');
        } catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }



    }

    public function create(Request $request){
        try {

            $auth = auth('sanctum')->user();

            $validate = Validator::make($request->all(),[
                "name" => "required",
            ]);
            if($validate->fails()){
                return $this->sendErrorResponse($validate->errors());
            }

            $category = Category::create([
                'name' => $request->name,
                'user_id' => $auth->id
            ]);

            return $this->sendResponse(null, 'Category created successfully!');
        }  catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    public function update(Request $request, $id){
        try {
            $auth = auth('sanctum')->user();

            $validate = Validator::make($request->all(),[
                "name" => "required",
            ]);
            if($validate->fails()){
                return $this->sendErrorResponse($validate->errors());
            }

            $c = Category::where('id', $id)->first();

            if($auth->id != $c->user_id){
                return $this->sendErrorResponse(null, 'You can not updated!');
            }



            $category = Category::where('id', $id)->update([
                'name' => $request->name,
            ]);

            return $this->sendResponse(null, 'Category updated successfully!');
        }  catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $auth = auth('sanctum')->user();
            $c = Category::where('id', $id)->first();

            if($auth->id != $c->user_id){
                return $this->sendErrorResponse(null, 'You can not delete!');
            }


            $category = Category::find($id)->delete();
            return $this->sendResponse(null,"Category deleted successfully!");

        } catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }
}
