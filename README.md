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

## Endpoints disponibles
- api spotify
  - [http://localhost:9080](http://localhost:9080/)
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