<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use Exception;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use Illuminate\Support\Facades\Validator;

class ItemController extends ApiBaseController
{
    public function index(Request $request)  {

        try {
            $auth = auth('sanctum')->user();
            $items = Item::query();

            if(!is_null($request->keyword)){
                $items = $items->where(function ($query) use  ($request) {
                    $query->orWhere('title', 'LIKE', "%$request->keyword%");
                });
            }

            if(!is_null($request->category_id)){
                $items = $items->where('category_id', $request->category_id);
            }


            $items = new ItemCollection($items->where('user_id', $auth->id)->orderBy('created_at', 'desc')->paginate($request->limit ? $request->limit : 5));
            return $this->sendResponse($items, 'Item data getting successfully');
        } catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }



    }

    public function create(Request $request){
        try {

            $auth = auth('sanctum')->user();

            $validate = Validator::make($request->all(),[
                "title" => "required",
                "description" => "required",
                "category_id" => "required",
            ]);

            if($validate->fails()){
                return $this->sendErrorResponse($validate->errors());
            }

            $item = Item::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'user_id' => $auth->id
            ]);

            return $this->sendResponse(null, 'Item created successfully!');

        }  catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    public function update(Request $request, $id){
        try {
            $auth = auth('sanctum')->user();

            $validate = Validator::make($request->all(),[
                "title" => "required",
                "description" => "required",
                "category_id" => "required",
            ]);

            if($validate->fails()){
                return $this->sendErrorResponse($validate->errors());
            }

            $i = Item::where('id', $id)->first();

            if($auth->id != $i->user_id){
                return $this->sendErrorResponse(null, 'You can not updated!');
            }



            $item = Item::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);

            return $this->sendResponse(null, 'Item updated successfully!');
        }  catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $auth = auth('sanctum')->user();
            $i = Item::where('id', $id)->first();

            if($auth->id != $i->user_id){
                return $this->sendErrorResponse(null, 'You can not delete!');
            }


            $item = Item::find($id)->delete();
            return $this->sendResponse(null,"Item deleted successfully!");

        } catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }
}
