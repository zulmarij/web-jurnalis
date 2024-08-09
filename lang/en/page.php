<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sample Page
    |--------------------------------------------------------------------------
    */
    // 'page' => [
    //     'title' => 'Page Title',
    //     'heading' => 'Page Heading',
    //     'subheading' => 'Page Subheading',
    //     'navigationLabel' => 'Page Navigation Label',
    //     'section' => [],
    //     'fields' => []
    // ],

    /*
    |--------------------------------------------------------------------------
    | General Settings
    |--------------------------------------------------------------------------
    */
    'general_settings' => [
        'title' => 'General Settings',
        'heading' => 'General Settings',
        'subheading' => 'Manage general site settings here.',
        'navigationLabel' => 'General',
        'sections' => [
            "site" => [
                "title" => "Site",
                "description" => "Manage basic settings."
            ],
            "color" => [
                "title" => "Color",
                "description" => "Change default color."
            ],
        ],
        "fields" => [
            "site_name" => "Site Name",
            "site_description" => "Site Description",
            "site_logo" => "Site Logo",
            "site_favicon" => "Site Favicon",
            "site_colors" => [
                "primary" => "Primary Color",
                "secondary" => "Secondary Color",
                "gray" => "Gray Color",
                "success" => "Success Color",
                "danger" => "Danger Color",
                "info" => "Info Color",
                "warning" => "Warning Color",
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail Settings
    |--------------------------------------------------------------------------
    */
    'mail_settings' => [
        'title' => 'Mail Settings',
        'heading' => 'Mail Settings',
        'subheading' => 'Manage mail configuration.',
        'navigationLabel' => 'Mail',
        'sections' => [
            "config" => [
                "title" => "Configuration",
                "description" => "description"
            ],
            "sender" => [
                "title" => "From (Sender)",
                "description" => "description"
            ],
            "mail_to" => [
                "title" => "Mail to",
                "description" => "description"
            ],
        ],
        "fields" => [
            "placeholder" => [
                "receiver_email" => "Receiver email.."
            ],
            "driver" => "Driver",
            "host" => "Host",
            "port" => "Port",
            "encryption" => "Encryption",
            "timeout" => "Timeout",
            "username" => "Username",
            "password" => "Password",
            "email" => "Email",
            "name" => "Name",
            "mail_to" => "Mail to",
        ],
        "actions" => [
            "send_test_mail" => "Send Test Mail"
        ]
    ],

];
