<?php
	
	// All Queries

	$allProducts = 'SELECT * 
		FROM product
		INNER JOIN price
		ON product.productID = price.productID
		ORDER BY product.productID
		';
	$allShops = 'SELECT * FROM shop
		ORDER BY shopID
		';
	$allShopkeepers = 'SELECT */*skID, skEmail, skName, skContact, shop.shopName */
		FROM shopkeeper
		/* INNER JOIN shop
		ON shopkeeper.skID = shop.shopID */
		ORDER BY skID
	';

	$selectedProductID = "
		SELECT product.productType, product.productName, product.productImage, product.productModel, product.productColor, 
		shop.shopName, product.productID, price.price 
		FROM product 
		INNER JOIN price 
		ON product.productID = price.productID 
		INNER JOIN shop 
		ON price.shopID = shop.shopID
		WHERE product.productID = ";

	/*
	$searchedProduct = "
		SELECT shop.shopName, price.price, product.productID, product.productName, product.productType, product.productModel, product.productColor
		FROM shop 
		INNER JOIN price
		ON shop.shopID = price.shopID
		INNER JOIN product
		ON price.productID  =product.productID
		INNER JOIN inventory 
		ON product.productID = inventory.productID AND product.productName LIKE 'Samsung%'
		ORDER BY price.price";

	*/

	$availableShopIDQuery = "
		SELECT shop.shopID
		FROM shop
		LEFT JOIN shopkeeper
		ON shop.shopID = shopkeeper.shopID
		WHERE shopkeeper.shopID IS NULL";
?>	
