		<div class="container-fluid page_head">
			<div class="container">
				<div class="row">
					<div class="col-12 pl-0">
						<h1><?php $page_title?></h1>
					</div>
				</div>
			</div>
		</div>	
		<div class="container-fluid page_body">
			<div class="container">
				<div class="row ">
	    			<div class="col-12 col-md-12 px-0">
						<p>
						<small><a href="/"><svg width="16" height="16" viewBox="0 0 16 16"><path d="M3 5v5h3v-3h3v3h3v-5L8,3z"/></svg> &gt;</a>
						 <a href="/blog/">Blog &gt;</a> <?php echo $page_title ?>
						</small>
						</p>
					</div>
				</div>

				<div class="row" style="min-height:500px"> 
			<?php 
			//single post
			if(!empty($blog_post_id)) { ?>


    				<div class="col-12 col-md-8 px-1">   

    					<?php
						foreach ($blog_post_array as $blog_post) {
							if(!empty($blog_post['image'])) { 
								echo "<img src='https://tradeboost.imgix.net/" . $blog_post['image'] . "?w=800&h=400&fit=crop&crop=entropy' style='max-width:100%;padding-bottom:20px;' alt='" . $page_title . "' />"; 
							} 
							echo "<h2>" . $blog_post['title'] . "</h2>";
							echo "<p>" . $blog_post['text'] . "</p><hr/>";							
						}

    					?>
					<br><br>

					</div>		
    				<div class="col-12 col-md-4 blog_post_list"> 
    					<ul>  
    					<?php
						foreach ($blog_array as $blog_post) {
							echo "<li><a href='" . $blog_post['url'] . "'>" . $blog_post['title'] . "</a></li>";
						}

    					?>
    					<ul>
    				</div>	
    		<?php
    		//Blog index page
    		 } else {
				foreach ($blog_array as $blog_post) { ?>
					 <div class="col-12 col-md-4">
					 	<div class="blog_post_grid">
					<?php
						echo "<a href='" . $blog_post['url'] . "'>";
						
						if(!empty($blog_post['image'])) { 
							echo "<img src='https://tradeboost.imgix.net/" . $blog_post['image'] . "?w=400&h=200&fit=crop&crop=entropy' style='max-width:100%;padding-bottom:20px;' alt='" . $page_title . "' />"; 
						} 
					?>

					 <?php echo "<h2>" . $blog_post['title'] . "</h2></a>";?>
					 	</div>
					 </div> 
			<?php
				}
			}
    		?>				
				</div>
			</div>
		</div>
