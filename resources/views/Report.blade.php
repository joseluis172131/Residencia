<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe de Inventario</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Configuración de márgenes y elementos en la página */
        @page {
            margin: 150px 50px 100px 50px;
        }

        header {
            position: fixed;
            top: -120px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -70px;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 12px;
        }

        .content {
            margin-top: 20px;
            margin-bottom: 50px;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .bg-disponible {
            background-color: #d4edda;
        }

        .bg-ocupado {
            background-color: #f8d7da;
        }
    </style>
</head>

<body>
    <header>
        <img src="imagenes/Diseño.jpg" style="width: 105%; height: auto;">
    </header>

    <footer>
        <img src="imagenes/Diseño dos.jpg" style="width: 100%; height: auto;">
    </footer>

    <div class="content">
        <img src="imagenes\Informe Inventario.jpg" style="width: 100%; height: auto;">
        <h1>Informe de Inventario</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de la Herramienta</th>
                    <th>Cantidad (Pz)</th>
                    <th>Código</th>
                    <th>Estatus</th>
                    <th>Sub Área</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombreherramienta }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->codigo }}</td>
                    <td class="{{ strtolower($item->disponibilidad) == 'disponible' ? 'bg-disponible' : (strtolower($item->disponibilidad) == 'ocupado' ? 'bg-ocupado' : '') }}">
                        {{ $item->disponibilidad }}
                    </td>
                    <td>{{ $item->sub_area }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
