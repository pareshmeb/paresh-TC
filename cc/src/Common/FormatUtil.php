<?php
declare(strict_types=1);
namespace App\Common;

class FormatUtil
{
    /**
     * Add response header to response
     * @param object $resposne 
     * @param string $status
     * @return object
     */
    public function addHeader(object $response, string $status = null): object
    {       
        $responseWithJson = $response->withHeader('Content-Type', 'application/json;charset=utf-8');
        if (isset($status)) {
            $responseWithJson->withStatus($status);
        } else {
            $responseWithJson->withStatus(200);
        }
        return $responseWithJson;            
    }
    
    /**
     * Convert to json and add header
     * @param object $response
     * @param object | array $data
     * @param string $status
     * @return object
     */
    public function withJson(object $response, $data, string $status = null): object
    {
        $this->addData($response, $data);
        return $this->addHeader($response, $status);
    }
    
    /**
     * Write json data to response body
     * @param object $response
     * @param object | array $data
     */
    public function addData(object $response, $data): void
    {
        // Ensure that the json encoding passed successfully
        if ($data === false) {
            throw new \RuntimeException(json_last_error_msg(), json_last_error());
        }

        $response->getBody()->write(json_encode($data));
    }
    /**
     * Parse request post body
     * @param object $request 
     * @return array
     */
    public function parseRequestData(object $request): array
    {
        //return json_decode(str_replace(array('\n','\t'), '', $request->getBody()->getContents()));
        return json_decode($request->getBody()->getContents(), true);
    }
}

