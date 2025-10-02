<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Acerca de Laravel

Laravel es un framework de aplicación web con sintaxis expresiva y elegante. Creemos que el desarrollo debe ser una experiencia agradable y creativa para ser verdaderamente satisfactorio. Laravel elimina el dolor del desarrollo al facilitar las tareas comunes utilizadas en muchos proyectos web.

## Configuración del Proyecto

### Configuraciones Implementadas

Este proyecto ha sido configurado con las siguientes configuraciones:

#### Configuración de Base de Datos
- **Conexión MySQL**: Configurada y operativa exitosamente
- **Base de Datos**: Conectada y funcionando correctamente

#### Configuración de la Aplicación
- **Zona Horaria**: `America/Merida` - Configurada para mostrar la hora correcta
- **Idioma Predeterminado**: Español (`es`) - Interfaz y validaciones en español
- **Localización Faker**: `es_ES` - Datos en español para pruebas y seeding

#### Sistema de Perfil de Usuario
- **Autenticación**: Laravel Jetstream implementado
- **Fotos de Perfil**: Sistema de avatares con generación automática basada en iniciales
- **Gestión de Usuarios**: Autenticación completa y gestión de perfiles

#### Panel Administrativo
- **Layout Admin**: Layout administrativo personalizado con integración Flowbite
- **Navegación**: Componentes de sidebar y navbar extraídos a includes
- **Contenido Dinámico**: Sistema de slots implementado para renderizado flexible de contenido
- **Framework UI**: Componentes Flowbite integrados para diseño consistente

#### Especificaciones Técnicas
- **Versión PHP**: 8.2.12
- **Framework Laravel**: Última versión
- **Autenticación**: Laravel Jetstream con Equipos
- **Frontend**: Componentes Livewire con Tailwind CSS + Flowbite
- **Framework Admin**: Layout Blade personalizado con arquitectura de componentes

### 🚀 Instalación y Configuración

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/YasserSG/doctor_appointment_app_backend.git
   cd doctor-appointment-app
