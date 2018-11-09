<?php

use App\Shop\Categories\Filters\ByCategoryNameLength;
use App\Shop\Categories\Filters\ByPriceValue;

return [
    'schema' => [
        'default' => [
            'filter' => \App\Services\Filters\CompositeFilter::class,
        ],
        'test-category' => [
            'filter' => \App\Services\Filters\CompositeFilter::class,
            'items' => [
                ByPriceValue::class,
                ByCategoryNameLength::class,
            ]
        ],
        'by-category-name-length' => [
            'filter' => \App\Shop\Categories\Filters\ByCategoryNameLength::class,
        ]
    ]
];
