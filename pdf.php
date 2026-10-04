<?php
include "db.php";
require "vendor/autoload.php";
$result=$conn->query ("select*from products");
$pdf=new TCPDF();
$pdf->AddPage();
$pdf->setFont("times","I","12");
$html='<table border="1" style="background-color:yellow;">
    <tr>
    <td>Product id</td>
    <td>Product name</td>
    <td>Category</td>
    <td>Price</td>
    <td>Quantity</td>
    <td>Supplier name</td>

    
    </tr>';
while($row=$result->fetch_assoc()){
    $html.='<tr>
    <td>'.$row ["p_id"].'</td>
    <td>'.$row ["p_name"].'</td>
    <td>'.$row ["category"].'</td>
    <td>'.$row ["price"].'</td>
    <td>'.$row ["quantity"].'</td>
    <td>'.$row ["s_name"].'</td>
    </tr>';

}
$html.='</table>';
$pdf->writehtml($html,true,false,true,false,'');
$pdf->Output("Products.pdf");
?>