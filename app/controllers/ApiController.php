<?php

/**
 * Class ApiController
 */
class ApiController extends BaseController {

    /**
     * @var
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        // Returns the object for method chaining.
        return $this;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!') {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondUnauthorized($message) {
        return $this->setStatusCode(401)->respondWithError($message);
    }


    /**
     *
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = []) {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message) {
        return Response::json([
            'error' => [
                'message' => $message,
                'statusCode' => $this->getStatusCode()
            ]
        ], $this->getStatusCode());
    }
}