## LACIA APPS

- Si bien todo el entorno está montado con docker. Hay algunos pasos que hay que seguir para dejar las apps levantadas.
- **importante!** Necesitamos poder ejecutar archivos makefile
  - `sudo apt-get -y install make`

## Comandos de inicio
- make rebuild-all
    - nos levantará todos los contenedores (2 en total)
- make install-lumen
    - instalará dependencias. carpeta vendor
- make install-vue
    - instalará dependencias. carpeta node_modules y hara el build en dist

## .env file
- Hay que incluir este archivo en la ruta apps/lumen
- Cambiar las variables SPOTIFY_* con los datos de acceso correspondientes
```yml
APP_NAME=Lumen
APP_ENV=local
APP_DEBUG=false
APP_URL=http://localhost:9080
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
CACHE_DRIVER=file

SPOTIFY_CLIENT_ID=xxx
SPOTIFY_CLIENT_SECRET=yyy
```

## Endpoints disponibles
- api albums
  - [http://localhost:9080/api/v1/albums?q=soda stereo](http://localhost:9080/api/v1/albums?q=soda%20stereo)
  - **NOTA** Uno de los requerimientos es que sea el nombre de una **banda** no he encontrado alguna propiedad que me pueda identificar un artista como banda
  - Deberia verse algo como esto:  
    - ![](https://github.com/eacevedof/lacia/blob/main/challenge/images/soda-stereo-result.png)

- servidor movies.json
  - [http://localhost:9090](http://localhost:9090/)

- servidor front
  - [http://localhost:9100](http://localhost:9100)

## ejecutar tests
- php
  - make php-test
  - make rem-cache
    - limpia la cache del bearer token
- js
  - make js-test


#### extra
- [be.pdf](https://github.com/eacevedof/lacia/blob/main/challenge/be.pdf)
- [fe.pdf](https://github.com/eacevedof/lacia/blob/main/challenge/fe.pdf)
- [https://www.lacia.com/challenge/moves.json](https://www.lacia.com/challenge/moves.json)