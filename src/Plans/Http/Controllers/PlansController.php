<?php

namespace AccessManager\Services\Plans\Http\Controllers;


use AccessManager\Base\Http\Controller\AdminBaseController;
use AccessManager\Services\Plans\Http\Requests\ServicePlanUpdateRequest;
use AccessManager\Services\Plans\Models\ServicePlan;
use AccessManager\Services\Policies\Models\Policy;

/**
 * Class PlansController
 * @package AccessManager\Services\Plans
 */
class PlansController extends AdminBaseController
{
    /**
     * Lists all available plans.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $plans = ServicePlan::paginate(10);
        return view("Plan::index", compact('plans'));
    }

    /**
     * presents form to add new service plan.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $policies = Policy::pluck('name', 'id');
        return view("Plan::add-edit", compact('policies'));
    }

    /**
     * creates new service plan record in database with inputs from user form.
     *
     * @param ServicePlanUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd( ServicePlanUpdateRequest $request )
    {
        try {
            ServicePlan::addNew($request);
            return redirect()->route('plans.index');
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function postDelete()
    {

    }
}