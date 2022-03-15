<?php

return [

    'unknown' => 'An error occurred on the server side.',

    'crud' => [
        'store' => [
            'success'       => ':attribute created successfully.',
            'failure'       => ':attribute can\'t be create.',
        ],

        'update' => [
            'success'       => ':attribute updated successfully.',
            'failure'       => 'The selected :attribute can\'t be update.',
        ],

        'destroy' => [
            'success'       => ':attribute deleted successfully.',
            'failure'       => 'The selected :attribute can\'t be delete.',
        ],

        'assign' => [
            'success'       => ':attribute assigned successfully.',
            'failure'       => 'The selected :attribute can\'t be assign.',
        ],
    ],

    'operation' => [
        'send' => [
            'success'       => ':attribute sent successfully.',
            'failure'       => ':attribute can\'t be send.',
        ],

        'upload' => [
            'success'       => ':attribute uploaded successfully.',
            'failure'       => ':attribute can\'t be upload.',
        ],

        'verify' => [
            'success'       => ':attribute verified successfully.',
            'failure'       => ':attribute is invalid.',
        ],

        'job' => [
            'start'       => 'Job start processing.',
            'failed'       => 'Job can\'t start',
        ]
    ]
];
