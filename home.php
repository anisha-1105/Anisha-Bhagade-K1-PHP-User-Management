<?php
include "db.php";
session_start();

$u_id=$_SESSION["u_id"];
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $p_name=$_POST["p_name"];
    $category=$_POST["category"];
    $price=$_POST["price"];
    $quantity=$_POST["quantity"];
    $s_name=$_POST["s_name"];
    $sql=$conn->prepare("insert into products(p_name,category,price,quantity,s_name,uid) values(?,?,?,?,?,?)");
    $sql->bind_param('ssdisi',$p_name,$category,$price,$quantity,$s_name,$u_id);
    if($sql->execute()){
        header("Location:home.php");
    }
}
$sql=$conn->prepare("select*from products where uid=?");
$sql->bind_param("i",$u_id);
$sql->execute();

$result=$sql->get_result();


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
            <nav
                class="navbar navbar-expand-sm navbar-light bg-light"
            >
                <div class="container">
                    <h2>Hello, <?php echo $_SESSION["name"]?></h2>
                    
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                         
                         
                           

                        </ul>
                        <form class="d-flex  my-2 my-lg-0" action="pdf.php">
                           
                            <button
                                class="btn btn-outline-success my-2 my-sm-0"
                                type="submit"
                            >
                                Download Pdf
                            </button>
                            <a
                                name=""
                                id=""
                                class="btn btn-primary ms-2"
                                href="logout.php"
                                role="button"
                                >Logout</a
                            >
                            
                        </form>
                    </div>
                </div>
            </nav>
            
        </header>
        <main>
          <div
                class="container text-center mt-5"
            >
                <h2>Insert Products</h2>
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
                />
                <label for="formId1">Supplier Name</label>
               </div>
               <button
                type="submit"
                class="btn btn-primary"
               >
                Submit
               </button>
            </form>
             </div>
            <div
                class="container col-6 mt-5"
            >
                <div
                    class="table-responsive"
                >
                    <table
                        class="table table-primary"
                    >
                            <tr>
                                <td>P_id</td>
                                <td>P_name</td>
                                <td>Category</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Supplier Name</td>
                                <td>Edit</td>
                                <td>Delete</td>

                            </tr>
                       <?php while($row=$result->fetch_assoc()){?>
                        <tr>
                        <td><?php echo $row ["p_id"]?></td>
                        <td><?php echo $row ["p_name"]?></td>
                        <td><?php echo $row ["category"]?></td>
                        <td><?php echo $row ["price"]?></td>
                        <td><?php echo $row ["quantity"]?></td>
                        <td><?php echo $row ["s_name"]?></td>  
                        <td><a href="edit.php?p_id=<?= $row["p_id"] ?>" class="btn btn-success btn-sm">Edit </a> </td>
                        <td><a href="delete.php?p_id=<?=$row["p_id"]?>"  class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete </a></td>
                       </tr>
                       <?php } ?>
                    </table>
                </div>             
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
