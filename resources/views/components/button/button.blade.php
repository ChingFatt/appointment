<a 
	href="{{ $url ?? 'javascript:void(0)' }}"
	class="btn {{ ($type == 'create') ? '' : 'btn-sm' }} btn-{{ $class }} ml-1"
	data-toggle="tooltip" 
	data-placement="top" 
	title="{{ $title }}"
	id="{{ ($type == 'delete') ? 'delete' : '' }}"
>{!! $icon !!}{{ $text }}</a>