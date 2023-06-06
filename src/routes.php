<?php
return [
    '~hello/(.*)~' => [Controllers\MainController::class, 'sayHello'],
    '~^$~' => [Controllers\MainController::class, 'main'],
    '~article/show/(\d+)~' => [Controllers\ArticleController::class, 'show'],
    '~article/create~' => [Controllers\ArticleController::class, 'create'],
    '~article/store~' => [Controllers\ArticleController::class, 'store'],
    '~article/edit/(\d+)~' => [Controllers\ArticleController::class, 'edit'],
    '~article/update/(\d+)~' => [Controllers\ArticleController::class, 'update'],
    '~article/delete/(\d+)~' => [Controllers\ArticleController::class, 'delete'],
    '~comments/store~' => [Controllers\CommentController::class, 'store'],
    '~comments/(\d+)~' => [Controllers\CommentController::class, 'show'],
    '~comments/edit/(\d+)~' => [Controllers\CommentController::class, 'edit'],
    '~comments/update/(\d+)~' => [Controllers\CommentController::class, 'update'],
    '~comments/delete/(\d+)~' => [Controllers\CommentController::class, 'delete'],
];