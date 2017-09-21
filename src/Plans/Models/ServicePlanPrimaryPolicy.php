<?php

namespace AccessManager\Services\Plans\Models;


use AccessManager\Base\Models\AdminBaseModel;
use AccessManager\Services\Plans\Http\Requests\ServicePlanUpdateRequest;
use AccessManager\Services\Policies\Models\Policy;

/**
 * Class ServicePlanPrimaryPolicy
 * @package AccessManager\Services\Plans
 */
class ServicePlanPrimaryPolicy extends AdminBaseModel
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['service_plan_id', 'min_up', 'min_up_unit', 'min_down', 'min_down_unit',
    'max_up', 'max_up_unit', 'max_down', 'max_down_unit'];

    /**
     * defines relationship with service plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicePlan()
    {
        return $this->belongsTo(ServicePlan::class);
    }

    /**
     * create ServicePlanPrimaryPolicy instance from policy_id provided in ServicePlanUpdateRequest
     *
     * @param ServicePlanUpdateRequest $request
     * @return static
     */
    public static function createFromFormRequest( ServicePlanUpdateRequest $request )
    {
        $policy = Policy::findOrFail($request->policy_id);
        return new static(
            $policy->toArray()
        );
    }
}