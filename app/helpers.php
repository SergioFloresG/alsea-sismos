<?php
if (!function_exists('response_json')) {
    /**
     * @param mixed $data The response data
     * @param int   $status The response status code
     */
    function response_json($data, $status = 200)
    {
        $response = $data;
        if ($data instanceof Throwable) {
            $response = [
                'message' => $data->getMessage(),
                'code'    => $data->getCode(),
                'http'    => $status
            ];

            if ($data instanceof \App\Exception\HttpException) {
                $response['http'] = $data->getCode();
                $status = $data->getCode();
            }

        }
        (new \Symfony\Component\HttpFoundation\JsonResponse($response, $status))->send();
    }
}
