<?php
session_start();
include 'db_con.php';

if(isset($_POST['submit-button'])){

    $productType= $_POST['product'];
    $quantity= $_POST['quantity'];
    $size= $_POST['size'];
    $productFile= $_POST['fileID'];
    $details= $_POST['details'];
    $orderType= ($_POST['priority']) ? 2 : 1;
    $price= $_POST['total'];

   $sql = "INSERT INTO `orders`(`productType`, `quantity`, 
   `size`, `productFile`, `details`, `orderType`, `price`) VALUES 
   (' $productType','$quantity','$size','$productFile','$details','$orderType','$price')";

    $result= mysqli_query($conn, $sql);

    if(!($result)){
        die(mysqli_error($conn));
    } else{
        header("Location: confirm.html");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\orderform.css">
    <!-- <script type="text/javascript" src="..\js\orderform.js"></script> -->
    <link rel="icon" type="image/x-icon" href="smartpress.png">
        <link rel="stylesheet" href="..\css\navbar.css">
        <link rel="stylesheet" href="..\css\footer.css">
        <!-- icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <!-- font styles -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
        <link rel="icon" href="..\images\smartpress.png" type="image/x-icon">
    <title>Order Form | Smartpress</title>
</head>
<body>
    <div class="navbar">
        <nav>
            <div class="nav-logo"><a href="..\php-html\home.php"><img src="..\images\smartpress.png" alt=""></a></div>
            <div class="printing-services"><a href="..\php-html\orderform.html">Printing Services</a></div>
            <div class="community">
                <select id="community-dropdown" onchange="location = this.value">
                    <option value="" disabled selected>Community</option>
                    <option value="..\php-html\About_Us.html">About Us</option>
                    <option value="..\php-html\Contact_Us.html">Contact Us</option>
                    <option value="..\php-html\FAQs.html">FAQs</option> <!-- kini nlang-->
                </select>
            </div>
            <div class="profile"><a href="..\php-html\profile-page.html"><i class="fa-regular fa-user"></i></a></div>        
        </nav>
    </div>
    <div class="container">
        <div class="form-container">
            <form id="orderForm" action="#" method="post">
                <!-- action: ..\php-html\confirm.html -->
                <div class="form-group">
                    <select name="product" id="product" placeholder="Product type">
                        <option value="" disabled selected hidden>Product type</option>
                        <option value="Tarpaulin">Tarpaulin</option>
                        <option value="Stickers">Stickers</option>
                        <option value="Brochures">Brochures</option>
                        <option value="Flyers">Flyers</option>
                        <option value="Menus">Menus</option>
                        <option value="Posters">Posters</option>
                        <option value="Business Cards">Business Cards</option>
                        <option value="T-Shirts">T-Shirts</option>
                        <option value="Signages">Signages</option>
                        <option value="Billboard">Billboard</option>
                        <option value="Calling Cards">Calling Cards</option>
                    </select>
                    <input type="number" placeholder="Qty" id="quantity" name="quantity">
                    <input type="text" id="size" name="size" placeholder="Size (WidthxHeight) in cm. If T-shirtS (XS,S,M,L,XL)">
                </div>
                <div class="form-group">
                        <div class="card">
                            <div class="drop_box">
                                <header>
                                    <h4>Upload File</h4>
                                </header>
                                <p>Files Supported: PDF, PNG, JPG</p>
                                <input type="file" hidden accept=".doc,.docx,.pdf,.png,.jpg" id="fileID" name="fileID">
                                <button type="button" class="btn" id="uploadButton">Choose File</button>
                            </div>
                        </div>
                        <div class="details">
                            <textarea placeholder="More details" id="details" name="details"></textarea>
                        </div>
                </div>
                <br>
                <div class="proz">
                    <input type="checkbox" id="priority" name="priority" value="prio">
                    <label for="priority">Make Priority</label>
                    <p style="font-size: x-small;">(costs more, lesser wait for your order)</p>
                    <br>
                    <div class="total" style="display:flex;flex-direction:row;">
                        <p>Total: Php </p>
                        <p id="total"> </p>
                    </div>
                    <br>
                </div>
                <div>
                    <button type="submit" class="submit-button" id="submit-button" name="submit-button">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
      <!-- footer -->
      <div class="footer-container">
        <div class="socials">
            <div class="footer-logo">
                <img src="..\images\smartpress.png" alt="">
            </div>
            
            <div class="social-media-links">
                <div class="fb">
                    <i class="fa-brands fa-facebook fa-2x"></i>
                </div>
                <div class="twitter">
                    <i class="fa-brands fa-square-twitter fa-2x"></i>
                </div>
                <div class="instagram">
                    <i class="fa-brands fa-square-instagram fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="footer-help">
            <h4 id="footer-help-title">Help</h4>

            <a href="..\php-html\Contact_Us.html">Contact Us</a>
            <a href="..\php-html\FAQs.html">FAQs</a>
        </div>

        <div class="footer-about">
            <h4 id="footer-about-title">About</h4>

            <a href="..\php-html\About_Us.html">About Us</a>
            <a href="..\php-html\About_Us.html">Our Process</a>
        </div>
    </div>
    <!-- temporary script -->
     <script>
        document.getElementById('uploadButton').addEventListener('click', function() {
            document.getElementById('fileID').click();
        });

        document.getElementById('fileID').addEventListener('change', function() {
            var fileName = this.files[0].name;
            var uploadButtonText = document.getElementById('uploadButton');
            uploadButtonText.textContent = fileName;
        });

        document.querySelector('.submit-button').addEventListener('click', function(event) {
            document.getElementById('orderForm').submit();
        });

        function calculateAmount() {
            var quantityType = parseFloat(document.getElementById("quantity").value) || 0;
            var productType = document.getElementById("product").value;
            // var total = productType * quantityType;
            var total = 0.00;
            document.getElementById("total").innerHTML = total;
            var prod;

            if(productType === "Tarpaulin"){
                prod = 100.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Brochures"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            } else if(productType === "Stickers"){
                prod = 20.00;
            }
            

            total = prod * quantityType;
            document.getElementById("total").innerHTML = total;
            document.getElementById("totalPrice").value = total;
        }

        document.getElementById("quantity").addEventListener("input", calculateAmount);
        document.getElementById("product").addEventListener("change", calculateAmount);
     </script>
</body>
</html>
