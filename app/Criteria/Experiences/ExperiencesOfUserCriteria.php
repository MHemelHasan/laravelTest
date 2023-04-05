<?php
/*
 * File name: ExperiencesOfUserCriteria.php
 * Last modified: 2021.03.23 at 11:47:29
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2021
 */

namespace App\Criteria\Experiences;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ExperiencesOfUserCriteria.
 *
 * @package namespace App\Criteria\Experiences;
 */
class ExperiencesOfUserCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $userId;

    /**
     * ExperiencesOfUserCriteria constructor.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (auth()->check() && auth()->user()->hasRole('provider')) {
            return $model->join('users', 'users.id', '=', 'experiences.user_id')
                ->groupBy('experiences.id')
                ->select('experiences.*')
                ->where('users.id', $this->userId);
        } else {
            return $model;
        }
    }
}
