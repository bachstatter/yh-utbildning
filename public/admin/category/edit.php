<?php

require_once '../../../application.php';

Authorization::checkOrRedirect();

if(isset($_POST['category'])) {
  $category = new Category($_POST['category']);
  $category->save();

  header('Location: /admin/category/edit.php?id=' . $category->id);
  exit;
} else {
  $category = Category::find($_GET['id']);
}

require_once ROOT_PATH . '/header.php';

?>

  <h1>Edit: <?php echo $category->name; ?></h1>
<form method="POST">
  <input type="hidden" name="category[id]" value="<?php echo $category->id; ?>">

  <div class="form-group">
    <label for="name">Namn</label>
    <input type="text" id="name" name="category[name]" value="<?php echo $category->name; ?>" class="form-control">
  </div>
  <input type="submit" name="submit" value="Skapa" class="btn">
</form>
<br>
<?php require_once ROOT_PATH . '/footer.php'; ?>
