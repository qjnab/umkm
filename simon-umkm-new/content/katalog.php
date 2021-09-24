<?php 
$produk = $db->manual_query("select * from produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h2 class="description-header">Katalog</h2>
			</div>
			<div class="card-body">
				<div class=”port-gallery”>
					<div class=”filterizr-control”>
						<ul class=”filterizr-filter”>
						    <li class=”filtr-active” data-filter=”all”>All Categories</li>
						    <li data-filter=”1″>Web Design</li>
						    <li data-filter=”2″>Front-end Dev</li>
						    <li data-filter=”4″>Codeigniter</li>
						</ul>
						<ul class=”filterizr-sorting”>
						    <li>
						    	<span>Sort by :</span>
						    	<select data-sortOrder>
						        	<option value=”title”> Title </option>
						    	</select>
						    </li>
						    <li class=”filtr-active” data-sortAsc>Asc</li>
						    <li data-sortDesc>Desc</li>
						    <li data-shuffle>Random</li>
						</ul>
					</div>
					<div class=”filtr-container”>
						<div class=”filtr-item” data-category=”2″ data-title=”128 Web – HTML Website Template”>
						    <img src=”https://www.devaradise.com/id/wp-content/uploads/sites/4/2018/07/128-web-300×171.jpg” alt=”128 Web Website Template” />
						    <div class=”desc”><a href=”https://lab.devaradise.com/128web” target=”_blank” rel=”noopener”>128 Web – HTML Website Template</a></div>
						</div>
						<div class=”filtr-item” data-category=”4″ data-title=”Website BLK Bekasi”>
						    <img src=”https://www.devaradise.com/id/wp-content/uploads/sites/4/2018/07/blkbekasi-300×171.jpg” alt=”Website BLK Bekasi” />
						    <div class=”desc”><a href=”#” target=”_blank” rel=”noopener nofollow”>Website BLK Bekasi</a></div>
						</div>…
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>