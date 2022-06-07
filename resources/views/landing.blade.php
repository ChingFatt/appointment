@extends('layouts.simple')

@section('content')
{{ phpinfo() }}
<div class="bg-image" style="background-image: url('/media/photos/photo6@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="hero bg-black-50">
            <div class="hero-inner">
                <div class="content content-full">
                    <div class="row justify-content-center">
                        <div class="col-md-6 py-3 text-center">
                            <div class="push">
                                <h1 class="font-w700 text-white mb-2">
                                    Laravel <span class="text-danger">8</span></span>
                                </h1>
                                <p class="font-size-lg font-w500 text-white-50 mb-4">
                                    Build something amazing!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
