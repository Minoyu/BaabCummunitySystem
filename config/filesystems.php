<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        // 新建一个本地端userAvatar空间（目录） 用于存储上传的图片
        'userAvatar' => [
            'driver' => 'local',
            // 文件将上传到storage/app/uploads目录
            //'root' => storage_path('app/uploads'),
            // 文件将上传到public/uploads目录 如果需要浏览器直接访问 请设置成这个
            'root' => public_path('uploads/avatar'),
        ],

        // 新建一个本地端userCover空间（目录） 用于存储上传的图片
        'userCover' => [
            'driver' => 'local',
            'root' => public_path('uploads/cover'),
        ],

        // 新建一个本地端newsImg空间（目录） 用于存储新闻上传的图片
        'newsImg' => [
            'driver' => 'local',
            'root' => public_path('uploads/news/img'),
        ],
        // 新建一个本地端newsReplyImg空间（目录） 用于存储新闻回复上传的图片
        'newsReplyImg' => [
            'driver' => 'local',
            'root' => public_path('uploads/news/reply/img'),
        ],
        // 新建一个本地端newsCover空间（目录） 用于存储新闻上传的封面
        'newsCover' => [
            'driver' => 'local',
            'root' => public_path('uploads/news/cover'),
        ],
        // 新建一个本地端communityCategoryImg空间（目录） 用于存储社区分区封面图
        'communityCategoryImg' => [
            'driver' => 'local',
            'root' => public_path('uploads/community/category/img'),
        ],
        // 新建一个本地端communityTopicImg空间（目录） 用于存储社区话题封面图
        'communityTopicImg' => [
            'driver' => 'local',
            'root' => public_path('uploads/community/topic/img'),
        ],


        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
