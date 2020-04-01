<?php

namespace Portal\Factories;

use Portal\Controllers\DeleteApplicantController;
use Psr\Container\ContainerInterface;

class DeleteApplicantControllerFactory
{
    /** Invoke method to instantiate DeleteApplicantController object
     * Gets Applicant Model from DIC to pass into returned object.
     *
     * @param ContainerInterface $container
     * @return DeleteApplicantController
     */
    public function __invoke(ContainerInterface $container) : DeleteApplicantController
    {
        $model = $container->get('ApplicantModel');
        return new DeleteApplicantController($model);
    }
}
