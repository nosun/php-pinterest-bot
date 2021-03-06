<?php

namespace seregazhuk\tests\Helpers;

/**
 * Class ResponseHelper.
 *
 * Helper for creating different dummy responses for testing purposes.
 */
trait ResponseHelper
{
    /**
     * @var array
     */
    protected $paginatedResponse = [
        ['id' => 1],
        ['id' => 2],
    ];

    /**
     * Create a dummy response from Pinterest.
     *
     * @param array $data
     *
     * @return array
     */
    public function createApiResponse($data = [])
    {
        return ['resource_response' => $data];
    }

    /**
     * Create a success dummy response.
     *
     * @param mixed $data
     * @return array
     */
    public function createSuccessApiResponse($data = 'success')
    {
        return $this->createApiResponse(['data' => $data]);
    }

    /**
     * Create an error dummy response.
     *
     * @param string $error
     * @return array
     */
    public function createErrorApiResponse($error = 'error')
    {
        return $this->createApiResponse(
            [
                'error' => [
                    'message' => $error,
                ],
            ]
        );
    }

    /**
     * Create a dummy paginated response.
     *
     * @param mixed $response
     * @return array
     */
    public function createPaginatedResponse($response)
    {
        return [
            'resource_response' => [
                'data' => $response,
            ],
            'resource' => [
                'options' => ['bookmarks' => 'my_bookrmarks']
            ]
        ];
    }
}
