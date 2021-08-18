<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white mb-4" data-dots="true" data-arrows="true" wire:ignore>
                <div>
                    <img class="img-fluid w-100" src="{{ asset('/images/banner1-1.jpg') }}" alt="">
                </div>
                <div>
                    <img class="img-fluid w-100" src="{{ asset('/images/banner1-1.jpg') }}" alt="">
                </div>
            </div>
        </div>
        @if (session()->has('success'))
        <div class="col-lg-12 col-md-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @elseif (session()->has('error'))
        <div class="col-lg-12 col-md-12">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
        @endif
        <div class="col-lg-8 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Appointment</h3>
                </div>
                <div class="block-content block-content-full">
                    <div>
                        {!! Form::open(['route' => 'appointment.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">*</span> <span class="text-muted">Please fill in the complusory fields.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group required">
                                    <label for="fullname">Full Name</label>
                                    {{ Form::text('fullname', 
                                        old('fullname'), [
                                            'class'             => 'form-control', 
                                            'required'          => true, 
                                            'autocomplete'      => 'off',
                                            'wire:model.lazy'   => 'fullname'
                                        ]
                                    ) }}
                                    @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-group required">
                                    <label for="phone">Phone Number</label>
                                    {{ Form::text('phone', 
                                        null, [
                                            'class'             => 'form-control', 
                                            'required'          => true, 
                                            'autocomplete'      => 'off',
                                            'wire:model.lazy'   => 'phone'
                                        ]
                                    ) }}
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-group required">
                                    <label for="email">Email</label>
                                    {{ Form::email('email', 
                                        null, [
                                            'class'             => 'form-control', 
                                            'required'          => true, 
                                            'autocomplete'      => 'off',
                                            'wire:model.lazy'   => 'email'
                                        ]
                                    ) }}
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    {{ Form::select('gender', [
                                            'Male' => 'Male',
                                            'Female' => 'Female'
                                        ],
                                        null, [
                                            'class'         => 'form-control', 
                                            'required'      => false, 
                                            'placeholder'   => '- Please Select -',
                                            'autocomplete'  => 'off'
                                        ]
                                    ) }}
                                    @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group required" wire:ignore>
                                    <label for="outlet">Outlet</label>
                                    {{ Form::select('outlet_id', 
                                        $outlets, 
                                        null, [
                                            'class'             => 'js-select2 form-control', 
                                            'required'          => true, 
                                            'autocomplete'      => 'off', 
                                            'data-placeholder'  => 'Choose one..',
                                            'placeholder'       => '- Please Select -',
                                            'style'             => 'width: 100%;',
                                            'id'                => 'outlet'
                                        ]
                                    ) }}
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group" wire:ignore>
                                    <label for="employee">Preferred Employee <span class="text-muted small font-weight-light">(Optional)</span></label>
                                    {{ Form::select('employee_id', 
                                        $employees, 
                                        null, [
                                            'class'             => 'js-select2 form-control', 
                                            'required'          => false, 
                                            'autocomplete'      => 'off', 
                                            'data-placeholder'  => 'Choose one..',
                                            'placeholder'       => '- Please Select -',
                                            'style'             => 'width: 100%;',
                                            'id'                => 'employees'
                                        ]
                                    ) }}
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group required" wire:ignore>
                                    {{ Form::hidden('merchant_code', 
                                        $merchant->merchant_code, [
                                            'class'             => 'form-control', 
                                            'required'          => true, 
                                            'autocomplete'      => 'off',
                                        ]
                                    ) }}
                                    <label for="service">Service</label>
                                    {{ Form::select('service_id[]', 
                                        $services, 
                                        null, [
                                            'class'             => 'js-select2 form-control', 
                                            'required'          => true, 
                                            'autocomplete'      => 'off', 
                                            'data-placeholder'  => 'Choose multiple..',
                                            'placeholder'       => '- Please Select -',
                                            'style'             => 'width: 100%;',
                                            'multiple'          => true,
                                            'id'                => 'services',
                                            'wire:model.lazy'   => 'selectedService'
                                        ]
                                    ) }}
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3" id="datepicker">
                                <div class="form-group required">
                                    <label for="date">Appointment Date</label>
                                    <div class="input-group">
                                        <input type="text" class="js-datepicker start form-control" id="date" name="date" data-week-start="1" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" autocomplete="off" readonly="readonly" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="si si-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <div class="form-group required">
                                    <label for="date">Preferred Time</label>
                                    <div class="input-group">
                                        <input type="text" class="time start form-control" id="time" name="time" placeholder="Preferred Time" autocomplete="off" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="si si-clock"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    {{ Form::textarea('comments', 
                                        null, [
                                            'class'             => 'js-maxlength form-control', 
                                            'required'          => false, 
                                            'autocomplete'      => 'off', 
                                            'rows'              => 4, 
                                            'maxlength'         => 255, 
                                            'data-always-show'  => 'true', 
                                            'data-placement'    => 'top'
                                        ]
                                    ) }}
                                    <small class="form-text text-muted">
                                        255 Character Max
                                    </small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-alt-primary {{ ($errors->any()) ? 'disabled' : '' }}" {{ ($errors->any()) ? 'disabled' : '' }}>Book Appointment</button>
                        {{ Form::hidden('duration', $duration ?? 0) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Details</h3>
                </div>
                <div class="block table-responsive block-content p-0" id="duration">
                <table class="table table-borderless table-striped table-vcenter block-table">
                    <tbody>
                        @isset($service_listing)
                        @foreach ($service_listing as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td class="text-muted actions">{!! $service->durations !!}</td>
                        </tr>
                        @endforeach
                        @endisset
                        <tr class="font-weight-bold" style="border-top:2px solid #000;background-color: #efefef;">
                            <td>Total Service Duration:</td>
                            <td>{{ $duration ?? 0 }} minutes</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.addEventListener('updateCalendar', event => {
    //console.log(event);
    resetCalendar();
    One.block('state_toggle', '#datepicker');
    jQuery('.js-datepicker').datepicker({
        startDate: '+1d',
        todayHighlight: false,
        enableOnReadonly: true,
        autoclose: true,
        multidate: false,
        daysOfWeekDisabled: event.detail.daysOfWeekDisabled,
        datesDisabled: []
    }).on('changeDate', function(e) {
        @this.set('selectedDate', [jQuery('#date').val(), jQuery('#outlet').val()]);
    });
})

window.addEventListener('updateTime', event => {
    jQuery('.time').timepicker({
        step: event.detail.picker.interval,
        minTime: event.detail.picker.start_time,
        maxTime: event.detail.picker.end_time,
        forceRoundTime: false,
        disableTimeRanges: event.detail.picker.reserved
    });
})

window.addEventListener('updateEmployee', event => {
    console.log(event.detail.employees);
    jQuery('#employees').select2().val(null).trigger("change");
    jQuery('#employees').html('').select2({data: [{id: '', text: ''}]});
    jQuery('#employees').select2({
        data: event.detail.employees
    });
})

window.addEventListener('updateDuration', event => {
    One.block('state_normal', '#duration');
})

function resetCalendar() {
    One.block('state_toggle', '#datepicker');
    jQuery('.js-datepicker').datepicker('clearDates');
    jQuery('.js-datepicker').datepicker('destroy');
}

jQuery('#outlet').on('change', function (e) {
    var data = jQuery(this).val();
    @this.set('selectedOutlet', data);
});

jQuery('#services').on('change', function (e) {
    var data = jQuery(this).val();
    @this.set('selectedService', data);
    One.block('state_loading', '#duration');
});

jQuery('#time').on('change', function (){
    var data = jQuery(this).val();
});

jQuery("#checkall").click(function(){
    if(jQuery(this).is(':checked')){
        jQuery("#services > option").attr("selected", "selected");
        jQuery("#services").trigger("change");
        //jQuery('#services').select2({disabled:'readonly'});
    } else {
        jQuery("#services > option").removeAttr("selected");
        jQuery("#services").trigger("change");
        //jQuery('#services').select2({disabled:false});
    }
});

// jQuery('.industry-listing').on('click', function(e){
//     e.preventDefault();
//     jQuery('.industry-listing').removeClass('border-success');
// });
</script>
@endpush