## Knowloade and Declaration
* status column in bookings table -
    0 - 'pending'
    1 - 'processing'
    2 - 'delivered'
    3 - 'cancelled'

* Modules -

1) Consumer or public
    
    # feattures:

        - Check all availbale Oxygen Cylinders
        - Book Oxygen Cylinder
        - Register Supplier
        - Login Supplier

2) Supplier

    # feattures:

        - Check all assigned booking to logged in supplier
        - Update status of booking request among pending, processing, delivered and cancelled


## Project Setup

* git clone repo_path

* run composer update

* install and run npm deb for breeze
npm install && npm run dev

* run migration :
php artisan migrate

* run seeder :
php artisan db:seed
