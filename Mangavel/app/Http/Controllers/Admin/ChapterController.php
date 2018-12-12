<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzClient;
// use Illuminate\Support\Facades\Input;
use Validator;
use File;

class ChapterController extends Controller
{
	public static $BASE_URI = 'localhost:1234';

	public function index()
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI.'/chapter/agg');
		$data['chapter'] = json_decode($request->getBody());
		return view('admin.chapter.list')->with($data);
	}

	public function add()
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI.'/manga');
		$data['manga'] = json_decode($request->getBody());
    	// dd($data['manga']);
		return view('admin.chapter.add')->with($data);
	}

	public function save(Request $r)
	{
		$dataImage;
		$file = $r->file("image");
		$sendData = $r->input();

		$validator = Validator::make($r->file(), [
			'image.*' => 'image|mimes:jpeg,jpg,png|max:2048'
		]);

		if($validator->fails()){
			return redirect()->back()->withErrors($validator->errors());
		}

		foreach ($r->image as $key=>$value) {
			$dataImage[] = $r->input("manga").Date("YmdHis").str_random(25).$key.".".$value->getClientOriginalExtension();
			$file[$key]->move("img/admin/manga/".$r->input("manga")."/", $dataImage[$key]);
		}
		$sendData = array_add($sendData, 'image', $dataImage);
		$client = new GuzClient();
		$request = $client->post(self::$BASE_URI."/chapter", [
			'form_params' => $sendData
		]);
		$response = json_decode($request->getBody());
		if ($response->status == 200) {
			return redirect()->route('chapter-index');
		}
	}

	public function view($id)
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI."/chapter/manga/".$id);
		$data['data'] = json_decode($request->getBody());
		return view('admin.chapter.detail')->with($data);
	}

	public function edit($id)
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI."/chapter/".$id);
		$data['data'] = json_decode($request->getBody());
		// dd($data);
		return view('admin.chapter.edit')->with($data);
	}

	public function update(Request $r)
	{
		$validator = Validator::make($r->file(), [
			'image.*' => 'image|mimes:jpeg,jpg,png|max:2048'
		]);

		if($validator->fails()){
			return redirect()->back()->withErrors($validator->errors());
		}

		$file = [];
		$image = $r->file('image');
		$nameFile = [];
		$sendData = [
			'judul' => $r->input('judul'),
			'nomor' => $r->input('nomor')
		];
		foreach ($r->input('_idImage') as $key => $value) {
			$client = new GuzClient();
			if(isset($r->file('image')[$key])){
				$nameFile[$key] =  $r->input('idManga').Date("YmdHis").str_random(25).$key.".".$image[$key]->getClientOriginalExtension();
				if(empty($value)) {
					$request = $client->post(self::$BASE_URI.'/image', [
						'form_params' => [
							'chapter' => $r->input('idChapter'),
							'name' => $nameFile[$key],
							'nomor' => $key
						]
					]);
				} else {
					$request = $client->put(self::$BASE_URI.'/image/'.$value, [
						'form_params' => [
							'chapter' => $r->input('idChapter'),
							'name' => $nameFile[$key],
							'nomor' => $key
						]
					]);
					$response = json_decode($request->getBody());
					File::delete("img/admin/manga/".$r->input("idManga")."/".$response->result);

				}
				$image[$key]->move("img/admin/manga/".$r->input("idManga")."/", $nameFile[$key]);
			} else {
				$request = $client->put(self::$BASE_URI.'/image/'.$value, [
					'form_params' => [
						'nomor' => $key
					]
				]);
			}
		}
		$client = new GuzClient();
		$request = $client->put(self::$BASE_URI.'/chapter/'.$r->input('idChapter'), [
			'form_params' => $sendData
		]);
		$response = json_decode($request->getBody());
		if ($response->status == 200) {
			return redirect()->route('chapter-view', $r->input("idManga"));
		}
	}

	public function delete($id)
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI.'/image/chapter/'.$id);
		$res = json_decode($request->getBody());

		foreach ($res->image as $key => $value) {
			$request = $client->delete(self::$BASE_URI.'/image/'.$value->_id);
			$response = json_decode($request->getBody());
			if($response->status == 200) {
				File::delete("img/admin/manga/".$res->chapter->manga.'/'.$value->name);
			}
		}

		$request2 = $client->delete(self::$BASE_URI.'/chapter/'.$id);
		$res2 = json_decode($request2->getBody());
		if ($res2->status == 200) {
			return redirect()->route('chapter-view', $res->chapter->manga);
		}
	}
}
