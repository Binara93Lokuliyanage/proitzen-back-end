<?php 
  class Product {
     // DB stuff
     private $conn;
 
     // product Properties
     public $sku;
     public $name;
     public $price;
     public $type;

     // Constructor with DB
    public function __construct($db, $sku, $name, $price, $type) {
      $this->conn = $db;
      $this->sku = $sku;
      $this->name = $name;
      $this->price = $price;
      $this->type = $type;
    }
    // List Products
    public function listProducts() {
      // Create query
      $query = 'SELECT sku, name, price, type, size, dimention, weight
                                FROM product WHERE
                                  is_active = "t" ORDER BY created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function massDelete() {
      $qryAddProduct = 'UPDATE product SET is_active = "f" WHERE sku = :sku';
            
  
      // Prepare statement
      $stmtAddProduct = $this->conn->prepare($qryAddProduct);
      
      // Clean data
      $this->sku = htmlspecialchars(strip_tags($this->sku));
  
      // Bind data
      $stmtAddProduct->bindParam(':sku', $this->sku);
  
      // Execute query
      $stmtAddProduct->execute();
  
      return true;
    }
  }
  
  class DVD extends Product {

    public $size;

    public function __construct($db, $sku, $name, $price, $type, $size) {
      $this->conn = $db;
      $this->sku = $sku;
      $this->name = $name;
      $this->price = $price;
      $this->type = $type;
      $this->size = $size;
    }
      // add product
    public function addProduct() {
      // search for sku exxistence
      $searchSku = 'SELECT count(*) sku FROM product WHERE sku = :sku AND is_active = "t"';     

      // Prepare statement
      $stmtSearchSku = $this->conn->prepare($searchSku);
      
      // Clean data
      $this->sku = htmlspecialchars(strip_tags($this->sku));

      // Bind data
      $stmtSearchSku->bindParam(':sku', $this->sku);

      // Execute query
      $stmtSearchSku->execute();
        $resultSku = implode(', ', $stmtSearchSku->fetch(PDO::FETCH_ASSOC));

      
      if($resultSku === '0') {
         // insert to t_contact and count rows
      $qryAddProduct = 'INSERT INTO product SET sku = :sku, name = :name, price = :price, type = :type, size = :size, is_active = "t"';
      

      // Prepare statement
      $stmtAddProduct = $this->conn->prepare($qryAddProduct);
      
      // Clean data
      $this->sku = htmlspecialchars(strip_tags($this->sku));
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->price = htmlspecialchars(strip_tags($this->price));
      $this->type = htmlspecialchars(strip_tags($this->type));
      $this->size = htmlspecialchars(strip_tags($this->size));

      // Bind data
      $stmtAddProduct->bindParam(':sku', $this->sku);
      $stmtAddProduct->bindParam(':name', $this->name);
      $stmtAddProduct->bindParam(':price', $this->price);
      $stmtAddProduct->bindParam(':type', $this->type);
      $stmtAddProduct->bindParam(':size', $this->size);

      // Execute query
      $stmtAddProduct->execute();

      return true;
  } else {
      return false;
  }
    }
}

class Furniture extends Product {

  public $dimention;

  public function __construct($db, $sku, $name, $price, $type, $dimention) {
    $this->conn = $db;
    $this->sku = $sku;
    $this->name = $name;
    $this->price = $price;
    $this->type = $type;
    $this->dimention = $dimention;
  }
    // add product
  public function addProduct() {
    // search for sku exxistence
    $searchSku = 'SELECT count(*) sku FROM product WHERE sku = :sku AND is_active = "t"';     

    // Prepare statement
    $stmtSearchSku = $this->conn->prepare($searchSku);
    
    // Clean data
    $this->sku = htmlspecialchars(strip_tags($this->sku));

    // Bind data
    $stmtSearchSku->bindParam(':sku', $this->sku);

    // Execute query
    $stmtSearchSku->execute();
      $resultSku = implode(', ', $stmtSearchSku->fetch(PDO::FETCH_ASSOC));

    
    if($resultSku === '0') {
       // insert to t_contact and count rows
    $qryAddProduct = 'INSERT INTO product SET sku = :sku, name = :name, price = :price, type = :type, dimention = :dimention, is_active = "t"';
    

    // Prepare statement
    $stmtAddProduct = $this->conn->prepare($qryAddProduct);
    
    // Clean data
    $this->sku = htmlspecialchars(strip_tags($this->sku));
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->type = htmlspecialchars(strip_tags($this->type));
    $this->dimention = htmlspecialchars(strip_tags($this->dimention));

    // Bind data
    $stmtAddProduct->bindParam(':sku', $this->sku);
    $stmtAddProduct->bindParam(':name', $this->name);
    $stmtAddProduct->bindParam(':price', $this->price);
    $stmtAddProduct->bindParam(':type', $this->type);
    $stmtAddProduct->bindParam(':dimention', $this->dimention);

    // Execute query
    $stmtAddProduct->execute();

    return true;
} else {
    return false;
}
  }
}

class Book extends Product {

  public $weight;

  public function __construct($db, $sku, $name, $price, $type, $weight) {
    $this->conn = $db;
    $this->sku = $sku;
    $this->name = $name;
    $this->price = $price;
    $this->type = $type;
    $this->weight = $weight;
  }
    // add product
  public function addProduct() {
    // search for sku exxistence
    $searchSku = 'SELECT count(*) sku FROM product WHERE sku = :sku AND is_active = "t"';     

    // Prepare statement
    $stmtSearchSku = $this->conn->prepare($searchSku);
    
    // Clean data
    $this->sku = htmlspecialchars(strip_tags($this->sku));

    // Bind data
    $stmtSearchSku->bindParam(':sku', $this->sku);

    // Execute query
    $stmtSearchSku->execute();
      $resultSku = implode(', ', $stmtSearchSku->fetch(PDO::FETCH_ASSOC));

    
    if($resultSku === '0') {
       // insert to t_contact and count rows
    $qryAddProduct = 'INSERT INTO product SET sku = :sku, name = :name, price = :price, type = :type, weight = :weight, is_active = "t"';
    

    // Prepare statement
    $stmtAddProduct = $this->conn->prepare($qryAddProduct);
    
    // Clean data
    $this->sku = htmlspecialchars(strip_tags($this->sku));
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->type = htmlspecialchars(strip_tags($this->type));
    $this->weight = htmlspecialchars(strip_tags($this->weight));

    // Bind data
    $stmtAddProduct->bindParam(':sku', $this->sku);
    $stmtAddProduct->bindParam(':name', $this->name);
    $stmtAddProduct->bindParam(':price', $this->price);
    $stmtAddProduct->bindParam(':type', $this->type);
    $stmtAddProduct->bindParam(':weight', $this->weight);

    // Execute query
    $stmtAddProduct->execute();

    return true;
} else {
    return false;
}
  }
}