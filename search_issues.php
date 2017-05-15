<? php
  
      $search_input = $_POST['busca'];
      include 'database.php';
      use UnBix_database;
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = select * from Complaints where Categoria = $search_input;
      $q = $pdo -> prepare($sql);


      Database::disconnect();


 ?>
