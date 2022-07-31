<?php 
  class Employees {
     // DB stuff
     private $conn;
 
     // employees Properties
     public $emp_no;
     public $birth_date;
     public $first_name;
     public $last_name;
     public $gender;
     public $hire_date;

     // Constructor with DB
    public function __construct($db, $emp_no, $birth_date, $first_name, $last_name, $gender, $hire_date) {
      $this->conn = $db;
      $this->emp_no = $emp_no;
      $this->birth_date = $birth_date;
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->gender = $gender;
      $this->hire_date = $hire_date;
    }
    // List Employees
    public function listEmployees() {
      // Create query
      $query = 'SELECT emp_no, birth_date, first_name, last_name, gender, hire_date
                FROM employees 
                ORDER BY hire_date ASC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function addEmployee() {
      
         // insert to t_contact and count rows
      $query = 'INSERT INTO employees SET birth_date = :birth_date, first_name = :first_name, last_name = :last_name, gender = :gender, hire_date = :hire_date';
      

      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      // Clean data
      $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
      $this->first_name = htmlspecialchars(strip_tags($this->first_name));
      $this->last_name = htmlspecialchars(strip_tags($this->last_name));
      $this->hire_date = htmlspecialchars(strip_tags($this->hire_date));
      $this->gender = htmlspecialchars(strip_tags($this->gender));

      // Bind data
      $stmt->bindParam(':birth_date', $this->birth_date);
      $stmt->bindParam(':first_name', $this->first_name);
      $stmt->bindParam(':last_name', $this->last_name);
      $stmt->bindParam(':hire_date', $this->hire_date);
      $stmt->bindParam(':gender', $this->gender);

      // Execute query
      $stmt->execute();

      return true; 
  }
  public function updateEmployee() {    
    // insert to t_contact and count rows
 $query = 'UPDATE employees 
            SET birth_date = :birth_date, first_name = :first_name, last_name = :last_name, gender = :gender, hire_date = :hire_date
            WHERE emp_no = :emp_no';
 

 // Prepare statement
 $stmt = $this->conn->prepare($query);
 
 // Clean data
 $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
 $this->first_name = htmlspecialchars(strip_tags($this->first_name));
 $this->last_name = htmlspecialchars(strip_tags($this->last_name));
 $this->hire_date = htmlspecialchars(strip_tags($this->hire_date));
 $this->gender = htmlspecialchars(strip_tags($this->gender));
 $this->emp_no = htmlspecialchars(strip_tags($this->emp_no));

 // Bind data
 $stmt->bindParam(':birth_date', $this->birth_date);
 $stmt->bindParam(':first_name', $this->first_name);
 $stmt->bindParam(':last_name', $this->last_name);
 $stmt->bindParam(':hire_date', $this->hire_date);
 $stmt->bindParam(':gender', $this->gender);
 $stmt->bindParam(':emp_no', $this->emp_no);

 // Execute query
 $stmt->execute();

 return true; 
}
}
  class Titles extends Employees {

    public $title;
    public $from_date;
    public $to_date;

    public function __construct($db, $emp_no, $title, $from_date, $to_date) {
      $this->conn = $db;
      $this->emp_no = $emp_no;
      $this->title = $title;
      $this->from_date = $from_date;
      $this->to_date = $to_date;
    }
      
    public function getTitlesByEmployee() {
        // Create query
        $query = 'SELECT emp_no, title, from_date, to_date
                  FROM titles 
                  WHERE emp_no = :emp_no
                  ORDER BY from_date DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->emp_no = htmlspecialchars(strip_tags($this->emp_no));

        // Bind data
        $stmt->bindParam(':emp_no', $this->emp_no);
        
       
  
        // Execute query
        $stmt->execute();
        return $stmt;
      }
      public function addTitle() {
        // search for sku exxistence
        $countEmp = 'SELECT count(*) emp_no FROM employees';     
  
        // Prepare statement
        $stmtCountEmp = $this->conn->prepare($countEmp);
  
        // Execute query
        $stmtCountEmp->execute();
        
        $resultCount = implode(', ', $stmtCountEmp->fetch(PDO::FETCH_ASSOC));
        if($this->emp_no == null || $this->emp_no == ''){
          $resultCount = $resultCount;
        }
        else {
          $resultCount = $this->emp_no;
        }
        if($this->to_date == '' || $this->to_date == null){
            // insert to t_contact and count rows
          $query = 'INSERT INTO titles SET emp_no = '. $resultCount .', title = :title, from_date = :from_date';
        } else {
            // insert to t_contact and count rows
          $query = 'INSERT INTO titles SET emp_no = '. $resultCount .', title = :title, from_date = :from_date, to_date = :to_date';
        }
  
         
        
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->emp_no = htmlspecialchars(strip_tags($this->emp_no));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->from_date = htmlspecialchars(strip_tags($this->from_date));
        $this->to_date = htmlspecialchars(strip_tags($this->to_date));
        $this->resultCount = htmlspecialchars(strip_tags($resultCount));
        
  
        // Bind data
        
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':from_date', $this->from_date);
        
        if($this->to_date != '' || $this->to_date != null){
          $stmt->bindParam(':to_date', $this->to_date);
        }
  
        // Execute query
        $stmt->execute();
  
        return true;
    
}
public function deleteTitle() {
  // Create query
  $query = 'DELETE FROM titles 
            WHERE emp_no = :emp_no AND title = :title AND from_date = :from_date';

  // Prepare statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->emp_no = htmlspecialchars(strip_tags($this->emp_no));
  $this->title = htmlspecialchars(strip_tags($this->title));
  $this->from_date = htmlspecialchars(strip_tags($this->from_date));

  // Bind data
  $stmt->bindParam(':emp_no', $this->emp_no);
  $stmt->bindParam(':title', $this->title);
  $stmt->bindParam(':from_date', $this->from_date);

  // Execute query
  $stmt->execute();
  return $stmt;
}
  }
  class Salaries extends Employees {

    public $salary;
    public $from_date;
    public $to_date;

    public function __construct($db, $emp_no, $salary, $from_date, $to_date) {
      $this->conn = $db;
      $this->emp_no = $emp_no;
      $this->salary = $salary;
      $this->from_date = $from_date;
      $this->to_date = $to_date;
    }
      
    public function getSalariesByEmployee() {
        // Create query
        $query = 'SELECT emp_no, salary, from_date, to_date
                  FROM salaries 
                  WHERE emp_no = :emp_no
                  ORDER BY from_date DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->emp_no = htmlspecialchars(strip_tags($this->emp_no));

        // Bind data
        $stmt->bindParam(':emp_no', $this->emp_no);
        
       
  
        // Execute query
        $stmt->execute();
        return $stmt;
      }
      public function addSalary() {
        // search for sku exxistence
        $countEmp = 'SELECT count(*) emp_no FROM employees';     
  
        // Prepare statement
        $stmtCountEmp = $this->conn->prepare($countEmp);
  
        // Execute query
        $stmtCountEmp->execute();
        
        $resultCount = implode(', ', $stmtCountEmp->fetch(PDO::FETCH_ASSOC));
        if($this->emp_no == null || $this->emp_no == ''){
          $resultCount = $resultCount;
        }
        else {
          $resultCount = $this->emp_no;
        }
        if($this->to_date == '' || $this->to_date == null){
          $query = 'INSERT INTO salaries SET emp_no = '. $resultCount .', salary = :salary, from_date = :from_date';
        } else {
          $query = 'INSERT INTO salaries SET emp_no = '. $resultCount .', salary = :salary, from_date = :from_date, to_date = :to_date';
        }
  
           // insert to t_contact and count rows
        
        
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->emp_no = htmlspecialchars(strip_tags($this->emp_no));
        $this->salary = htmlspecialchars(strip_tags($this->salary));
        $this->from_date = htmlspecialchars(strip_tags($this->from_date));
        $this->to_date = htmlspecialchars(strip_tags($this->to_date));
        $this->resultCount = htmlspecialchars(strip_tags($resultCount));
        
  
        // Bind data
        
        $stmt->bindParam(':salary', $this->salary);
        $stmt->bindParam(':from_date', $this->from_date);

        if($this->to_date != '' || $this->to_date != null){
          $stmt->bindParam(':to_date', $this->to_date);
        }
  
        // Execute query
        $stmt->execute();
  
        return true;
    
}
public function deleteSalary() {
  // Create query
  $query = 'DELETE FROM salaries 
            WHERE emp_no = :emp_no AND from_date = :from_date';

  // Prepare statement
  $stmt = $this->conn->prepare($query);
  
  // Clean data
  $this->emp_no = htmlspecialchars(strip_tags($this->emp_no));
  $this->from_date = htmlspecialchars(strip_tags($this->from_date));

  // Bind data
  $stmt->bindParam(':emp_no', $this->emp_no);
  $stmt->bindParam(':from_date', $this->from_date);

  // Execute query
  $stmt->execute();
  return true;
}
}
