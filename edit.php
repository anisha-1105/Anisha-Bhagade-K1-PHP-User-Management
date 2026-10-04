<?php
include "db.php";
if(isset($_GET["p_id"])){
    $p_id=$_GET["p_id"];
    $sql=$conn->prepare("select*from products where p_id=?");
    $sql->bind_param("i",$p_id);
    $sql->execute();
    $user=$sql->get_result()->fetch_assoc();
}
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $p_name=$_POST["p_name"];
    $category=$_POST["category"];
    $price=$_POST["price"];
    $quantity=$_POST["quantity"];
    $s_name=$_POST["s_name"];
    $sql=$conn->prepare("update products set p_name=?,category=?,price=?,quantity=?,s_name=? where p_id=?");
    $sql->bind_param( "ssdisi", $p_name,$category, $price, $quantity,$s_name, $p_id );
   
    if($sql->execute()){
        header("Location:home.php");
    }
}
?>



<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
          
            
        </header>
        <main>
          <div
                class="container text-center mt-5"
            >
                <h2>Update Products</h2>
            </div>
            <div
                class="container col-5"
            >
            <form method="POST">
               <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="p_name"
                    id="formId1"
                    placeholder=""
                    value="<?=$user['p_name']?>"
                />
                <label for="formId1">Product Name</label>
               </div>
               <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="category"
                    id="formId1"
                    placeholder=""
                      value="<?=$user['category']?>"
                />
                <label for="formId1">Product Category</label>
               </div>
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="price"
                    id="formId1"
                    placeholder=""
                    value="<?=$user['price']?>"
                />
                <label for="formId1">Product Price</label>
               </div>
                
                <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="quantity"
                    id="formId1"
                    placeholder=""
                      value="<?=$user['quantity']?>"
                />
                <label for="formId1">Product Quantity</label>
               </div>
               <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="s_name"
                    id="formId1"
                    placeholder=""
                      value="<?=$user['s_name']?>"
                />
                <label for="formId1">Supplier Name</label>
               </div>
               <button
                type="submit"
                class="btn btn-primary"
               >
                Update
               </button>
            </form>
             </div>
     
        </main>
        <footer>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
