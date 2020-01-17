<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
use App\Models\User;
use Response;

/**
 * Base API Controller.
 */
class APIController extends Controller
{
    /**
     * default status code.
     *
     * @var int
     */
    protected $statusCode = 200;


    /**
     * default language.
     *
     * @var string
     */
    protected $lang = 'ar';


    /**
     * get the status code.
     *
     * @return int $statuscode
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * set the status code.
     *
     * @param [type] $statusCode [description]
     *
     * @return int $statuscode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this->statusCode;
    }

    /**
     * Respond.
     *
     * @param string $message
     * @param object $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data)
    {
        $response = [
            'data' => $data
        ];
        return response()->json($response,$this->statusCode);
    }
    /**
     * Respond.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithMessage($message)
    {
        $array = [
            'status' => $this->statusCode,
            'message' => $message
        ];
        return response()->json($array);
    }

    /**
     * Respond with successful delete.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondDeleted()
    {
        $this->setStatusCode(IlluminateResponse::HTTP_NO_CONTENT);

        return $this->respond(null);
    }

    /**
     * respond with pagincation.
     *
     * @param Paginator $items
     * @param array     $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithPagination($items, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $items->total(),
                'total_pages'  => ceil($items->total() / $items->perPage()),
                'current_page' => $items->currentPage(),
                'limit'        => $items->perPage(),
            ],
        ]);

        return $this->respond($data);
    }

    /**
     * Respond Created.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($data)
    {
        $this->setStatusCode(IlluminateResponse::HTTP_CREATED);
        return $this->respond($data);
    }


  /**
     * respond with validation error.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        $error = [
            'status' => $this->statusCode,
            'message' => $message
        ];
        return response()->json($error);
    }

    /**
     * respond with validation error.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithValidationError($message)
    {
        $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST);
        $error = [
            'status' => $this->statusCode,
            'message' => $message
        ];
        return response()->json($error);
    }

    /**
     * responsd not found.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Respond with error.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error')
    {
        $this->setStatusCode(500);
        return $this->respondWithError($message);
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = 'Unauthorized')
    {
        $this->setStatusCode(401);
        return $this->respondWithError($message);
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * Respond with no content.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithNoContent()
    {
        return $this->setStatusCode(204)->respond(null);
    }




}
