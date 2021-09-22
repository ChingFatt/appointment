<div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">{{ str_replace('Controller', '', class_basename(Route::current()->controller)) }}</h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                @php 
                    $url = '';
                    $segments = '';
                @endphp
                @foreach (Request::segments() as $segment)
                    @php
                        $segments .= '/'.$segment;
                        $url = $segments;
                        $segment = $segment;
                    @endphp
                    @if ($loop->first)
                        @php
                            $url = route('admin.dashboard.index');
                            $segment = 'dashboard';
                        @endphp
                    @elseif ($loop->iteration >= 3)
                        @php
                            $route = Route::currentRouteAction();
                        @endphp
                        @if ($loop->last)
                            @php
                                $segment = substr($route, strpos($route, '@') + 1);
                            @endphp
                        @else
                            @php
                                $segment = 'Show';
                            @endphp
                        @endif
                    @endif
                    <li class="breadcrumb-item text-muted">
                        {{ ucfirst($segment) }}
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>