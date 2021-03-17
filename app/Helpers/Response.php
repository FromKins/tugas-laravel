<?php


function showResponseSuccess($data, $success_response = 'Data Found', $success_code = 200)
{

    $output['meta'] = [
        'code' => 200,
        'message' => 'No data available',
    ];

    $output['data'] = isset($data['data']) ? $data['data'] : $data;

    if($data instanceof \Countable){
        if(count($data) > 0){
            if (is_object($data))
                $data = $data->toArray();

            $output['meta'] = [
                'code' => $success_code,
                'message' => $success_response,
            ];

            $output['data'] = isset($data['data']) ? $data['data'] : $data;

            if (isset($data['data']))
                $output['pagination'] = array_except($data, 'data');

        }
    }else if(!is_object($data)){
        $output['meta'] = [
            'code' => $success_code,
            'message' => $success_response,
        ];

        $output['data'] = isset($data['data']) ? $data['data'] : $data;

    }

    return response()->json($output, $output['meta']['code']);

}

function showResponseError($code = '', $message = '', $message_array = [], $echo = false)
{
    switch ($code) {
        case 400:
            $httpMessage = 'Bad Request';
            break;

        case 401:
            $httpMessage = 'Unauthorized';
            break;

        case 403:
            $httpMessage = 'Forbidden';
            break;

        case 404:
            $httpMessage = 'Not Found';
            break;

        case 405:
            $httpMessage = 'Method Not Allowed';
            break;

        case 422:
            $httpMessage = 'Unprocessable Entity';
            break;

        case 500:
            $httpMessage = 'Internal Server Error';
            break;

        default:
            $httpMessage = 'Internal server error';
            break;
    }

    $output['meta']=[
        'code'=>$code,
        'message'=> empty($message) ? $httpMessage : $message,
        'message_array' => $message_array
    ];

    if ($echo) {
        return json_encode($output);
    }

    return response()->json($output, $output['meta']['code']);
}

