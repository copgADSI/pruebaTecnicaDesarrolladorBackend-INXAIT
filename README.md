<h3>Prueba técnica Inxait</h4>

<h4>Pasos para el correcto despliegue de la prueba técnica </h4>
<ol>
    <li>Clonar proyecto: <b> git clone https://github.com/copgADSI/pruebaTecnicaDesarrolladorBackend-INXAIT.git</b></li>
    <li>Instalar paquetes y dependencia <b>npm install</b> </li>
    <li>Instalar de denpendiancias composer <b>composer install</b> </li>
    <li>Crear archivo <b>.env</b> basado en <b>.env.example</b> </li>
    <li>Crear base de datos</li>
    <li>Correr migraciones <b>php artisan migrate</b> </li>
</ol>

<h4>Pasos para sembrar datos de departamentos,ciudades y algunas pruebas unitarias </h4>
<ol>
    <li>Sembrar datos: <b>php artisan db:seed</b> (volver a correr por si falla) </li>
    <li>TDD a procesos importantes: <b>php artisan run test</b> </li>
</ol>

<img src="https://github.com/copgADSI/pruebaTecnicaDesarrolladorBackend-INXAIT/blob/main/public/assets/images/banner.jpg" alt="banner">
<img src="https://github.com/copgADSI/pruebaTecnicaDesarrolladorBackend-INXAIT/blob/main/public/assets/images/reports.jpg" alt="banner">