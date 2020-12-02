<?php

namespace App\Filters;

class Paginate {

	public function handle($request, \Closure $next) {
		$data = $next($request);

		
		if(request()->has(['paginate', 'per_page']) && request('pagainate') && is_numeric(request('per_page'))) {
			return $data->paginate(request('per_page'));
		}

		return $data->get();
	}
}