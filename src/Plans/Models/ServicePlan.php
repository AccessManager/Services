<?php

namespace AccessManager\Services\Plans\Models;


use AccessManager\Base\Models\AdminBaseModel;
use AccessManager\Services\Interfaces\ContainsSubscriptionServicesInterface;
use AccessManager\Services\Plans\Http\Requests\ServicePlanUpdateRequest;
use Illuminate\Support\Facades\DB;
use AccessManager\Prepaid\Models\Voucher;

class ServicePlan extends AdminBaseModel implements ContainsSubscriptionServicesInterface
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'sim_sessions', 'interim_updates',
        'validity', 'validity_unit', 'price'];

    /**
     * defines relationships with primary policy for service plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function primaryPolicy()
    {
        return $this->hasOne(ServicePlanPrimaryPolicy::class);
    }

    /**
     * defines relationships with limits for service plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function limits()
    {
        return $this->hasOne(ServicePlanLimit::class);
    }

    /**
     * defines relationships with after quota policy for service plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aqPolicy()
    {
        return $this->hasOne(ServicePlanAqPolicy::class);
    }

    /**
     * creates new service plan from ServicePlanUpdateRequest.
     *
     * @param ServicePlanUpdateRequest $request
     */
    public static function addNew( ServicePlanUpdateRequest $request )
    {
        DB::transaction(function() use($request){
            $plan = static::createFromFormRequest( $request );
            if( $request->has('primary_policy_enabled'))
            {
                $primaryPolicy = ServicePlanPrimaryPolicy::createFromFormRequest($request);
                $plan->primaryPolicy()->save($primaryPolicy);
            }
            if( $request->has('time_limit_enabled') || $request->has('data_limit_enabled') )
            {
                $servicePlanLimit = ServicePlanLimit::createFromFormRequest($request);

                $plan->limits()->save($servicePlanLimit);

                if( $request->has('aq_policy_enabled') )
                {
                    $aqPolicy = ServicePlanAqPolicy::createFromFormRequest( $request );
                    $plan->aqPolicy()->save($aqPolicy);
                }
            }
        });
    }

    /**
     * creates new service plan from form request.
     *
     * @param ServicePlanUpdateRequest $request
     * @return static
     */
    public static function createFromFormRequest( ServicePlanUpdateRequest $request )
    {
        $plan = new static(
            $request->only('name', 'sim_sessions', 'interim_updates', 'validity', 'validity_unit', 'price')
        );
        $plan->saveOrFail();
        return $plan;
    }

    /**
     * Generates new prepaid voucher from service plan object.
     *
     * @return Voucher
     */
    public function generateVoucher()
    {
        $voucher = Voucher::generateSingle($this);
        $voucher->load('limits', 'primaryPolicy', 'aqPolicy');
        return $voucher;
    }
}