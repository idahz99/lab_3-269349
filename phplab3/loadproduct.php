<?php
include_once("dbconnector.php");
 $searchproduct = $_POST['searchedpr'];
 
 if($searchproduct == "allproducts"){
    $sqlloadproducts = "SELECT * FROM table_products ORDER BY product_id DESC ";

     
 }
     else{
         $sqlloadproducts = "SELECT * FROM table_products WHERE product_name LIKE '%$searchproduct%' ORDER BY product_id DESC ";
      
     }
 
   
  //$sqlloadproducts= "SELECT * FROM table_products ORDER BY product_id DESC ";
  $result = $conn->query($sqlloadproducts);
if ($result->num_rows > 0){
    $response["products"] = array();
    while ($row = $result -> fetch_assoc()){
        $prlist = array();
        $prlist[productid] = $row['product_id'];
        $prlist[productname] = $row['product_name'];
        $prlist[productdescription ]= $row['product_description'];
        $prlist[productprice] = $row['product_price'];
        $prlist[productquantity] = $row['product_quantity'];
       // $prlist[datecreated] = $row['datecreated'];
       
       array_push($response["products"],$prlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}