Trabajo practicto especial para rendir el final libre de web 2 realizado por Santiago Coria.

## Endpoints

Coleccion de endpoints en postman [aca](https://www.postman.com/planetary-shuttle-304837/workspace/final-web-2/request/23307208-4f39444d-df21-49b9-adc1-68c44e9de90f). 

### POST /authorization

Se encarga de obtener el Baerer token, para poder usarlo necesitaran de basic auth donde username va a ser admin@admin.com y la password es admin123 . 

Ejemplo de respuesta: 
~~~
"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwibmFtZSI6ImFkbWluQGFkbWluLmNvbSIsImV4cCI6MTY3ODg0MDM1OX0.n3bvZurA9FxB0Y5s5qcFWzh0OrhQi1dqiPdkbRcVtN0"
~~~

### GET /items

Se encarga de obtener todos los gastos, el cual puede recibir varios queryparams.

* order (opcional, string): orden por le que se van a ordenar los items ya sea ASC o DESC.
* orderby (opcional, string): atributo por el que se quiere ordernar.
* page (opcional, integer): numero de pagina que quieren ver.
* limit (opcional, integer): numero de elementos que se van a mostrar por pagina.
* name (opcional, string): nombre por el que se quiere filtrar.
* min (opcional, double): precio minimo por el que se quiere filtrar.
* max (opcional, double): precio maximo por el que se quiere filtrar.

Ejemplo de respuesta:

~~~
[
    {
        "id": 45,
        "name": "Xiaomi",
        "description": "8 gb de ram",
        "price": 59496,
        "image": "./images_upload/6411d4c9be8d57.49701701.jpg",
        "fk_id_category": 10,
        "category_name": "ROPA"
    },
    {
        "id": 47,
        "name": "Xiaomi",
        "description": "5 gb de ram",
        "price": 59496,
        "image": "./images_upload/6411d4c2051840.60711839.jpg",
        "fk_id_category": 2,
        "category_name": "celular"
    },
    {
        "id": 46,
        "name": "Xiaomi",
        "description": "8 gb de ram",
        "price": 59496,
        "image": "./images_upload/6411d4bb5a2499.24679105.jpg",
        "fk_id_category": 2,
        "category_name": "celular"
    }
]
~~~

### GET /item/:id

Se encarga de recuperar el item que es pasado como pathparam.

Ejemplo de respuesta:

~~~
[
    {
        "id": 13,
        "name": "Xiaomi",
        "description": "4 gb de ran",
        "price": 180000,
        "image": "./images_upload/6411d4c9be8d57.49701701.jpg",
        "fk_id_category": 2,
        "category_name": "celular"
    }
]
~~~

### POST /item

Se encarga de agregar un item a la base de datos, para utilizar el mismo se requiere de autenticacion con baerer token y se le debe pasar un body del cual extraera la informacion para agregar el nuevo registro a la db.

Ejemplo de body:

~~~
{
    "name": "Xiaomi",
    "description": "celu usado",
    "price": "9999999",
    "image": "./images_upload/6411d4c9be8d57.49701701.jpg",
    "fk_id_category": 10
}
~~~

Ejemplo de respuesta:

~~~
[
    {
        "id": 48,
        "name": "Xiaomi",
        "description": "celu usado",
        "price": 9999999,
        "image": "./images_upload/6411d4c9be8d57.49701701.jpg",
        "fk_id_category": 10,
        "category_name": "CELULAR"
    }
]
~~~

### PUT /item/:id

Se encarga de modificar un item en la base de datos a partir del id especificado con el pathparam. Para utilizar este endpoint es necesario baerer token. 

Ejemplo de body:

~~~
{
    "description": "celu nuevo",
}
~~~

Ejemplo de respuesta:

~~~
[
    {
        "id": 48,
        "name": "Xiaomi",
        "description": "celu nuevo",
        "price": 9999999,
        "image": "./images_upload/6411d4c9be8d57.49701701.jpg",
        "fk_id_category": 10,
        "category_name": "CELULAR"
    }
]
~~~

### DELETE /item/:id

Se encarga de eliminar un item en la base de datos a partir del id especificado con el pathparam. Para utilizar este endpoint es necesario baerer token. 

~~~
"Item deleted"
~~~
