<?php

namespace App\Filters;

class AuthData {

	public function handle($request, \Closure $next) {
		$data = $next($request);

		return $data->where('user_id', 1);
	}
}