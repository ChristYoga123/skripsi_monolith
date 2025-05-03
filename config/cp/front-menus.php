<?php 
return [
    [
        'title' => 'Home',
        'route' => 'cp.home.index',
    ],
    [
        'title' => 'Blog',
        'route' => 'cp.blog.index',
        'active' => 'cp.blog*',
    ],
    
    [
        'title' => 'Program',
        'route' => 'cp.program.index',
        'active' => 'cp.program*',
    ],
    [
        'title' => 'Produk',
        'children' => [
            //! gunakan url sebagai key karena merupakan produk external
            [
                'title' => 'LAOS Course',
                'url' => env('APP_URL') . '/course', //* kebetulan produk ini internal
            ],
        ],
    ],
]
?>