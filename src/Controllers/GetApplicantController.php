<?php

namespace Portal\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Portal\Models\ApplicantModel;

class GetApplicantController
{
    private $applicantModel;

    /**
     * GetApplicantController constructor.
     *
     * @param ApplicantModel $applicantModel
     */
    public function __construct(ApplicantModel $applicantModel)
    {
        $this->applicantModel = $applicantModel;
    }

    /**
     * Takes id from the get request and if id is valid returns relevant applicant
     * else returns 404
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        if (is_numeric($id) && !empty($id)) {
            $applicant = $this->applicantModel->getApplicantById($id);
            $response->getBody()->write(json_encode($applicant));
            return $response;
        } else {
            return $response->withStatus(404);
        }
    }
}
