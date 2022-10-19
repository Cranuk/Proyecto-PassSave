# Proyecto-PassSave
Es un software donde te permite guardar los datos de las sesiones web de tus paginas mas visitadas

Este sistema esta estructurada en el lenguaje PHP puro en la arquitectura MVC, con esta estructura el software tiene una mejor lectura de lo que realiza y sobre que tareas que realizara cada uno como tambien el uso de PDO para las consultas SQL

Login: Diseño simple donde te pide alias y clave.

Registro: En el login hay un enlace que te redirecciona a registro donde te pedira los datos necesario para el correcto registro y una vez registrado correctamente, se le envia al admin y correo de aviso que un nuevo usuario entro al sistema

MisSesiones: Es la pagina principal del sistema donde tendras tu panel donde estara tu informacion, cantidad de sesiones guardadas, el boton para guardar nuevas sesiones y el boton de salir que es para deslogearte

Acciones dentro de la web: tenemos el boton de agregar sesiones que te pedira los datos necesarios para guardar correctamente los datos en a la base de datos, luego de guardar tu primera sesion aparecera un tablero con todas las sesiones guardadas por el usuario. Cada usuario solo vera sus sesiones guardadas, para realizar esto le agregamos un rol a cada usuario para que solo utilice las herramientas correspondientes a su rol

Niveles de usuario: Admin -> este rol puede ver informacion de todos los usuario, tiene mas informacion de las sesiones como quien las creo y su id de sesion correspondiente
Usuario -> este rol solo tiene acceso a su informacion unicamente

