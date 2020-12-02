<?php

namespace App\Filters;

class TodoStatus {

	public function handle($request, \Closure $next) {
		$data = $next($request);

		if(request()->has('status') && !empty(request('status'))) {
			$data = $data->where('status', request('status'));
		}

		return $data;
	}
}