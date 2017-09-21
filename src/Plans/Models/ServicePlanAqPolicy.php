<?php

namespace AccessManager\Services\Plans\Models;


use AccessManager\Base\Models\AdminBaseModel;
use AccessManager\Services\Plans\Http\Requests\ServicePlanUpdateRequest;
use AccessManager\Services\Policies\Models\Policy;

/**
 * Class ServicePlanAqPolicy
 * @package AccessManager\Services\Plans
 */
class ServicePlanAqPolicy extends AdminBaseModel
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['service_plan_limit_id', 'min_up', 'min_up_unit', 'min_down', 'min_down_unit',
        'max_up', 'max_up_unit', 'max_down', 'max_down_unit'];

    /**
     * defines inverse relationship with service plan for this aq policy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicePlan()
    {
        return $this->belongsTo(ServicePlan::class);
    }

    /**
     * creates new instance of ServicePlanAqPolicy
     * using aq_policy_id provided in ServicePlanUpdateRequest
     *
     * @param ServicePlanUpdateRequest $request
     * @return static
     */
    public static function createFromFormRequest( ServicePlanUpdateRequest $request )
    {
        $policy = Policy::findOrFail($request->aq_policy_id);
        return new static(
            $policy->toArray()
        );
    }
}