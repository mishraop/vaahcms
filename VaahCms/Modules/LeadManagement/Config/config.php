<?php

return [
    "name"=> "LeadManagement",
    "title"=> "Module for Lead Management",
    "slug"=> "leadmanagement",
    "thumbnail"=> "https://img.site/p/300/160",
    "is_dev" => env('MODULE_LEADMANAGEMENT_ENV')?true:false,
    "excerpt"=> "lead management system",
    "description"=> "lead management system",
    "download_link"=> "",
    "author_name"=> "satyam",
    "author_website"=> "https://vaah.dev",
    "version"=> "0.0.1",
    "is_migratable"=> true,
    "is_sample_data_available"=> false,
    "db_table_prefix"=> "vh_leadmanagement_",
    "providers"=> [
        "\\VaahCms\\Modules\\LeadManagement\\Providers\\LeadManagementServiceProvider"
    ],
    "aside-menu-order"=> null
];
