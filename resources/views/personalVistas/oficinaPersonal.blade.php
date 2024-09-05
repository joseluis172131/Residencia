<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Web Prodami</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .modal-header {
            background-color: #6c757d;
            color: white;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
        }

        h1 {
            text-align: center;
            padding: 35px;
            font-size: 55px;
            font-family: 'DM Sedif Disp';
        }
    </style>
    <style>
        .navbar,
        .navbar-brand,
        .nav-link {
            font-family: 'IBM Plex Sans';
            font-size: 21px;
        }
    </style>
    <script>
        function searchTable() {
            // Obtener el valor del input de búsqueda
            let input = document.getElementById('searchInput').value.toUpperCase();
            // Obtener la tabla y las filas de la tabla
            let table = document.getElementById('myTable');
            let tr = table.getElementsByTagName('tr');

            // Recorrer todas las filas, excepto la primera que es la cabecera
            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td');
                let match = false;

                // Recorrer todas las celdas en la fila actual
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        // Verificar si el contenido de la celda coincide con la búsqueda
                        if (td[j].innerText.toUpperCase().indexOf(input) > -1) {
                            match = true;
                            break;
                        }
                    }
                }

                // Mostrar u ocultar la fila según si hubo coincidencia
                tr[i].style.display = match ? '' : 'none';
            }
        }
    </script>
</head>

<body>
    <style>
        .navbar-nav .nav-link {
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f0a70b;
            /* Cambia el color de fondo */
            color: #080808;
            border-radius: 5px;
            /* Opcional: añade un borde redondeado */
            text-decoration: underline;
            /* Opcional: subraya el texto */
        }
    </style>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <a class="navbar-brand" href="#" style="padding: 5px 10px; border-radius: 5px;">
            <img src="\imagenes\Prodami.jpeg" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/paileriaPersonal') }}">Paileria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/ingenieriaPersonal') }}">Ingenieria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/oficinaPersonal') }}">Oficina Administrativa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('almacenPersonal') }}">Almacen</a>
                </li>
            </ul>
            <form class="d-flex" role="search" onsubmit="event.preventDefault(); searchTable();">
                <input class="form-control me-2" type="search" id="searchInput" placeholder aria-label>
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>


    </nav>

    <img class="animate_animated animate_zoomIn" src="imagenes\administrativa.jpg"
        style="width: 1345px; height:500px; position: absolute; filter: brightness(45%);">
    <br><br><br><br><br><br><br><br>
    <h1 class="animate_animated animate_backInDown"
        style="position: absolute; color:white; left: 50%; transform: translateX(-50%);  font-family: 'DM Serif Display';">
        <strong>Oficina Administrativa</strong>
    </h1><br><br>
    <br><br><br><br><br><br><br><br>
    @if (session('correcto'))
        <div class="alert alert-success">{{ session('correcto') }}</div>
    @endif

    @if (session('incorrecto'))
        <div class="alert alert-danger">{{ session('incorrecto') }}</div>
    @endif
    <div class="container table-container" style="position: relative">
        <div class="table-responsive">
            <!-- Button trigger modal for adding new tool -->

            <table class="table table-striped-columns" id="myTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad (Pz)</th>
                        <th scope="col">codigo</th>
                        <th scope="col">Disponibilidad</th>
                        <th scope="col">Sub Área</th>
                    </tr>
                </thead>
                <tbody id="toolTableBody" class="table-group-divider">
                    @foreach ($datos as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td class="searchItem">{{ $item->nombreherramienta }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>{{ $item->codigo }}</td>
                            <td>{{ $item->disponibilidad }}</td>
                            <td>{{ $item->sub_area }}</td>
                            <td>

                                <!-- Boton Ver Imagen -->
                                <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#verModal{{ $item->id }}">
                                    <i class="fa-regular fa-image"></i>
                                </a>
                            </td>
                        </tr>

                        {{-- Ver modal --}}

                        <style>
                            .img-size-fixed {
                                max-width: 380px;
                                max-height: 350px;
                                width: auto;
                                height: auto;
                            }
                        </style>

                        <div class="modal fade" id="verModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="verModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="verModalLabel{{ $item->id }}">
                                            {{ $item->nombreherramienta }}</h1>
                                        <i class="fa-solid fa-eye-low-vision"></i>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <h4 class="modal-title fs-5" style="margin-left: 15px"
                                        id="verModalLabel{{ $item->numeroParte }}">
                                        Numero de Parte: {{ $item->numeroParte }}
                                    </h4>
                                    <div class="modal-body">
                                        @if ($item->imagen)
                                            <img src="{{ asset('storage/' . $item->imagen) }}"
                                                alt="Imagen de la herramienta" class="img-fluid img-size-fixed">
                                        @else
                                            <p>No hay imagen disponible para este producto.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Controls -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <button class="page-link" id="previous-page">Anterior</button>
                    </li>
                    <li class="page-item">
                        <button class="page-link" id="next-page">Siguiente</button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <style>
        .estatus-disponible {
            color: green;
        }

        .estatus-ocupado {
            color: red;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const estatusInput = document.getElementById("addEstatus");

            if (estatusInput) {
                estatusInput.addEventListener("input", function() {
                    const value = estatusInput.value.toLowerCase().trim();

                    // Remover las clases de color existentes
                    estatusInput.classList.remove("estatus-disponible", "estatus-ocupado");

                    // Agregar la clase de color adecuada
                    if (value.includes("disponible")) {
                        estatusInput.classList.add("estatus-disponible");
                    } else if (value.includes("ocupado")) {
                        estatusInput.classList.add("estatus-ocupado");
                    }
                });
            } else {
                console.error("No se encontró el campo de estatus con ID 'addEstatus'.");
            }
        });
    </script>


    <script>
        var currentPage = 1;
        var rowsPerPage = 15;

        function displayPage(page) {
            var table = document.getElementById("toolTableBody");
            var rows = table.getElementsByTagName("tr");
            var totalRows = rows.length;
            var totalPages = Math.ceil(totalRows / rowsPerPage);

            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;

            for (var i = 0; i < totalRows; i++) {
                rows[i].style.display = "none";
            }

            for (var i = (page - 1) * rowsPerPage; i < page * rowsPerPage && i < totalRows; i++) {
                rows[i].style.display = "";
            }
        }

        document.getElementById("previous-page").addEventListener("click", function() {
            if (currentPage > 1) {
                currentPage--;
                displayPage(currentPage);
            }
        });

        document.getElementById("next-page").addEventListener("click", function() {
            var table = document.getElementById("toolTableBody");
            var rows = table.getElementsByTagName("tr");
            var totalRows = rows.length;
            var totalPages = Math.ceil(totalRows / rowsPerPage);

            if (currentPage < totalPages) {
                currentPage++;
                displayPage(currentPage);
            }
        });


        displayPage(currentPage);
    </script>
</body>

</html>
