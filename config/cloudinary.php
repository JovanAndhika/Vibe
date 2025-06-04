<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary URL
    |--------------------------------------------------------------------------
    |
    | Format:
    | cloudinary://<API_KEY>:<API_SECRET>@<CLOUD_NAME>
    |
    | Disarankan menggunakan .env:
    | CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
    |
    */

    'cloud_url' => env('CLOUDINARY_URL'),

];
