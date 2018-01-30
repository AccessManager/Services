<?php

namespace AccessManager\Services\Plans\Models;


use AccessManager\Base\Models\AdminBaseModel;
use AccessManager\Services\Plans\Http\Requests\ServicePlanUpdateRequest;

/**
 * Class ServicePlanLimit
 * @package AccessManager\Services\Plans
 */
class ServicePlanLimit extends AdminBaseModel
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'service_plan_id', 'time_limit', 'time_unit', 'data_limit', 'data_unit',
        'reset_every', 'reset_every_unit',
    ];

    /**
     * defines relationship with ServicePlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicePlan()
    {
        return $this->belongsTo(ServicePlan::class);
    }

    /**
     * create new service plan using service plan form request.
     *
     * @param ServicePlanUpdateRequest $request
     * @return static
     */
    public static function createFromFormRequest( ServicePlanUpdateRequest $request )
    {
        $limit = new static(
            $request->only('time_limit', 'time_unit', 'data_limit', 'data_unit')
        );

        if( $request->has('reset_every_enabled'))
        {
            $limit->reset_every = $request->reset_every;
            $limit->reset_every_unit = $request->reset_every_unit;
        } else {
            $limit->reset_every = $request->validity;
            $limit->reset_every_unit = $request->validity_unit;
        }

        return $limit;
    }
}