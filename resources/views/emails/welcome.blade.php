@component('mail::message')
# Thank you

Dear {{ $data['fullname'] }},
<br>
@isset($data['email_body'])
{{ $data['email_body'] }}
@else
@if ($data['status'] == 'Pending')
We have received an appointment you has been made. Please kindly refer to the details below.
@elseif ($data['status'] == 'Scheduled')
Your appointment has been scheduled. Please kindly confirm the details below.
@endif
@endisset
<br>
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

@component('mail::table')
| Info           | Details                 |
| :------------- | :---------------------- |
| Fullname       | {{ $data['fullname'] }} |
| Phone          | {{ $data['phone'] }}    |
| Email          | {{ $data['email'] }}    |
| Date           | {{ $data['date'] }}     |
| Preferred Time | {{ $data['time'] }}     |
| Total Duration | {{ $data['duration'] }} minutes |
| Status         | {{ $data['status'] }}   |
| Outlet         | {{ $outlet['name'] }}   |
| Services       | <ol style="padding:0 15px; margin: 0;">@foreach($services as $service) <li>{{ $service['name'] }}</li> @endforeach</ol>   |
| Preferred Employees | <ol style="padding:0 15px; margin: 0;">@foreach($employees as $employee) <li>{{ $employee['name'] }}</li> @endforeach</ol>   |
@endcomponent

{{ $data['email_footer'] }}
<br>

Best Regards,<br>
Team {{ config('app.name') }}
@isset($data['signature'])
<br>
<img src="{{ $data['signature'] }}">
@endisset
@endcomponent
