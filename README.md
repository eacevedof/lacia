## LACIA APPS

- Si bien todo el entorno está montado con docker. Hay algunos pasos que hay que seguir para dejar las apps levantadas.
- Necesitamos poder ejecutar archivos makefile

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
  - [http://localhost:9080](http://localhost:9080/)
  - **NOTA** Uno de los requerimientos es que sea el nombre de una **banda** no he encontrado alguna propiedad que me pueda identificar un artista como banda

- servidor movies.json
  - [http://localhost:9090](http://localhost:9090/)

- servidor front
  - [http://localhost:9100](http://localhost:9100)

## ejecutar tests
- php
  - make php-test
- js
  - make js-test


#### extra
- [be.pdf](https://github.com/eacevedof/lacia/blob/main/challenge/be.pdf)
- [fe.pdf](https://github.com/eacevedof/lacia/blob/main/challenge/fe.pdf)
- [https://www.lacia.com/challenge/moves.json](https://www.lacia.com/challenge/moves.json)