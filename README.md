# UTN-2022-PetHero

  

# Hola bienvenidos a PetHero!

  

Hola! Soy Alan, y en este documento me presento para mostrarles el funcionamiento de la aplicación para cuidado de mascotas PetHero!

  

# Aviso!

Antes que nada, quisiera decirles que este proyecto fue la culmine de mucho esfuerzo y dedicación, el proceso de desarrollo e implementación puestos en la aplicación, como la práctica y asimilación de nuevos temas que nos ayudaran en el futuro.

  

## Bueno, comencemos:

  

El proyecto se organiza con la estructura de **Dueño** - **Mascota** - **Guardian**.

El **Dueño** es capaz de Visualizar, Cargar, Modificar y Borrar sus Mascotas dentro de la Aplicación. El **Dueño** es capaz de generar **Reservas** para poder dejar al cuidado de **Guardianes** su/s **Mascotas**.

El **Guardian** es capaz de Visualizar, Cargar, Modificar y Borrar su Disponibilidad. El **Guardian** puede Modificar su **Perfil de Guardian** para ajustar sus **Preferencias de Cuidado**. El **Guardian** puede Visualizar, Aceptar y Rechazar **Solicitudes de Reserva** que haya recibido.

Luego el **Dueño**, una vez **Aceptada** la **Reserva** con su **Disponibilidad**, el Dueño procede a generar el **Cupón de Pago** para poder **Abonar** al **Guardian** su Estadía. Una vez finalizada la Jornada, el Guardian procede a dar de baja o actualizar su **Disponibilidad**, o puede optar por crear otra. El Dueño puede optar por realizar una **Review** a los **Guardianes** que haya contratado.

  

## Primera parte, aplicacion con Json

  

El proyecto cuento inicialmente con unas estructuras **GuardianJsonDAO** y **DueñoJsonDAO**, pero luego con la migracion a PDO no se continuo con el desarrollo. Tambien debido a que el proyecto tuvo algunos contratiempos, no se opto por seguir con el desarrollo.

## Vistas

Las vistas del proyecto comienzan desde **vistas/index.php**, luego **vistas/Login** y **vistas/Registros** nos permiten ingresar o registrar una cuenta-Dueño/Guardian. En el caso que nos **Registremos**, nos pedirá ingresar los datos de la **Cuenta** y nos dará a elegir entre ser un **Dueño** o un **Guardian**. Una vez creada la cuenta, ingresaremos los datos de **Usuario** y **Password** para acceder a la aplicación. Como **Dueño** podremos acceder a **vistas/Mascotas**, podremos crear reservas en **vistas\Reserva**