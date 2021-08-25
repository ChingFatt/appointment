@component('mail::message')
# Introduction

Welcome {{ $data['fullname'] }},
<br><br>
We’ve put everything together, so you can start working on your Laravel project as soon as possible! OneUI assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
<br><br>
Feel free to use any examples you like from the full versions to build your own pages. Wish you all the best and happy coding!
<br><br>
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
