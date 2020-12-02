<?php

namespace App\Filters;

class OrderByDate {

	public function handle($request, \Closure $next) {
		$data = $next($request);

		return $data;

		// return $data->orderBy('created_at', 'desc');
	}
}