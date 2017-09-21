<?php

namespace AccessManager\Services\Plans\Http\Requests;


use AccessManager\Constants\Data;
use AccessManager\Constants\Time;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ServicePlanUpdateRequest
 * @package AccessManager\Services\Plans\Http\Requests
 */
class ServicePlanUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name'              =>  ['required', 'unique:service_plans', ],
            'sim_sessions'      =>  ['required', 'integer', ],
            'interim_updates'   =>  ['required', 'integer', ],
            'validity'          =>  ['required', 'integer', ],
            'validity_unit'     =>  ['required', Rule::in(Time::TIME_DURATION_UNITS), ],
            'price'             =>  ['required', 'integer', ],
            'policy_id'         =>  ['required_with:primary_policy_enabled'],
            'time_limit'        =>  ['required_with:time_limit_enabled', 'integer', ],
            'time_unit'         =>  ['required_with:time_limit_enabled', Rule::in(Time::TIME_LIMIT_UNITS), ],
            'data_limit'        =>  ['required_with:data_limit_enabled', 'integer', ],
            'data_unit'         =>  ['required_with:data_limit_enabled', Rule::in(Data::DATA_LIMIT_UNITS), ],
            'aq_policy_id'      =>  ['required_with:aq_policy_enabled'],
        ];
    }

}