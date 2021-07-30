<div>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="form-group">
                <label for="industry">Industry</label>
                {{ Form::select('industry_id', 
                    $industries, 
                    null, [
                        'class'             => 'form-control', 
                        'required'          => true, 
                        'autocomplete'      => 'off', 
                        'data-placeholder'  => 'Choose one..',
                        'placeholder'       => '- Please Select -',
                        'style'             => 'width: 100%;',
                        'wire:model'        => 'selectedIndustry'
                    ]
                ) }}
            </div>
        </div>
        @if (!is_null($selectedIndustry))
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="merchant">Merchant</label>
                    {{ Form::select('merchant_id', 
                        $merchants, 
                        null, [
                            'class'             => 'form-control', 
                            'required'          => true, 
                            'autocomplete'      => 'off', 
                            'data-placeholder'  => 'Choose one..',
                            'placeholder'       => '- Please Select -',
                            'style'             => 'width: 100%;',
                            'wire:model'        => 'selectedMerchant'
                        ]
                    ) }}
                </div>
            </div>
        @endif
        @if (!is_null($selectedMerchant))
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="service">Service</label>
                    {{ Form::select('service_id', 
                        $services, 
                        null, [
                            'class'             => 'form-control', 
                            'required'          => true, 
                            'autocomplete'      => 'off', 
                            'data-placeholder'  => 'Choose one..',
                            'placeholder'       => '- Please Select -',
                            'style'             => 'width: 100%;',
                            'wire:model'        => 'selectedService'
                        ]
                    ) }}
                </div>
            </div>
        @endif
        @if (!is_null($selectedService))
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="outlet">Outlet</label>
                    {{ Form::select('outlet_id', 
                        $outlets, 
                        null, [
                            'class'             => 'form-control', 
                            'required'          => true, 
                            'autocomplete'      => 'off', 
                            'data-placeholder'  => 'Choose one..',
                            'placeholder'       => '- Please Select -',
                            'style'             => 'width: 100%;',
                            'wire:model'        => 'selectedOutlet'
                        ]
                    ) }}
                </div>
            </div>
        @endif
        @if (!is_null($selectedOutlet))
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="employee">Preferred Employee <span class="text-muted small font-weight-light">(Optional)</span></label>
                    {{ Form::select('employee_id', 
                        $employees, 
                        null, [
                            'class'             => 'form-control', 
                            'required'          => false, 
                            'autocomplete'      => 'off', 
                            'data-placeholder'  => 'Choose one..',
                            'placeholder'       => '- Please Select -',
                            'style'             => 'width: 100%;'
                        ]
                    ) }}
                </div>
            </div>
        @endif
        <div class="col-md-12 col-lg-6" id="datepicker">
            <div class="form-group">
                <label for="date">Appointment Date</label>
                <div class="input-group">
                    <input type="text" class="js-datepicker start form-control" id="date" name="date" data-week-start="1" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" autocomplete="off">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="si si-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>