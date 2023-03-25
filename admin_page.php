<?php include 'session.php';?>
<?php
session_start();
?>
<?php   
  
        // Connect to DB
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);

         // Check connection
         if ($conn->connect_error)
         {
             echo "<h1>not connected</h1>";
         }

         else
         {
             // Prepare the statement:
             // get all Product details
             $stmt = $conn->prepare("SELECT * FROM Group2.Product");

             $stmt->execute();

             $result = $stmt->get_result();
             $rows = $result->fetch_all(MYSQLI_ASSOC);
         }
 ?>

<!DOCTYPE html>
<html lang="en">
<?php 
    include "head.inc.php";
    ?>
    <body>
        <?php
        include "nav.inc.php";
        ?>
<body>
    <!-- Bootstrap row -->
    <div class="row" id="body-row">
        <!-- Sidebar -->
        <!-- Main -->
        <main class="col p-4 d-block" style="overflow: auto;">
            


                <!-- Admin -->
                <div class="tab-pane fade show active" id="show-home" role="tabpanel" aria-label="pills-home-tab">
                    <h3>Product Overview</h3>
                    <button class="btn btn-primary" data-bs-toggle="tab" data-bs-target="#show-new" role="tab" aria-controls="show-new" aria-selected="true">Add New Products</button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product id</th>
                                    <th scope="col">Product name</th>
                                    <th scope="col">Product image</th>
                                    <th scope="col">Product Description</th>
                                    <th scope="col">Product Category</th>
                                    <th scope="col">Product Quantity</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row) { ?>
                                    <tr>
                                    <th scope="row"><?php echo $row["Product_id"] ?></th>
                                    
                                    <td><?php echo $row["Product_name"] ?></td>
                                    <td><img src="<?php echo $row['Product_image'] ?>" alt="<?php echo $row["Product_name"] ?>" class="product-img-view" style="max-width: 12em;max-height: 50%;"></td>
                                    <td><?php echo $row["Product_desc"] ?></td>
                                    <td><?php echo $row["Product_category"] ?></td>
                                    <td><?php echo $row["Product_qty"] ?></td>
                                    <td>$<?php echo $row["Product_price"] ?></td>
                                    <td>
                                        <!-- <a href="update.php?id=<?php echo $row["Product_id"] ?>" class="btn btn-sm btn-outline-primary mb-2">Update</a> -->
                                        <form method="post" action="" style= "display: inline-block">
                                            <input  type="hidden" name="delete_inventory_id" value="<?php echo $row["Product_id"] ?>"/>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--new product form for admins-->
                <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
                    <h1>Add New Products</h1>
                    <form action="process_adding.php" method="post" enctype="multipart/form-data">
                    <div class="row justify-content-around">
                            <div class="col-sm-7">
                                <!-- Group left  -->
                                <div class="form-group">
                                    <label for="create_product" >Product Name</label><br>
                                    <input type="text" class="form-control" id="Product_name" name="Product_name"
                                        placeholder="Name of product" required>
                                    <br>
                                    <label for="description">Description</label><br>
                                    <textarea style="width:100%;" minlength="1" maxlength="1024" type="text" id="Product_desc" name="Product_desc" placeholder="Description of Product" rows="5" cols="30" required></textarea>
                                    <!-- <input type="text" class="form-control" id="description" placeholder="Description of Product" required> -->
                                </div>

                                <!-- UPLOAD IMAGE -->
                                <div class="custom-file pb-3">
                                    <input type="file" class="custom-file-input" id="Product_image" name="Product_image" required>
                                    <label class="custom-file-label" for="picture"><i class="fas fa-image fa-fw"></i></label>
                                </div>

                            </div>
                            <div class="col-sm-5">
                                <!-- CATEGORY DROPDOWN -->
                                <div class="form-group">
                                    <div class="dropdown show">
                                        <label for="create_brand">Select Category</label>
                                        <div href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <select id="Product_category" name="Product_category" class="btn btn-light dropdown-toggle" required>
                                                <option selected disabled>Select a category</option>
                                                <option class="dropdown-item whiteText" value="Stainless_Steel">Stainless_Steel</option>
                                                <option class="dropdown-item whiteText" value="Glass">Glass</option>
                                                <option class="dropdown-item whiteText" value="Insulated">Insulated</option>
                                                <option class="dropdown-item whiteText" value="BPA-free ">BPA-free</option>
                                                <option class="dropdown-item whiteText" value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                               

                                <!-- QUANTITY -->
                                <div class="form-group">
                                    <label for="create_quantity">Quantity</label>
                                    <input type="number" class="form-control" id="Product_qty"
                                        name="Product_qty" placeholder="Enter Quantity" min="0" step="1" required>
                                </div>

                                <!-- PRICE -->
                                <div class="form-group">
                                    <label for="create_price">Price</label>
                                    <input type="number" min="1" step="0.01" class="form-control" id="Product_price"
                                        name="Product_price" placeholder="Price" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        
                    
                    </form>
                </div>

    </body>
</html>
