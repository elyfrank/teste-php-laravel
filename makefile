include .env

create-table:
	php artisan make:migration create_$(filter-out $@,$(MAKECMDGOALS))_table