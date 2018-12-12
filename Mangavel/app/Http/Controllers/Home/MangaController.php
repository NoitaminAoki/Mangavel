<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzClient;

class MangaController extends Controller
{
	public static $BASE_URI = 'localhost:1234';

	public function index()
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI.'/manga');
		$response = json_decode($request->getBody());
		$data['manga'] = $response;
		// foreach ($data['manga'] as $key => $value) {
		// 	if($key > 5) {
		// 		unset($data['manga'][$key]);
		// 	}
		// }
		// dd($data);
		return view('home.index')->with($data);
	}

	public function mangaView($id)
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI."/chapter/manga/".$id);
		$data['data'] = json_decode($request->getBody());
		// dd($data['data']);
		return view('home.manga')->with($data);
	}

	public function chapterRead($id)
	{
		$client = new GuzClient();
		$request = $client->get(self::$BASE_URI."/chapter/".$id);
		$data['data'] = json_decode($request->getBody());
		$request = $client->get(self::$BASE_URI."/chapter/manga/".$data['data']->chapter->manga->_id);
		$data['jumlah'] = count(json_decode($request->getBody())->chapter);
		// dd($data);
		return view('home.read')->with($data);
	}
}
