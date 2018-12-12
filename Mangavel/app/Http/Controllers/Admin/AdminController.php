<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzClient;
use File;
use Validator;

class AdminController extends Controller
{
	public static $BASE_URI = 'localhost:1234';

	public function index()
	{
		return view('admin.index');
	}

	public function mangaIndex()
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI.'/manga');
		$response = json_decode($request->getBody());
		$data['manga'] = $response;
		return view('admin.manga.list')->with($data);
	}

	public function mangaAdd()
	{
		return view('admin.manga.add');
	}

	public function mangaSave(Request $r)
	{
		$file = $r->file('image');
		$filename = str_random(50).".".$file->getClientOriginalExtension();
		$r['image'] = $filename;

		$validator = Validator::make($r->file(), [
			'image' => 'image|mimes:jpeg,jpg,png|max:2048'
		]);

		if($validator->fails())
			return redirect()->back()->withErrors($validator->errors());
		else
			$file->move("img/admin/manga/", $filename);

		$client = new GuzClient();
		$request = $client->post(self::$BASE_URI.'/manga', [
			'form_params' => $r->input()
		]);
		$response = json_decode($request->getBody());
		if ($response->status == 200) {
			return redirect()->route('manga-index');
		}
	}

	public function mangaEdit($id)
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI.'/manga/'.$id);
		$data['manga'] = json_decode($request->getBody());
		return view('admin.manga.edit')->with($data);
	}

	public function mangaUpdate(Request $r, $id)
	{
		$dataManga = $r->except('old_image');
		if($r->hasFile('image')) {
			$file = $r->file('image');
			$filename = str_random(50).".".$file->getClientOriginalExtension();
			$dataManga['image'] = $filename;

			$validator = Validator::make($r->file(), [
				'image' => 'image|mimes:jpeg,jpg,png|max:2048'
			]);

			if($validator->fails()) {
				return redirect()->back()->withErrors($validator->errors());
			} else {
				File::delete('img/admin/manga/'.$r->old_image);
				$file->move("img/admin/manga/", $filename);
			}
		}
		$client = new GuzClient();
		$request = $client->put(self::$BASE_URI.'/manga/'.$id, [
			'form_params' => $dataManga
		]);
		$response = json_decode($request->getBody());
		if($response->status == 200)
			return redirect()->route('manga-index');
	}

	public function mangaDelete($id)
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI.'/manga/'.$id);
		$data = json_decode($request->getBody());
		File::delete('img/admin/manga/'.$data->image);
		$client = new GuzClient();
		$request = $client->delete(self::$BASE_URI.'/manga/'.$id);
		$response = json_decode($request->getBody());
		if($response->status == 200)
			return redirect()->route('manga-index');
	}
}
