
## Summary


In this system of Task Manager is a dynamic web application used for organizations and businesses for handling their efficient task management at the time of  maintaining data and security through multi-tenancy architecture.With its secure architecture, customizable features, and real-time collaboration capabilities,It enhance  to streamline their task workflows while maintaining data privacy and security .



## Features
* Multi-Tenancy.
* Import CSV files into database CRUDs .
* Adds ability for users to register in the system .
* Global Search.
* This  system that works as todo list but also can be viewed in a calendar mode. 

## Future Scope
We can implement Kanban Feature that will  provides a clear visualization of the workflow, allowing team members to identify prioritize tasks, and optimize the flow of work.



   
## Deployment Steps
* Clone the project repository by running the command below:  git clone https://github.com/Pallavik123/Task-Management-with-MultiTenancy-using-livewire.git.
* After cloning, run:  composer install
* Duplicate .env.example and rename it .env
	Then run:
	php artisan key:generate
* Be sure to fill in your database details in your .env file before running the migrations:
	php artisan migrate
* And finally, start the application:
		php artisan serve
and visit http://localhost:8000 to see the application in action.  


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
