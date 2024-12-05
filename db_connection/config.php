<?php 

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {
  
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "rishatech_db";
  private $conn;

  public function __construct() {
      try {
          $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
          // Handle the exception here if needed
      }
  }

  public function getConnection() {
      return $this->conn;
  }

  //------------------------------------------------------------ADMIN PAGE CODE----------------------------------------------//


//------------------------------------------------------------------------------------------------------ADMIN LOGIN
public function adminLogin($username) {
    $connection = $this->getConnection();
    
    $stmt = $connection->prepare("SELECT * FROM admin_account WHERE username=?");
    $stmt->execute([$username]);
    
    // Fetch the hashed password from the database
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
        
    }
    
    
    //------------------------------------------------------------------------------------------------------SELECT ADMIN WHERE EMAIL
    public function selectAdmin_email($email) {
        $connection = $this->getConnection();
        
        $stmt = $connection->prepare("SELECT * FROM admin_account WHERE email=?");
        $stmt->execute([$email]);
        
        // Fetch the hashed password from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
            
        }
    
    
    //------------------------------------------------------------------------------------------------------SELECT ADMIN WHERE EMAIL AND OTP CODE
    public function selectAdminOTP_Code($email, $otp_code) {
        $connection = $this->getConnection();
        
        $stmt = $connection->prepare("SELECT * FROM admin_account WHERE email=? AND verification_code = ?");
        $stmt->execute([$email, $otp_code]);
        
        // Fetch the hashed password from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
            
        }
    
    //------------------------------------------------------------------------------------------------------SELECT ADMIN WHERE EMAIL AND USERNAME
    public function selectAdmin_email_username($username, $email) {
        $connection = $this->getConnection();
        
        $stmt = $connection->prepare("SELECT * FROM admin_account WHERE email=? AND username = ?");
        $stmt->execute([$email, $username]);
        
        // Fetch the hashed password from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
            
    }
    

    //------------------------------------------------------------------------------------------------------SELECT ADMIN WHERE EMAIL AND USERNAME
    public function selectAdmin_id($admin_id) {
        $connection = $this->getConnection();
        
        $stmt = $connection->prepare("SELECT * FROM admin_account WHERE id=?");
        $stmt->execute([$admin_id]);
        
        // Fetch the hashed password from the database
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
            
    }
    
    
    //------------------------------------------------------------------------------------------------------UPDATE OTP CODE WHERE EMAIL
    public function updateAdminOTP_code($email, $verification_code) {
    $connection = $this->getConnection();
    
    $stmt = $connection->prepare("UPDATE admin_account SET verification_code = ? WHERE email=?");
    $result = $stmt->execute([$verification_code, $email]);
    
    return $result;
        
    }
    
    //------------------------------------------------------------------------------------------------------UPDATE ADMIN PASSWORD
    public function updateAdminPassword($hashed_password, $email) {
        $connection = $this->getConnection();
        
        $stmt = $connection->prepare("UPDATE admin_account SET password = ? WHERE email=?");
        $result = $stmt->execute([$hashed_password, $email]);
        
        return $result;
            
        }
    
    //------------------------------------------------------------------------------------------------------UPDATE ADMIN VERIFY STATUS
    public function updateAdminVerifyStatus($email, $status) {
        $connection = $this->getConnection();
        
        $stmt = $connection->prepare("UPDATE admin_account SET verify_status = ? WHERE email=?");
        $result = $stmt->execute([$status, $email]);
        
        return $result;
            
        }
    


    //------------------------------------------------------------------------------------------------------UPDATE ADMIN INFORMATION
    public function updateAdmin($username, $full_name, $admin_id) {
        $connection = $this->getConnection();
        
        $stmt = $connection->prepare("UPDATE admin_account SET username = ?, full_name = ? WHERE id = ?");
        $stmt->execute([$username, $full_name, $admin_id]);
    
        // Check if any row was affected
        if ($stmt->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    


    //-------------------------------------------------------------------------------------------------------REGISTER ADMIN
    public function insertAdminAccount($username, $full_name, $email, $hashed_password, $status) {
        $connection = $this->getConnection();
    
        $stmt = $connection->prepare("INSERT INTO admin_account(username, full_name, email, password, verify_status) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$username, $full_name, $email, $hashed_password, $status]);
    
        return $result;
    }
    

    



//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------














//---------------------------------------------------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------------SELECT ALL CATEGORY
public function selectAllCategory() {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM category");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//-------------------------------------------------------------------------------------------------------ADD CATEGORY
public function insertCategory($admin_id, $category_name) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("INSERT INTO category(admin_id, cat_name) VALUES (?, ?)");
    $result = $stmt->execute([$admin_id, $category_name]);

    return $result;
}

//-----------------------------------------------------------------------------------------------------UPDATE CATEGORY
public function updateCategory($Category_name, $category_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE category SET cat_name = ? WHERE id = ? ");
    $result = $stmt->execute([$Category_name, $category_id]);

    return $result;
}

//-----------------------------------------------------------------------------------------------------DELETE CATEGORY
public function deleteCategory($category_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM category WHERE id = ? ");
    $result = $stmt->execute([$category_id]);

    return $result;
}







//---------------------------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------SELECT ALL APPLIANCES
public function selectAllappliances() {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT *, appliances.id AS AppliancesID, category.id AS cat_id FROM appliances 
                                    LEFT JOIN category ON appliances.category_id = category.id
                                    LEFT JOIN brands ON appliances.brand_id = brands.id");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


//-------------------------------------------------------------------------------------------------------SELECT ALL APPLIANCES WHERE CATEGORY ID
public function selectAllappliancesWHERECat_ID($category_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT *, appliances.id AS AppliancesID, category.id AS cat_id FROM appliances 
    LEFT JOIN category ON appliances.category_id = category.id WHERE appliances.category_id = ?");
    $stmt->execute([$category_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//-------------------------------------------------------------------------------------------------------SELECT ALL APPLIANCES
public function selectAppliances($appliances_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT *, appliances.id AS AppliancesID, category.id AS cat_id FROM appliances 
    LEFT JOIN category ON appliances.category_id = category.id WHERE appliances.id = ?");
    $stmt->execute([$appliances_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}


//-------------------------------------------------------------------------------------------------------SELECT COUNT ALL APPLIANCES
public function countAllAppliances($status) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT COUNT(*) FROM appliances WHERE status = ?");
    $stmt->execute([$status]);

    $result = $stmt->fetchColumn();

    return $result;
}

//-------------------------------------------------------------------------------------------------------SELECT COUNT ALL APPLIANCES
public function selectAllItemsQty($qty) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM appliances WHERE qty <= ?");
    $stmt->execute([$qty]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


//-------------------------------------------------------------------------------------------------------ADD APPLIANCES
public function insertAppliances($admin_id, $appliance_name, $category, $brand, $price, $quantity, $unit_measurement, $status) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("INSERT INTO appliances(admin_id, appliances_name, category_id, brand_id, price, qty, unit_measurement, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([$admin_id, $appliance_name, $category, $brand, $price, $quantity, $unit_measurement, $status]);

    return $result;
}

//-----------------------------------------------------------------------------------------------------UPDATE APPLIANCES
public function updateAppliances($appliances_id, $appliance_name, $category,$brand, $price, $quantity, $unit_measurement, $status) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE appliances SET appliances_name = ?, category_id = ?, brand_id = ?, price = ?, qty = ?, unit_measurement = ?, status = ? WHERE id = ? ");
    $result = $stmt->execute([$appliance_name, $category, $brand, $price, $quantity, $unit_measurement, $status, $appliances_id]);

    return $result;
}


//-----------------------------------------------------------------------------------------------------UPDATE APPLIANCES QUANTITY
public function updateAppliances_qty($qty, $appliances_id) {
    $connection = $this->getConnection();

    // Correct SQL query to subtract the quantity
    $stmt = $connection->prepare("UPDATE appliances SET qty = qty - ? WHERE id = ?");
    $result = $stmt->execute([$qty, $appliances_id]);

    return $result;
}


//-----------------------------------------------------------------------------------------------------DELETE APPLIANCES
public function deleteAppliances($appliances_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM appliances WHERE id = ? ");
    $result = $stmt->execute([$appliances_id]);

    return $result;
}




//---------------------------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------SELECT ALL CUSTOMERS
public function selectAllCustomers() {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM customers");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

//-------------------------------------------------------------------------------------------------------SELECT COUNT ALL CUSTOMERS
public function countAllCustomers() {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT COUNT(*) FROM customers");
    $stmt->execute();

    $result = $stmt->fetchColumn();

    return $result;
}



//-------------------------------------------------------------------------------------------------------ADD CUSTOMER
public function insertCustomer($admin_id, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("INSERT INTO customers(admin_id, full_name, complete_address, municipality, barangay, street_name, email, phone_number, age, civil_status, citizenship) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([$admin_id, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship]);

    return $result;
}


//-----------------------------------------------------------------------------------------------------UPDATE CUSTOMER
public function updateCustomer($customer_id, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE customers SET full_name = ?, complete_address = ?, municipality = ?, barangay = ?, street_name = ?, email = ?, phone_number = ?, age = ?, civil_status = ?, citizenship = ? WHERE id = ? ");
    $result = $stmt->execute([$full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship, $customer_id]);

    return $result;
}

//-----------------------------------------------------------------------------------------------------DELETE ROOMS
public function deleteCustomer($customer_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM customers WHERE id = ? ");
    $result = $stmt->execute([$customer_id]);

    return $result;
}







//------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------UPLOAD CUSTOMER REQUIREMENTS
public function uploadFiles($customer_id, $admin_id, $valid_id_upload_path, $twoby2_pic_upload_path, $brgy_clearance_upload_path, $cedula_upload_path, $proof_of_billing_upload_path, $application_for_credit_upload_path) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("INSERT INTO requirements(admin_id, customer_id, valid_id, twoBytwo_pic, brgy_clearance, cedula, proof_of_billing, application_form_credit) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([$admin_id, $customer_id, $valid_id_upload_path, $twoby2_pic_upload_path, $brgy_clearance_upload_path, $cedula_upload_path, $proof_of_billing_upload_path, $application_for_credit_upload_path]);

    return $result;
}


//-------------------------------------------------------------------------------------------------------SELECT CUSTOMER REQUIREMENTS
public function selectRequirements($customer_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM requirements WHERE customer_id = ?");
    $stmt->execute([$customer_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//-------------------------------------------------------------------------------------------------------DELETE CUSTOMER REQUIREMENTS
public function deleteRequirements($customer_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM requirements WHERE customer_id = ?");
    $result = $stmt->execute([$customer_id]);

    return $result;
}

//-------------------------------------------------------------------------------------------------------DELETE CUSTOMER REQUIREMENTS
public function deleteRequirements_id($req_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM requirements WHERE id = ?");
    $result = $stmt->execute([$req_id]);

    return $result;
}






//-------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------ADD SALES
public function insertCustomerSales($admin_id, $customer_id, $appliances_id, $qty, $total_price_plus_interest, $discount, $payment_type, $payment_method, $transaction_number, $months_to_pay, $monthly_payment, $downpayment, $interest, $status, $currentDate) {
    $connection = $this->getConnection();
    
    // Prepare the SQL query
    $stmt = $connection->prepare("INSERT INTO sales(admin_id, customer_id, appliances_id, qty, total_sales, discount_promotion, payment_type, payment_method, transaction_number, months_to_pay, monthly_payment, downpayment, interest_rate, status, date_created) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Execute the query and check if it was successful
    if ($stmt->execute([$admin_id, $customer_id, $appliances_id, $qty, $total_price_plus_interest, $discount, $payment_type, $payment_method, $transaction_number, $months_to_pay, $monthly_payment, $downpayment, $interest, $status, $currentDate])) {
        // Return the last inserted sales ID if the query was successful
        return $connection->lastInsertId();
    } else {
        // Return false if the query failed
        return false;
    }
}


public function insertCustomerCreditPayment($lastInserted_ID, $customer_id, $due_date) {
    $connection = $this->getConnection();
    
    // Prepare the SQL query
    $stmt = $connection->prepare("INSERT INTO customer_credit_payment(sales_id, customer_id, payment_date) 
                                  VALUES (?, ?, ?)");

    // Execute the query and check if it was successful
    if ($stmt->execute([$lastInserted_ID, $customer_id, $due_date])) {
        // Return the last inserted sales ID if the query was successful
        return $connection->lastInsertId();
    } else {
        // Return false if the query failed
        return false;
    }
}



//-------------------------------------------------------------------------------------------------------UPDATE SALES STATUS
public function updateSales_fully_paid($status, $sales_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE  sales SET status = ? WHERE id = ? ");
    $result = $stmt->execute([$status, $sales_id]);

    return $result;
}

//-------------------------------------------------------------------------------------------------------UPDATE SALES STATUS
public function updateSales_fully_paid1($status1, $sales_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE  sales SET status = ? WHERE id = ? ");
    $result = $stmt->execute([$status1, $sales_id]);

    return $result;
}


//-------------------------------------------------------------------------------------------------------ADD SALES
public function uploadReceipt($sales_id, $receipts_upload_path) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE sales SET cash_receipt = ? WHERE id = ?");
    $stmt->execute([$receipts_upload_path, $sales_id]);

    // Check if any rows were affected
    if ($stmt->rowCount() > 0) {
        return true; // Return true if at least one row was updated
    } else {
        return false; // Return false if no rows were updated
    }
}




//-------------------------------------------------------------------------------------------------------SELECT ALL SALES FULLY PAID CHART
public function selectAllSales_FULLYPaid_AreaChart($status){
    $connection = $this->getConnection();
        
    $stmt = $connection->prepare("SELECT 
            DATE_FORMAT(date_created, '%M %Y') AS month_year, 
            SUM(total_sales) AS total_sales 
        FROM sales 
        WHERE status = ?
        GROUP BY YEAR(date_created), MONTH(date_created)
        ORDER BY YEAR(date_created), MONTH(date_created)");
    $stmt->execute([$status]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//-------------------------------------------------------------------------------------------------------SELECT ALL SALES FULLY PAID CHART
public function selectAllSales_COUNT_CASH_CREDIT_PIEChart($status){
    $connection = $this->getConnection();
        
    $stmt = $connection->prepare("SELECT payment_type, COUNT(*) AS count 
        FROM sales 
        WHERE status = ? 
        GROUP BY payment_type");
    $stmt->execute([$status]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//-------------------------------------------------------------------------------------------------------SELECT ALL SALES FOR APPLIANCES
public function selectAllSales_WHERE_APPLIANCES($status){
    $connection = $this->getConnection();
        
    $stmt = $connection->prepare("SELECT 
        appliances.appliances_name AS appliances_name,
        SUM(sales.total_sales) AS total_price
    FROM sales
    LEFT JOIN appliances ON appliances.id = sales.appliances_id
    WHERE sales.status = ?
    GROUP BY sales.appliances_id
    ORDER BY appliances.appliances_name;");
    $stmt->execute([$status]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}



//-------------------------------------------------------------------------------------------------------SELECT ALL SALES
public function selectAllSales(){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT *, sales.id AS Sales_Id, sales.qty AS sales_qty, sales.status AS sales_status FROM sales LEFT JOIN customers ON customers.id = sales.customer_id
    LEFT JOIN appliances ON appliances.id = sales.appliances_id
    LEFT JOIN category ON category.id = appliances.category_id ");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//-------------------------------------------------------------------------------------------------------SELECT ALL WHERE CUSTOMER ID
public function selectSales($customer_id){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT *, sales.id AS Sales_Id, sales.qty AS sales_qty, sales.status AS sales_status FROM sales LEFT JOIN customers ON customers.id = sales.customer_id
    LEFT JOIN appliances ON appliances.id = sales.appliances_id
    LEFT JOIN category ON category.id = appliances.category_id 
    WHERE sales.customer_id = ?");
    $stmt->execute([$customer_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;

}

//-------------------------------------------------------------------------------------------------------SELECT ALL WHERE CUSTOMER ID
public function selectAllSales_WHEREcustomerid($customer_id){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT *, sales.id AS Sales_Id, sales.qty AS sales_qty, sales.status AS sales_status FROM sales LEFT JOIN customers ON customers.id = sales.customer_id
    LEFT JOIN appliances ON appliances.id = sales.appliances_id
    LEFT JOIN category ON category.id = appliances.category_id 
    WHERE sales.customer_id = ?");
    $stmt->execute([$customer_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}

//-------------------------------------------------------------------------------------------------------SELECT ALL SALES WHERE PAYMENT TYPE
public function selectAllSales_PaymentType($payment_type){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT *, sales.id AS Sales_Id, sales.qty AS sales_qty, sales.status AS sales_status, customers.id AS customerID FROM sales LEFT JOIN customers ON customers.id = sales.customer_id
    LEFT JOIN appliances ON appliances.id = sales.appliances_id
    LEFT JOIN category ON category.id = appliances.category_id 
    WHERE sales.payment_type = ?");
    $stmt->execute([$payment_type]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//-------------------------------------------------------------------------------------------------------DELETE CUSTOMER CREDIT PAYMENT
public function deleteSales($customer_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM sales WHERE customer_id = ?");
    $result = $stmt->execute([$customer_id]);

    return $result;
}






//------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------ADD CREDIT PAYMENT
public function insertcredit_payment($sales_id, $customer_id, $payment_date, $amount_paid, $status){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("INSERT INTO customer_credit_payment(sales_id, customer_id, payment_date, amount_paid, payment_status) VALUES (?, ?, ?, ?, ?)");
    
    $result = $stmt->execute([$sales_id, $customer_id, $payment_date, $amount_paid, $status]);

    return $result;
}

//-------------------------------------------------------------------------------------------------------SELECT ALL CREDIT PAYMENT
public function selectCreditPayment_WHERE_salesID($sales_id){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM customer_credit_payment WHERE sales_id = ?");
    $stmt->execute([$sales_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//-------------------------------------------------------------------------------------------------------SELECT ALL CREDIT PAYMENT
public function selectCreditPayment_DueDate($daysBeforeDue){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT customers.full_name as customer_name, sales.monthly_payment as amount_due, customer_credit_payment.payment_date as due_date FROM customer_credit_payment 
    LEFT JOIN sales ON sales.id = customer_credit_payment.sales_id LEFT JOIN customers ON customers.id = customer_credit_payment.customer_id WHERE customer_credit_payment.payment_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL ? DAY)");
    $stmt->execute([$daysBeforeDue]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//-------------------------------------------------------------------------------------------------------SELECT ALL COUNT CREDIT PAYMENT GOOD/BAD PAYER
public function selectCOUNT_PaymentStatus($customer_id){
    $connection = $this->getConnection();

    $stmt = $connection->prepare(" SELECT payment_status, COUNT(*) AS count
    FROM customer_credit_payment
    WHERE customer_id = ?
    GROUP BY payment_status");
    $stmt->execute([$customer_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//--------------------------------------------------------------------------------------------------------COUNT ALL CREDIT PAYMENT WHERE SALES ID
public function count_total_credit_payments($sales_id){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT COUNT(*) as total_payments FROM customer_credit_payment WHERE sales_id = ? AND
     (amount_paid = 0 OR amount_paid IS NULL)
      AND (payment_status = '' OR payment_status IS NULL) ");
    $stmt->execute([$sales_id]);
    $result = $stmt->fetchColumn();

    return $result;

}


//-----------------------------------------------------------------------------------------------------------------------CUSTOMER CREDIT PAYMENT
public function selectAllCreditPaymentDate($sales_id) {
    $connection = $this->getConnection();

    // Modify the query to select the payment date, properly grouping the conditions
    $stmt = $connection->prepare("
        SELECT * 
        FROM customer_credit_payment 
        WHERE sales_id = ? 
        AND (amount_paid = 0 OR amount_paid IS NULL) 
        AND (payment_status = '' OR payment_status IS NULL)
    ");
    $stmt->execute([$sales_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}



public function updatePayment($amount_paid, $status, $id) {
    // Get the database connection
    $connection = $this->getConnection();
    // Prepare the statement
    $stmt = $connection->prepare("UPDATE customer_credit_payment 
              SET amount_paid = ?, payment_status = ? 
              WHERE id = ?");

    // Bind the parameters to the query
    $result = $stmt->execute([$amount_paid, $status, $id]);

    return $result;
}



//-------------------------------------------------------------------------------------------------------DELETE CUSTOMER CREDIT PAYMENT
public function deletecUSTOMERcREDITpayment($customer_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM customer_credit_payment WHERE customer_id = ?");
    $result = $stmt->execute([$customer_id]);

    return $result;
}











//------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------ADD DISCOUNTS AND PROMOTIONS
public function insertDiscount_Promotions(
    $admin_id, $name, $type_of_discount, 
    $downpayment_percentage, $interest_percentage, 
    $eligible, $start_date, $end_date, $terms
) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare( "INSERT INTO discount_promotion ( admin_id, name, type_of_discount, downpayment_percentage, interest_percentage, eligible, start_date, end_date, terms ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)" );

    $result = $stmt->execute([
        $admin_id, $name, $type_of_discount, $downpayment_percentage, 
        $interest_percentage, $eligible, $start_date, 
        $end_date, $terms
    ]);

    return $result;
}

//------------------------------------------------------------------------------------------SELECT ALL DISCOUNTS & PROMOTIONS
public function selectAllDiscountsPromotions(){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM discount_promotion");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}


//------------------------------------------------------------------------------------------SELECT DISCOUNTS & PROMOTIONS WHERE ID
public function selectDiscount_WHEREid($discount){
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM discount_promotion WHERE id = ?");
    $stmt->execute([$discount]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;

}


//-----------------------------------------------------------------------------------------------UPDATE DISCOUNTS AND PROMOTIONS
public function updateDiscountPromotion( $discount_id, $name, $type_of_discount, $downpayment_percentage, $interest_percentage, $eligible, $start_date, $end_date, $terms ) {
    $connection = $this->getConnection();

    // Prepare the update statement
    $stmt = $connection->prepare("UPDATE discount_promotion SET name = ?, type_of_discount = ?, downpayment_percentage = ?, interest_percentage = ?, eligible = ?, start_date = ?, end_date = ?, terms = ? WHERE id = ?");

    // Execute the statement with the provided parameters
    $result = $stmt->execute([$name, $type_of_discount, $downpayment_percentage, $interest_percentage, $eligible, $start_date, $end_date, $terms, $discount_id ]);

    return $result;
}


public function deleteDiscountPromotion($discount_id) {
    $connection = $this->getConnection();

    // Prepare the update statement
    $stmt = $connection->prepare("DELETE FROM discount_promotion WHERE id = ?");

    // Execute the statement with the provided parameters
    $result = $stmt->execute([$discount_id ]);

    return $result;
}


    //-------------------------------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------------------------------
        
/* 
    START OF REVISIONS
    @credits ICTSC.DEVS
*/
public function getTowns() {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM towns");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

public function getBarangays() {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM barangays");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

public function registerCustomer($admin_id, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship, $username, $password) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("INSERT INTO users(username, password, active) VALUES (?, ?, 1)");
    $result = $stmt->execute([$username, $password]);

    $user_id = $connection->lastInsertId();
    
    $stmt = $connection->prepare("INSERT INTO customers(admin_id, full_name, complete_address, municipality, barangay, street_name, email, phone_number, age, civil_status, citizenship, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([$admin_id, $full_name, $complete_address, $municipality, $barangay, $street_name, $email_address, $phoneNumber, $age, $civil_status, $Citizenship, $user_id]);

    return $result;
}

public function getClientUserByUsername($username) {
    $connection = $this->getConnection();   

    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/* 
    BRANDS
*/
public function insertBrand($admin_id, $brand_name) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("INSERT INTO brands(admin_id, brand_name) VALUES (?, ?)");
    $result = $stmt->execute([$admin_id, $brand_name]);

    return $result;
}

public function selectAllBrands() {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM brands");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

public function updateBrand($brand_name, $brand_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE brands SET brand_name = ? WHERE id = ? ");
    $result = $stmt->execute([$brand_name, $brand_id]);

    return $result;
}

public function deleteBrand($brand_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("DELETE FROM brands WHERE id = ? ");
    $result = $stmt->execute([$brand_id]);

    return $result;
}

public function countBrandAppliances($brand_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT COUNT(*) FROM appliances WHERE brand_id = ?");
    $stmt->execute([$brand_id]);

    $result = $stmt->fetchColumn();

    return $result;
}

public function updateCreditLimit($customer_id, $credit_limit) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("UPDATE customers SET credit_limit = ? WHERE id = ? ");
    $result = $stmt->execute([$credit_limit, $customer_id]);    

    return $result;
}

public function getCustomerByID($customer_id) {
    $connection = $this->getConnection();

    $stmt = $connection->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->execute([$customer_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}


}

?>