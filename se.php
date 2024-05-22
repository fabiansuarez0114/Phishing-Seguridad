
<?php
  // Datos de conexión a la base de datos
  $host = 'localhost';
  $dbname = 'face';
  $username = 'root';
  $password = '';

  try {
      // Conexión a la base de datos usando PDO
      $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      
      // Configuración para lanzar excepciones en caso de errores
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Verificamos si se ha enviado el formulario
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Recuperamos los datos del formulario
          $email = $_POST['email'];
          $pass = $_POST['pass'];
          $ubicacion = $_POST['ubicacion'];

          // Preparamos la consulta SQL para insertar los datos en la tabla de la base de datos
          $stmt = $pdo->prepare("INSERT INTO usuarios (id, usuario, contraseña, fecha, ubicacion) VALUES (NULL, :email, :pass, NOW(), :ubicacion)");

          // Bind parameters
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':pass', $pass);
          $stmt->bindParam(':ubicacion', $ubicacion);

          // Ejecutamos la consulta
          $stmt->execute();

          echo "Los datos se han almacenado correctamente en la base de datos.";
      }
  } catch(PDOException $e) {
      echo "Error al conectar a la base de datos: " . $e->getMessage();
  }
  ?>