# Documentación

## Rutas

>GET contacts/

Esta ruta se utiliza para obtener todos los contactos.

>GET contacts/:id

Esta ruta nos sirve para obtener los datos de un contacto en particular, pasándole como parámetro el id de dicho contacto.

>POST contacts/

En esta ruta debemos especificar en el cuerpo de la petición el contacto a agregar.

Ej:

```JSON
{
  "name": "Frank",
  "lastname": "Ramos",
  "email": "frankdejesusramosguzman@gmail.com",
  "phone": "8497110984"
}
```

>PATCH contacts/:id

En esta ruta debemos especificar el contacto a actualizar también debemos pasarle un JSON con los datos a actualizados.

Ej:

```JSON
{
    "id_contact": 8,
    "name": "Frank De Jesús",
    "lastname": "Ramos Guzmán",
    "email": "frankdejesusramosguzman9@gmail.com",
    "phone": "849-711-0033"
}
```

>DELETE contacts/:id

Esta ruta se utiliza para eliminar un contacto en específico, pasándole como parámetro el id de dicho contacto.
