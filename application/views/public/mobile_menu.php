<!--Sidemenu
============================== -->
<div class="sidemenu-wrapper sidemenu-cart ">
	<div class="sidemenu-content">
		<button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
		<div class="widget woocommerce widget_shopping_cart">
			<h3 class="widget_title">Shopping cart</h3>
			<div class="widget_shopping_cart_content">
				<ul class="woocommerce-mini-cart cart_list product_list_widget ">
					<li class="woocommerce-mini-cart-item mini_cart_item">
						<a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
						<a href="#"><img src="<?php echo base_url(); ?>assets/public/assets/img/product/product_thumb_1_1.png" alt="Cart Image">Books</a>
						<span class="quantity">1 ×
							<span class="woocommerce-Price-amount amount">
								<span class="woocommerce-Price-currencySymbol">$</span>940.00</span>
						</span>
					</li>
					<li class="woocommerce-mini-cart-item mini_cart_item">
						<a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
						<a href="#"><img src="<?php echo base_url(); ?>assets/public/assets/img/product/product_thumb_1_2.png" alt="Cart Image">Medicine</a>
						<span class="quantity">1 ×
							<span class="woocommerce-Price-amount amount">
								<span class="woocommerce-Price-currencySymbol">$</span>899.00</span>
						</span>
					</li>
					<li class="woocommerce-mini-cart-item mini_cart_item">
						<a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
						<a href="#"><img src="<?php echo base_url(); ?>assets/public/assets/img/product/product_thumb_1_3.png" alt="Cart Image">Dress</a>
						<span class="quantity">1 ×
							<span class="woocommerce-Price-amount amount">
								<span class="woocommerce-Price-currencySymbol">$</span>756.00</span>
						</span>
					</li>
					<li class="woocommerce-mini-cart-item mini_cart_item">
						<a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
						<a href="#"><img src="<?php echo base_url(); ?>assets/public/assets/img/product/product_thumb_1_4.png" alt="Cart Image">Chair</a>
						<span class="quantity">1 ×
							<span class="woocommerce-Price-amount amount">
								<span class="woocommerce-Price-currencySymbol">$</span>723.00</span>
						</span>
					</li>
					<li class="woocommerce-mini-cart-item mini_cart_item">
						<a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
						<a href="#"><img src="<?php echo base_url(); ?>assets/public/assets/img/product/product_thumb_1_5.png" alt="Cart Image">Cloths</a>
						<span class="quantity">1 ×
							<span class="woocommerce-Price-amount amount">
								<span class="woocommerce-Price-currencySymbol">$</span>1080.00</span>
						</span>
					</li>
				</ul>
				<p class="woocommerce-mini-cart__total total">
					<strong>Subtotal:</strong>
					<span class="woocommerce-Price-amount amount">
						<span class="woocommerce-Price-currencySymbol">$</span>4398.00</span>
				</p>
				<p class="woocommerce-mini-cart__buttons buttons">
					<a href="cart.html" class="th-btn wc-forward">View cart</a>
					<a href="checkout.html" class="th-btn checkout wc-forward">Checkout</a>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="popup-search-box d-none d-lg-block">
	<button class="searchClose"><i class="far fa-times"></i></button>
	<form action="#">
		<input type="text" placeholder="What are you looking for?">
		<button type="submit"><i class="fal fa-search"></i></button>
	</form>
</div><!--==============================
    Mobile Menu
  ============================== -->
<div class="th-menu-wrapper">
	<div class="th-menu-area text-center">
		<button class="th-menu-toggle"><i class="fal fa-times"></i></button>
		<div class="mobile-logo">
			<a href="<?php echo base_url(); ?>" class="php">PC ISNU Jombang</a>
			<!-- <a href="index.html"><img src="<?php echo base_url(); ?>assets/public/assets/img/logo.svg" alt="Donat"></a> -->
		</div>
		<div class="th-mobile-menu">
			<ul>
				<li class="menu-item-has-children">
					<a href="index.html">Home</a>
					<ul class="sub-menu">
						<li class="menu-item-has-children">
							<a href="#">Multipage</a>
							<ul class="sub-menu">
								<li><a href="index.html">Home One</a></li>
								<li><a href="home-2.html">Home Two</a></li>
								<li><a href="home-3.html">Home Three</a></li>
							</ul>
						</li>
						<li class="menu-item-has-children">
							<a href="#">Onepage</a>
							<ul class="sub-menu">
								<li><a href="home-1-op.html">Home One</a></li>
								<li><a href="home-2-op.html">Home Two</a></li>
								<li><a href="home-3-op.html">Home Three</a></li>
							</ul>
						</li>
						<li class="menu-item-has-children">
							<a href="#">RTL</a>
							<ul class="sub-menu">
								<li><a href="home-1-rtl.html">Home One</a></li>
								<li><a href="home-2-rtl.html">Home Two</a></li>
								<li><a href="home-3-rtl.html">Home Three</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="about.html">About Us</a></li>
				<li class="menu-item-has-children">
					<a href="#">Donations</a>
					<ul class="sub-menu">
						<li><a href="donation.html">Donations</a></li>
						<li><a href="donation-details.html">Donation Details</a></li>
						<li><a href="donate-now.html">Donate Now</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children">
					<a href="#">Pages</a>
					<ul class="sub-menu">
						<li class="menu-item-has-children">
							<a href="#">Shop</a>
							<ul class="sub-menu">
								<li><a href="shop.html">Shop</a></li>
								<li><a href="shop-details.html">Shop Details</a></li>
								<li><a href="cart.html">Cart Page</a></li>
								<li><a href="checkout.html">Checkout</a></li>
								<li><a href="wishlist.html">Wishlist</a></li>
							</ul>
						</li>
						<li><a href="team.html">Volunteers</a></li>
						<li><a href="team-details.html">Volunteer Details</a></li>
						<li><a href="add-team.html">Become A Volunteer</a></li>
						<li><a href="gallery.html">Gallery</a></li>
						<li><a href="pricing.html">Pricing</a></li>
						<li><a href="faq.html">FAQS</a></li>
						<li><a href="testimonial.html">Testimonials</a></li>
						<li><a href="error.html">Error Page</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children">
					<a href="#">Blog</a>
					<ul class="sub-menu">
						<li><a href="blog.html">Blog</a></li>
						<li><a href="blog-details.html">Blog Details</a></li>
					</ul>
				</li>
				<li>
					<a href="contact.html">Registrasi</a>
				</li>
			</ul>
		</div>
	</div>
</div>