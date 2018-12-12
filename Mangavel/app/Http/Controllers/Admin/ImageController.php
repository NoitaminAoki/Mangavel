<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzClient;
use Validator;
use File;

class ImageController extends Controller
{
	public static $BASE_URI = 'localhost:1234';

	public function delete(Request $r)
	{
		$client = new GuzClient();
		$request = $client->delete(self::$BASE_URI.'/image/'.$r->input('_id'));
		$response = json_decode($request->getBody());
		if($response->status == 200) {
			File::delete('img/admin/manga/'.$r->input('idmng').'/'.$response->name);
			return response()->json([
				'status' => 200
			]);
		}
	}
}
