@section('form')
    {!! Form::open(['route' => 'admin.operating_hour.store', 'method' => 'post', 'files' => true]) !!}
@endsection

<x-layout.backend>
<div class="content">
    @include('admin.operating_hours.form')
</div>
</x-layout.backend>