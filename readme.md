**Instalasi Awal :**

1. open terminal dan arahkan ke htdocs masing-masing c:\xampp\htdocs
2.  run : **composer create-project --prefer-dist laravel/laravel bnsp-test "5.8"**
3. buat database baru dengan nama bnsp-test
4. arahkan terminal ke project bnsp-test pada htdocs cd c:\xampp\htdocs\bnsp-test
5. buka project blog-pbw dengan editor atom
6. atur konfigurasi database project bnsp-test pada file .env
7. run : php artisan make:auth
8. untuk mencegah error perbedaan version PHP/DATABASE bisa tambahkan **Schema::defaultStringLength(191);** pada file app->providers->AppServiceProviders.php didalam function **boot(){ letakan disini }** dan tambahkan **use Illuminate\Support\Facades\Schema;** sebelum class AppServiceProvider bisa lihat contohnya di https://pastebin.com/v0UkURCb
9. run : php artisan migrate
10. run : php artisan make:model Article -mcr
11. buka file migration blog dan buat field table migration
12. run : php artisan migrate
13. buat route baru



**CHALENGES**

Membuat Model dan Resource :

php artisan make:model Product -mcr

Set colum product : id, title, description, qty, price, image

Add new file view Resource -> View -> Product : add.blade.php, list.blade.php, edit.blade.php

Add New Request : php artisan make:request = NewProductRequest, UpdateProductRequest

Set fillable pada model product : protected $fillable = ['title', 'price', 'qty', 'image', 'description'];
