<header id="header">
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <a href="index.php" class="navbar-brand">
             <h3 class="px-5">
                 <i class="fas fa-shopping-basket"></i>Shopping Cart
             </h3>
         </a>
         <button class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarNavAltMarkup" 
            aria-controls= "navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation">
            
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto">
                <div class="navbar-nav">
                    <a href="cartlist.php" class="nav-item nav-link active">
                        <h5 class="px-5 cart" style="margin-left:550px;">
                            <i class="fas fa-shopping-cart"></i>Cart
                        <?php
                        if(isset($_SESSION['cart'])){
                            $count= count($_SESSION['cart']);
                            echo "<span id='cart_count' class='text-warning bg-light'>$count</span>";
                        }else{
                            echo  "<span id='cart_count' class='text-warning bg-light'>0</span>";
                        }
                        ?>
                            
                        </h5>
                    </a>
                </div>
            </div>
        
                <a href="login.php" style="color:white; margin-left:20px;">Logout</a>
           
           
         </div>
    </nav>  
</header>