<?php
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Class ApiController
 */
class ApiController extends BaseController {

    /**
     * @var
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;

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
     *
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function respondCreated($data = array())
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond
        ($data);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondUnauthorized($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)
            ->respondWithError($message);
    }


    /**
     * @param string $message
     * @return mixed
     */
    public function respondBadRequest($message = 'Bad Request!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)
            ->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInternalServerError($message = 'Internal Server
    Error !')
    {
        return $this->setStatusCode
        (IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
    }

    /**
     * @param $message
     * @param array $data
     * @return mixed
     */
    public function respondWithError($message, array $data = array())
    {
        $message = ['message' => $message];
        $data = array_merge($message, $data);

        return Response::json($data, $this->getStatusCode());
    }
}