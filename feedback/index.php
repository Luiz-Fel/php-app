<?php include 'inc/header.php'; //usa pra importar arquivos php de outros lugares (como o import do javascript) 
// também dá pra usar o require mas ele vai acionar erro se não achar, o inlcude só não vai mostrar
// também dá pra usar o require once, mesmo esquema mas se já tiver importado antes ele não importa
?> 
<?php 
  $name = $email = $body = '';
  $nameErr = $emailErr = $bodyErr = '';

  //form submit
  if(isset($_POST['submit'])) {
    if(empty($_POST['name'])) {
      $nameErr = 'A name is required';
    } else {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if(empty($_POST['email'])) {
      $emailErr = 'An e-mail is required';

    } else {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if(empty($_POST['body'])) {
      $bodyErr = 'A feedback is required';
    } else {
      $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }


    if(empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
      // adicionar para o banco de dados
      $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name', '$email', '$body')";
      if(mysqli_query($conn, $sql)) {
        //success
        header('Location: feedback.php');
      } else {
        //error
        echo 'Error: ' . mysqli_error($conn);
      }
    }
  }

?>

    <img src="/php-app/feedback/img/logo.png" class="w-25 mb-3" alt="logo">
    <h2>Feedback</h2>
    <p class="lead text-center">Leave feedback for Traversy Media</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>" id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
          <?php echo $nameErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
          <?php echo $emailErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null; ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
          <?php echo $bodyErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
<?php include 'inc/footer.php'; ?>
