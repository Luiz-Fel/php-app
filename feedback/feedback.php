<?php include 'inc/header.php'; ?>
<?php 
  $sql = 'SELECT * FROM feedback';
  $result = mysqli_query($conn, $sql);
  $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
   
    <h2>Past Feedback</h2>

    <?php if(empty($feedback)): //geralmente fazemos dessa forma os ifs quando estamos usando HTML ?>
      <p class="lead mt3">There is no feedback</p>
    <?php endif; ?>  

    <?php foreach($feedback as $item): ?>
      <div class="card my-3 w-75">
      <div class="card-body text-center">
        <?php echo $item['body'] ?>
        <div class="text-secondary mt-2">
          By <?php echo $item['name']?> on <?php echo $item['date'];?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
   
 <?php include 'inc/footer.php'; ?>

