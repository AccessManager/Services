<?php

namespace AccessManager\Services\Policies\Models;


use AccessManager\Base\Models\AdminBaseModel;

/**
 * Class Policy
 * @package AccessManager\Services\Policies
 */
class Policy extends AdminBaseModel
{
    /**
     * customise table name for the model.
     *
     * @var string
     */
    protected $table = 'bw_policies';

    /**
     * since we donot have created_at, updated_at fields in the tables,
     * so timestamps property needs to be set to false.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * define the table properties.
     *
     * @var array
     */
    protected $fillable = ['name', 'min_up', 'min_up_unit', 'min_down', 'min_down_unit',
                        'max_up', 'max_up_unit', 'max_down', 'max_down_unit'];
}