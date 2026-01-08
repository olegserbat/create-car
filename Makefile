sail up:
	./vendor/bin/sail up

lint:
	./vendor/bin/phpcs -- -v --standard=PSR12  routes/web.php

