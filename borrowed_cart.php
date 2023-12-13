<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/S_header.php'; ?>

<style>
        .item-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .item {
			position: relative;
            width: 24%; /* Adjusted to account for the gap */
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            border: 1px solid #ddd; /* Border added */
			cursor: pointer;
        }
		.item.selected {
			border: 2px solid #5cb85c;
		}

        .item img {
            max-width: 100%;
            border: 1px solid #ddd; /* Border added */}
			.item-container .item span {
				padding: 0 12px;
			}
			.close {
				position: absolute;
				top: 12px;
				right: 15px;
				color: red;
			}
			.button-container {
				display: flex;
				justify-content: end;
			}
    </style>


<div class="row">
	<div class="col-md-12">
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Borrowed Cart</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
    
				<div id="item-container" class="item-container">
					<div class="item "><img src="assests/images/stock/66505733264b93d799de39.png" alt="Crucible Tong" style="max-width: 100%;"><p>Crucible Tong</p><button onclick="borrowItem(4)"> Add to Borrowed Cart</button></div>
				</div>
				</div> <!-- /div-action -->				
				

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
	<div class="col-md-12 button-container">
		<button type="button" class="btn btn-success" onclick="borrowItems()"> Borrow Selected Items </button>
	</div>
</div> <!-- /row -->


<script>
	let globalProducts = []
        // Function to fetch products from the PHP script and render them
        async function fetchAndRenderProducts() {
            try {
                // Make a fetch request to the PHP script
                const response = await fetch('php_action/getProducts.php');

                // Check if the request was successful (status code 200)
                if (response.ok) {
                    // Parse the JSON response
                    const products = await response.json();

					const cart = JSON.parse(localStorage.getItem("cart")) || [];

					const updatedProducts = products.map(item => {
						const product = cart.find(i => i.product_id == item.product_id)
						
						if(product) {
							return {
								...item,
								cartQuantity: product.quantity,
								selected: product.selected
							}
						}

						return item
					})

					globalProducts = updatedProducts
					console.log(globalProducts)
                    // Render the products
                    renderProducts(globalProducts);
                } else {
                    // Log an error message if the request was not successful
                    console.error('Failed to fetch products. Status: ' + response.status);
                }
            } catch (error) {
                // Log any other errors that may occur
                console.error('Error:', error);
            }
        }

        // Function to render products in the item container
        function renderProducts(products) {
            const itemContainer = document.getElementById('item-container');

            // Clear existing content in the container
            itemContainer.innerHTML = '';

            // Loop through the products and create HTML elements for each
            products.forEach(product => {
				if(product.cartQuantity) {
					const itemDiv = document.createElement('div');
					itemDiv.classList.add('item');

					if(product.selected) {
						itemDiv.classList.add('selected');
					}

					const img = document.createElement('img');
					img.src = product.product_image;
					img.alt = product.product_name;
					img.style.maxWidth = '100%';

					const p = document.createElement('p');
					p.textContent = product.product_name + " x " + product.quantity;

					const pQty = document.createElement('span');
					pQty.textContent = product.cartQuantity;

					const button = document.createElement('button');
					button.textContent = '-';
					button.addEventListener('click', function (e) {
						e.stopPropagation();
						minus(product.product_id);
					});

					const button2 = document.createElement('button');
					button2.textContent = '+';
					button2.addEventListener('click', function (e) {
						e.stopPropagation();
						add(product.product_id, product.quantity);
					});

					const button3 = document.createElement('button');
					button3.textContent = 'x';
					button3.addEventListener('click', function (e) {
						e.stopPropagation();
						remove(product.product_id);
					});
					button3.classList.add("close")

					// Append elements to the item container
					itemDiv.appendChild(img);
					itemDiv.appendChild(p);
					itemDiv.appendChild(button);
					itemDiv.appendChild(pQty);
					itemDiv.appendChild(button2);
					itemDiv.appendChild(button3);
					itemContainer.appendChild(itemDiv);

					itemDiv.addEventListener('click', function () {
						toggleSelected(product.product_id);
					});
				}
            });
        }

        // Call the fetchAndRenderProducts function
        fetchAndRenderProducts();


		function add(productId, currentProductQuantity){

			const cart = JSON.parse(localStorage.getItem("cart")) || [];
			const index = cart.findIndex(item => item.product_id ==	 productId)
			const updatedCart = cart.map((item, i) => {
					if(i === index && item.quantity < currentProductQuantity) {
						return {
							...item,
							quantity: item.quantity + 1
						}
					}
				return item
			})
			localStorage.setItem("cart", JSON.stringify(updatedCart));

			const updatedProducts = globalProducts.map(item => {
						const product = cart.find(i => i.product_id == item.product_id)

						if(product) {
							return {
								...item,
								cartQuantity: product.quantity,
								selected: product.selected
							}
						}

						return item
					})

			renderProducts(updatedProducts)
    	}

		function minus(productId){
			const cart = JSON.parse(localStorage.getItem("cart")) || [];
			const prod = cart.find(item => item.product_id == productId)
			if (prod.quantity == 0 ) {
				if(!confirm("Are you sure you want to remove this item?")) {
					return
				}
				
			} 

			const index = cart.findIndex(item => item.product_id == productId)
			const updatedCart = cart.map((item, i) => {
					if(i === index && item.quantity > 0) {
						return {
							...item,
							quantity: item.quantity - 1
						}
					}
				return item
			})
			localStorage.setItem("cart", JSON.stringify(updatedCart));

			const updatedProducts = globalProducts.map(item => {
						const product = cart.find(i => i.product_id == item.product_id)

						if(product) {
							return {
								...item,
								cartQuantity: product.quantity,
								selected: product.selected
							}
						}

						return item
					})
			
			renderProducts(updatedProducts)
		}

		function remove(productId){
			const cart = JSON.parse(localStorage.getItem("cart")) || [];

			const prod = cart.find(item => item.product_id == productId)
			const updatedCart = cart.filter((item) => item.product_id != productId)

			localStorage.setItem("cart", JSON.stringify(updatedCart));

			const updatedProducts = globalProducts.filter((item) => item.product_id != productId)

			globalProducts = updatedProducts;
			
			renderProducts(updatedProducts)
		}

		function toggleSelected(productId) {
			const cart = JSON.parse(localStorage.getItem("cart")) || [];
			const index = cart.findIndex(item => item.product_id ==	 productId)
			const updatedCart = cart.map((item, i) => {
					if(i === index) {
						return {
							...item,
							selected: !item.selected
						}
					}
				return item
			})
			localStorage.setItem("cart", JSON.stringify(updatedCart));

			const updatedProducts = globalProducts.map(item => {
						const product = cart.find(i => i.product_id == item.product_id)
						if(product) {
							return {
								...item,
								cartQuantity: product.quantity,
								selected: !product.selected
							}
						}

						return item
					})

			renderProducts(updatedProducts)
		}

		function borrowItems(){

			const cart = JSON.parse(localStorage.getItem("cart")) || [];

			const selectedCartItems = cart.filter(item => item.selected);

			if(selectedCartItems.length === 0) {
				alert("Please select items to borrow");
				return;
			}

			const orderItems = globalProducts
					.filter(item => selectedCartItems.find(i => i.product_id == item.product_id))
					.map(item => {
						const product = selectedCartItems.find(i => i.product_id == item.product_id)
						
						if(product) {
							return {
								product_id: item.product_id,
								quantity: product.quantity,
								brand: item.brand_id,
							}
						}

						return item
					})

				const user = JSON.parse(localStorage.getItem("user")) || {};

				const postData = {
					user_data: {
						userId: user.user_id,
						email: user.email
						
					},
					order_items: orderItems,
				};

				// Your PHP script URL
				const phpScriptUrl = 'php_action/createOrderAPI.php';

				// Send the POST request
				fetch(phpScriptUrl, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify(postData),
				})
				.then(response => response.json())
				.then(result => {
					// Handle the response from the server
					const remainingCartItems = cart.filter(item => !item.selected);
					localStorage.setItem("cart", JSON.stringify(remainingCartItems));
					fetchAndRenderProducts();
					alert("Order Placed");
				})
				.catch(error => {
					// Handle any errors that occurred during the fetch
					console.log("error", error)
					alert(error);
				});
			}
</script>
