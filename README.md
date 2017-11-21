# laravel-media-manager
Media Manager using Laravel

## Following are the step to configure Image Slider


### Step 1:Laravel media manager plugin requires the following components to work correctly
    
    Intervention Image
    

#### Step 2:copy vendor using composer
    
    composer require webelightdev/laravel-media-manager dev-master
    
    
    Or, you may manually update require block and run `composer update`
    
    "require": {
       
        "webelightdev/laravel-media-manager": "dev-master"
    }
    
    'composer update' will be required.

#### step 3: Once Laravel Slider is installed, You need to register the Service Provider in `config/app.php` Add following in `providers` list

   
    'providers' => [
     // ...
        Webelightdev\LaravelSlider\MediaManagerServiceProvider::class,
     // ...

    ]

#### step 4: To publish the Config, Migration, Service Provider and Facades Run

    php artisan vendor:publish

#### step 5: Finally, run migration to generate table Run
 
    php artisan migrate
    
#### step 6: This packager Required Auth login if you don't have Auth login Run

    php artisan make:auth
    php artisan migrate

#### you can view laravel media manager by writing:
www.yourdomain.com/media 
or 
localhost/yourapp/media



