## About Laravel Admin

A laravel based Admin panel boilerplate.

> Disclaimer: No styles have been added to the admin panel views. Just some plain html in the blade views for you to build it with your preferred theme.

## Setup

- Clone or download the repo.
- Copy or rename `.env.example` to `.env`
- Setup your `.env` keys
- Run `composer install`
- Run the migrations and seed the database with the default roles and permissions, ie. `php artisan migrate --seed`

## Admin Access

To access admin panel, you have to go to `{yourproject}/admin/dashboard`, but first follow steps below:

- Create a normal user account
- Seed the database with the default permissions and roles (Skip this step if you seeded the database when setting up migrations).
- From console run:

> php artisan role:assign johndoe@example.org --role=admin-root

## Admin Routes

- All admin routes are in the `admin.php` file in `routes` folder. 

__Note:__ `johndoe@example.org` is the `email` of the an account you have created, while `admin-root` is the `slug` of the default admin role.

## Contributing

If you have something to contribute to the project, you are welcome.

## Security Vulnerabilities

If you discover a security vulnerability within the project, please send an e-mail to Cuthbert Mirambo via [miracuthbert@gmail.com](mailto:miracuthbert@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
