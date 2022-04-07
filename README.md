# DeathStar - Example Laravel + Vue project

## Live preview: https://deathstar.chojnicki.xyz

Template was strongly inspired from previews available at https://www.behance.net/gallery/88652977/Star-Wars-Death-Star-Dashboard-Design. 
So all credits to graphic designer, which I'm not :grinning: It was cuted in short time from crappy .jpg so be aware that it is far from being perfect :wink:


## Stack
* Laravel 8 (PHP 8)
* Vue 3 + Vite 2 (TS)
* Tailwind 2
* Docker + Docker compose

## Docker

All that is required is Docker + Docker compose.

```
git clone https://github.com/chojnicki/deathstar.git
cd deathstar
docker-compose up
```

This should build and run everything needed for development. 
Dashboard will be available at http://localhost:3000/

To enter into container shell (to be able using php or node commands) execute
```
docker-compose exec dashboard sh
```
or
```
docker-compose exec api sh
```

## TODO
* E2E testing with Cypress
* Table sorting and filtering
* Remove from Laravel all blade stuff, so basically make it more Lumen like 
