<?php

namespace WeeWorxxSDK\SharedResources\Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use WeeWorxxSDK\SharedResources\Modules\Post\DTO\PostSearchCriteria;
use WeeWorxxSDK\SharedResources\Modules\Post\Search\PostSearch;

class PostSearchController extends Controller
{
	public function __construct(protected PostSearch $search)
	{

	}

	public function search(Request $request)
	{
		$searchCriteria = new PostSearchCriteria(
			$request->input('q'),
			company: $request->input('company'),
			location: $request->input('location'),
			empType: $request->input('empType'),
			salary: $request->input('salary'),
			benefits: $request->input('benefits'),
			skills: $request->input('skills'),
			test: $request->input('test'),
		);

		return $this->search->search($searchCriteria);
	}
}
