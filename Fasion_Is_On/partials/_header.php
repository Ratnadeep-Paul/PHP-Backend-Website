<?php

echo '<section class="Header">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="logo" src="./imgs/logo.png" alt="Fasion Is On"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="products.php?gen=Men">Men Fasion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="products.php?gen=Women"">Women Fasion</a>
            </ul>
            <span class="extras"> <label onclick="toggleHide()" for="option"> </label>
            <input type="checkbox" name="option" id="option"></span>
        </div>
    </div>
</nav>
<div id="under-header" style="display:none;">
            <a href="items.php?id=Shoes&gen=Men" class="options">Men Shoes</a>
            <a href="items.php?id=Shirts&gen=Men" class="options">Men Shirts</a>
            <a href="items.php?id=Pants&gen=Men" class="options">Men Pants</a>
            <a href="items.php?id=Dresses&gen=Women" class="options">Women Dresses</a>
            <a href="items.php?id=T-Shirts&gen=Women" class="options">Women T-Shirts</a>
            <a href="items.php?id=Shoes&gen=Women" class="options">Women Shoes</a>
            </div>
    
</section>';

