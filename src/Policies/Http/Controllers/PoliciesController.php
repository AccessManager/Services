<?php

namespace AccessManager\Services\Policies\Http\Controllers;


use AccessManager\Base\Http\Controller\AdminBaseController;
use AccessManager\Base\Http\Controller\BaseController;
use AccessManager\Services\Policies\Models\Policy;

/**
 * Class PoliciesController
 * @package AccessManager\Services\Policies
 */
class PoliciesController extends AdminBaseController
{
    /**
     * Displays the list of all the existing policies.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $policies = Policy::paginate(10);
        return view("Policy::index", compact('policies'));
    }

    /**
     * represents the form view to add new policy.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        return view("Policy::add-edit");
    }

    /**
     * Adds new policy to database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd()
    {
        $this->saveModelAndNotify( new Policy(request()->all()));
        return redirect()->route('policies.index');
    }

    /**
     * presents the view to edit policy.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit( $id )
    {
        try {
            $policy = Policy::findOrFail($id);
            return view('Policy::add-edit', compact('policy'));
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * handles updating policy record in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit()
    {
        try{
            $policy = Policy::findOrFail(request()->get('id'));
            $policy->fill(request()->all());
            $this->saveModelAndNotify($policy);
            return redirect()->route(static::$redirectRoute);
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