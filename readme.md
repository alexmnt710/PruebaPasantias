# Proyecto: Instrucciones para Configuración y Ejecución

Este documento describe los pasos necesarios para configurar y ejecutar tanto el backend como el frontend del proyecto.

## **Backend**

### **Requisitos previos**

1. Tener una base de datos PostgreSQL configurada.
2. Configurar las variables de entorno en un archivo `.env`. Asegúrate de incluir los datos de conexión a la base de datos PostgreSQL.

### **Pasos para configurar el backend**

1. Instalar las dependencias del proyecto:

   composer install


2. Migrar las tablas y relaciones a la base de datos:

   php artisan migrate


3. Poblar la base de datos con datos iniciales:

   php artisan db:seed


4. Iniciar el servidor de desarrollo:

   php artisan serve


El backend estará disponible en la URL especificada por `php artisan serve` (por defecto, http://127.0.0.1:8000).

## **Frontend**

### **Requisitos previos**

1. Verifica que el archivo `.env` del backend contenga la URL correcta del servidor backend. Este archivo no debe ser eliminado.

### **Pasos para configurar el frontend**

1. Instalar las dependencias del proyecto:

   npm install


2. Iniciar el servidor de desarrollo del frontend (si aplica):

   npm run dev


El frontend estará disponible en la URL especificada por el comando anterior (por defecto, http://localhost:5173).

## **Usuarios precargados**

El sistema cuenta con dos usuarios precargados para pruebas:

1. **Administrador:**
   - **Email:** admin@example.com
   - **Contraseña:** admin

2. **Usuario:**
   - **Email:** user@example.com
   - **Contraseña:** password

## **Notas adicionales**

- Asegúrate de que el backend y el frontend estén sincronizados con la misma configuración del entorno.
- Si encuentras algún problema, verifica que las dependencias estén instaladas correctamente y que las configuraciones de entorno sean correctas.

