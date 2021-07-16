<?php

function menu($productimg, $producttitle, $productSummary, $productoldprice, $productprice, $productid){
    $element = "
    
    <div class='col-md-3 col-sm-6 my-3 my-md-0'>
        <form action='index.php' method='post'>
        <div class='card shadow'>
                <div>
                    <img src='$productimg' alt='Iphone' class='img-fluid card-img-top'>
                </div>
            <div class='card-body'>
                <h5 class='card-title'>$producttitle</h5>
                <h6>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='far fa-star'></i>
                </h6>
                <p class='card-text'>$productSummary</p>
                <h5>
                <small><s class='text-secondary'>$$productoldprice</s></small> 
                <span class='price'>$$productprice</span>
                </h5>
                <button type='submit' class='btn btn-success my-3' name='add'>Add to Cart <i class='fas fa-shopping-cart'></i></button>
                <input type='hidden' name='product_id' value='$productid'>
            </div> 
        </div>
        </form>
    </div>";   
    echo $element;
    
}


function cartElement($productimg, $producttitle, $productSummary, $productoldprice, $productprice, $productid){
    $element="

        <form action='cartlist.php?action=remove&id=$productid' method='post' class='cart-items'>
                        <div class='border rounded'>
                            <div class='row bg-white'>
                                <div class='col-md-3 pl-0'>
                                    <img src='$productimg' alt='camera' class='img-fluid'>
                                </div>
                                <div class='col-md-6'>
                                    <h5 class='pt-2'>$producttitle</h5>
                                    <small class='text-secondary'>$productSummary</small>
                                    <h5 class='pt-2 text-secondary'>$$productoldprice</h5>
                                    <h5 class='pt-2'>$$productprice</h5>
                                    <button type='submit' class='btn btn-warning'>Save for Later</button>
                                    <button type='submit' name='remove' class='btn btn-danger mx-2'>Remove</button>
                                </div>
                                <div class='col-md-3 py-5'>
                                    <div>
                                        <button type='button' onclick='autoDecrement()' class='btn bg-light border rounded-circle'><i class='fas fa-minus'></i></button>
                                        <input type='text' id='inc' value='1' class='form-control w-25 d-inline'>
                                        <button type='button' onclick='buttonClick()' class='btn bg-light border rounded-circle'><i class='fas fa-plus'></i></button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
        </form>
    
    ";
    echo $element;
}
?>