<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #001f3f, #0056b3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px; /* Ajusta el ancho total */
            display: flex; /* Hacer que los hijos se alineen uno al lado del otro */
            gap: 2rem; /* Espacio entre el formulario y la imagen */
        }
        .form-container {
            flex: 1; /* El formulario ocupará la mitad del espacio */
        }
        .image-container {
            flex: 1; /* La imagen ocupará la mitad del espacio */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image-container img {
            max-width: 75%; /* Limita el ancho máximo de la imagen */
            height: auto; /* Mantiene la proporción de la imagen */
            border: none; /* Elimina cualquier borde */
            box-shadow: none; /* Elimina cualquier sombra */
        }
        .form-container h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }
        .login-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        .login-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .login-footer {
            text-align: center;
            margin-top: 1rem;
        }
        .login-footer a {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
        .register-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
            transition: background-color 0.3s, transform 0.2s;
        }
        .register-button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="form-container">
            <h2>Iniciar Sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit" class="login-button">Ingresar</button>
            </form>
            <div class="login-footer">
                <button class="register-button" onclick="window.location.href='{{ route('registroVer') }}'">Registrar</button>
            </div>
        </div>
        <div class="image-container">
            <img src="\imagenes\Logo_Bueno.jpeg" alt="Imagen relacionada con el inicio de sesión">
        </div>
    </div>
</body>
</html>
