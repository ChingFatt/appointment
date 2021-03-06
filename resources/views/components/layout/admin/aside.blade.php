<aside id="side-overlay">
    <div class="content-header border-bottom">
        <a class="img-link mr-1" href="javascript:void(0)">
            <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
        </a>
        <div class="ml-2">
            <a class="text-dark font-w600 font-size-sm" href="javascript:void(0)">{{ Auth::user()->name }}</a>
        </div>
        <a class="ml-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
            <i class="fa fa-fw fa-times"></i>
        </a>
    </div>
    <div class="content-side">
        <div class="block block-transparent pull-x pull-t">
            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#so-overview">
                        <i class="fa fa-fw fa-calendar-alt text-gray mr-1"></i> {{ $title }}
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#so-sales">
                        <i class="fa fa-fw fa-chart-line text-gray mr-1"></i> Sales
                    </a>
                </li> --}}
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane pull-x fade fade-left show active" id="so-overview" role="tabpanel">
                    <div class="block">
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-size-sm font-w600 text-uppercase">{{ $label }}</span>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="text-muted">{{ $indicator }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="nav-items mb-0">
                                {{ $content }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>