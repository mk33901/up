<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Asssets;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function apiResponse ($data , $status)
	{
		return response()->json($data,$status);
	}
	public function assets($model,$type,$request)
	{
		try {
			$files = $request[$type];
			if(count($files))
			{
				foreach ($files as $file) {
					$assets = New Asssets();
					$assets->name = $file->name;
					$assets->taggable_type = get_class($model);
					$assets->taggable_id = $model->id;
					$assets->save();
				}
			}
		} catch (\Exception $e) {
			//throw $th;
		}
	}
}
