# laravel-media-manager
Media Manager using Laravel

## Following are the step to configure Media Manager


#### Step 1:copy vendor using composer

    composer require webelightdev/laravel-media-manager dev-master
    
    or
    
    "require": {
       
        "webelightdev/laravel-media-manager": "dev-master"
    }
    composer update

#### step 2: Copy providers to config/app.php

    'providers' => [
     // ...
        Webelightdev\LaravelSlider\MediaManagerServiceProvider::class,
     // ...

    ]

#### step 3: Run  
	php artisan vendor:publish


#### step 4: Run  
	php artisan migrate


#### you can view laravel slider with following link:
www.yourdomain.com/slider 
or 
localhost/yourapp/slider

#### Demo



