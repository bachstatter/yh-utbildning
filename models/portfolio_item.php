<?php

class PortfolioItem extends BaseModel
{
  // Anger vad tabellen i databasen heter flör denna klass
  const TABLE_NAME = 'portfolioItems';

  // Skapar en variable för varje kolumn i databasen.
  public $id,
         $title,
         $content,
         $categoryId;

  public function __construct(array $attributes = null) {
    // Om ingen array skickades med och värdet är null så kör vi inte våran loop
    // för att sätta värden
    if ($attributes === null) return;

    // Loopar igenom arrayen som skickades med
    foreach ($attributes as $key => $value) {
      // Om $attributes är `array('id' => 1, 'title' => 'Hej');` så kommer $key
      // att vara id första gången och title andra gången
      $this->$key = $value;
    }
  }

  private static $url = '/portfolio_items';

  /**
   * Url där vi visar portfolio itemet för användaren
   *
   * @return string
   */
  public function url() {
    return "/portfolio_item.php?id=" . $this->id;
  }

  public static function indexUrl() {
    return self::$url;
  }

  /**
   * Url där jag som administratör redigerar portfolio itemet
   *
   * @return string
   */
  public function adminEditUrl() {
    return '/admin/portfolio/edit.php?id=' . $this->id;
  }

  /**
   * Sparar nuvarande portfolio item i databasen. Denna methoden är inte kapabel
   * att skapa en ny rad i databasen. Det behöver vi skapa en annan metod för.
   */
  public function save() {
    // Förbereder mysql kommando
    $statement = self::$dbh->prepare(
      "UPDATE ".self::TABLE_NAME." SET title=:title,
                                       content=:content,
                                       categoryId=:categoryId
                                       WHERE id=:id");
    // Exekverar mysql kommando
    $statement->execute(array('id' => $this->id,
                              'title' => $this->title,
                              'content' => $this->content,
                              'categoryId' => $this->categoryId
                             ));
  }

}
