Membuat Model dan Resource :

php artisan make:model Product -mcr

Set colum product : id, title, description, qty, price, image

Add new file view Resource -> View -> Product : add.blade.php, list.blade.php, edit.blade.php

Add New Request : php artisan make:request = NewProductRequest, UpdateProductRequest

Set fillable pada model product : protected $fillable = ['title', 'price', 'qty', 'image', 'description'];
