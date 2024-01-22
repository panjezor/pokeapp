# PokeApp
This is to show my skills when building a prod-ready app.

I have used FilamentPHP for quick scaffolding.

Now I see it has been a poor choice as I have had to perform some hacks to get things going.
Despite that, I believe that if I tried to do it from scratch on a regular Laravel base, I would have lots more html/css/js to write, so I find filament lesser of both evils.

## Installation

After you pull the repo, use the following command
```shell
cp .env.example .env
```
then you have to install the dependencies:

do it either locally via Composer
```shell
composer install --ignore-platform-reqs
```

or if you don't have composer, use this:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

Then I would advise using Sail, by running:
```shell
./vendor/bin/sail up -d
```


and start running the php commands. "php" in following commands is replaceable by "./vendor/bin/sail" if you use sail.
```shell
php artisan key:generate
php artisan migrate
npm install
npm run build
```

then get into your browser to and go to https://localhost
this should get you into the main Pokemon list

This list is pulled in PokeAPIService via Middleware that checks for Pokemon existence on any "web" request.
Due to Filament's being auth-only, ForceLogin middleware was introduced to use a default user. yes, I know, poor choice.

There is a search bar that responds to defocus or "enter". If you click a certain row, you will be redirected to a singular page with a pokemon, its data and a sprite.

There is a button to go back, too.

Some of the requirements were covered by the tests, however not all.

All of the requirements have been met

## Side note

If I was given more time, I would:
- chunk the pokemon into jobs and pull them beforehand. Right now they are being pulled from database or from pokeApi on request.
- cache. Since there is a lot of static data, i would cache all the requests.
- I would mock the API in my tests, so that my PokeAPIService could have proper test coverage
- the PokeAPIService should have a validation setup to make sure that the response json is of the right shape.
- if all the data is pulled, I would force this project into a static website with https://jigsaw.tighten.com/ or a similar tool.
- I believe the middleware for checking the Pokedex status is less than ideal. I dont have an idea how I would change it, but I would definitely revisit.
- many more will come to mind, but this is what i have for now.
- If those requirements were linkable tasks, my commit messages would be much clearer and actually reference them, rather than giving context by providing GWT.

Despite I didn't write too much code in this project and parts of it were filament/livewire related, I believe I have shown genuinely how in-depth knowledge I have of the Laravel-related ecosystems, including things like extra middleware, mocking the Service class, pulling a blade component just to put an extra picture

Overall it's been a fun experience, I hope to hear back from you soon.