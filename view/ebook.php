<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSS Website Layout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body>

<div class="logo">Re-Read</div>

<div class="header">
  <h1>Re-Read</h1>
  <p>En Re-Read podrás encontrar libros de segunda mano en perfecto estado. También vender los tuyos. Porque siempre hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de los dos.</p>
</div>

<div class="row">
  <div class="column left">
    <div class="topnav">
      <a href="../index.php">Re-Read</a>
      <a href="../view/libros.php">Libros</a>
      <a href="eBook.php">eBooks</a>
    </div>
        <!--
        <div class="ebook">
            <a href="https://play.google.com/store/books/details/Ricky_Schneider_Escalas_Mixolidias_Guitarra_Paso_a?id=MCjtDwAAQBAJ"></a><img src="../img/ebook_1.jpg" alt="ebook 1"></a>
            <div>Escalas Mixolidias - Guitarra Paso a Paso</div>
        </div>
        -->
    <div class="content">
      <h3>Toda la actualidad en eBook</h3>
      <div class="form">
        <form action="ebook.php" method="POST">
          <label for="fautor">Autor</label>
          <input type="text" id="fautor" name="fautor" placeholder="Introduce el autor.."> 
          <label for="country">Country</label>
          <select id="country" name="country">
            <option value="%">Todos los paises</option>
            <?php 
              include '../services/connection.php';
              $query="SELECT DISTINCT Authors.Country FROM Authors ORDER BY Country";
              $result=mysqli_query($conn,$query);
              while ($row = mysqli_fetch_array($result)) {
                echo '<option value="'.$row['Country'].'">'.$row['Country'].'</option>';
              }
              
            ?>
          </select>    
          <input type="submit" value="Submit">
        </form>
      </div>

      <?php
        //1. Coneccion con la base de datos
        include '../services/connection.php';

        if (isset($_POST['fautor'])) {
          
        $query="SELECT Books.Description, Books.img, Books.Title FROM Books INNER JOIN BooksAuthors ON Id=BooksAuthors.BookId INNER JOIN Authors ON Authors.Id=BooksAuthors.AuthorId WHERE Authors.Name LIKE '%{$_POST['fautor']}%' AND Authors.Country LIKE '{$_POST['country']}'";
        echo $query;  
        $result = mysqli_query($conn,$query);

        }else {
            $result = mysqli_query($conn, "SELECT Books.Description, Books.img, Books.Title FROM Books WHERE eBook !='0'");
        }
          //2. Selección y muestra de datos de la base de datos

        if (!empty($result) && mysqli_num_rows($result) > 0) {
          $i = 0;
          while ($row = mysqli_fetch_array($result)) {
            $i++;
            echo "<div class='ebook'>";
            //Añadimos la imagen a la paguina con la etiqueta img de HTML
            echo "<img src=../img/".$row['img']." alt='".$row['Title']."'>";
            //Añadimos el titulo a la pagina con la etiqueta h2 de HTML
            echo "<div class='desc'id='desc".$i."'><p>".$row['Description']."</p></div>";
            echo "</div>";
            if ($i%3=='0'){
              echo "<div style='clear:both;'><div>";
            }
          }
        }else {
          echo "0 resultados";
        }     
        
      ?>
    </div>
  </div>
  
  <div class="column right">
    <?php
    include '../services/connection.php';
    $resul = mysqli_query($conn, "SELECT Books.Title FROM Books WHERE Top = 1");
    echo "<h2>Side</h2>";
    if (!empty($resul) && mysqli_num_rows($resul) > 0) {
      while ($row = mysqli_fetch_array($resul)) {
        //Añadimos el titulo del libro en topventas con la etiqueta h2 de HTML
        echo "<p>".$row['Title']."</p>";
      }
    }else {
      echo "0 resultados";
    }
    ?>
  </div>
</div>
  
</body>
</html>
