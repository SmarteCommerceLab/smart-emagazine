<?php /*
Appunti Gestione Categoria Primary
https://copyprogramming.com/howto/how-to-disable-all-the-checkboxes-inside-jquery-multiselect
https://code.tutsplus.com/how-to-use-radio-buttons-with-taxonomies--wp-24779a
https://gist.github.com/jesusoterogomez/926a938aab8051fd9203
*/ ?>
<?php
/*
* Compose
*/
class semComposeWidget {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidget';
	/*
	* Property
	*/
	public $item_name;
	public $item_slug;
	public $item_tax;
	public $item_widget;
	public $item_sticky;
	public $item_code;
	
	public $esclude_post;
	/*
	* Constract
	*/
	function __construct($item_name,$item_slug,$item_tax,$item_widget,$item_code,$item_sticky,$esclude_post){
		// --
		$this->item_name 		= $item_name;
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->item_widget 		= $item_widget;
		$this->item_code 		= $item_code;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {
		if($this->item_widget=='open')		{
			$semComposeWidgetOpen		 	= new semComposeWidgetOpen			($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetOpen->esclude_post;
		}
		if($this->item_widget=='box')		{
			$semComposeWidgetBox		 	= new semComposeWidgetBox			($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetBox->esclude_post;
		}
		if($this->item_widget=='boxxl')		{
			$semComposeWidgetBoxXL 			= new semComposeWidgetBoxXL			($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetBoxXL->esclude_post;
		}
		if($this->item_widget=='gruppo')	{
			$semComposeWidgetGruppo			= new semComposeWidgetGruppo		($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetGruppo->esclude_post;
		}
		if($this->item_widget=='gruppoxl')	{
			$semComposeWidgetGruppoXL		= new semComposeWidgetGruppoXL		($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetGruppoXL->esclude_post;
		}
		if($this->item_widget=='4news')		{
			$semComposeWidget4News		 	= new semComposeWidget4News			($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidget4News->esclude_post;
		}
		if($this->item_widget=='singolo')	{
			$semComposeWidgetArticle		= new semComposeWidgetArticle		($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetArticle->esclude_post;
		}
		if($this->item_widget=='relativi')	{
			$semComposeWidgetRelativi		= new semComposeWidgetRelativi		($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetRelativi->esclude_post;
		}
		if($this->item_widget=='links')		{
			$semComposeWidgetRelativiLink	= new semComposeWidgetRelativiLink	($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetRelativiLink->esclude_post;
		}
		if($this->item_widget=='sololinks')	{
			$semComposeWidgetRelativiSoloLink	= new semComposeWidgetRelativiSoloLink	($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
			$this->esclude_post 			= $semComposeWidgetRelativiSoloLink->esclude_post;
		}
		if($this->item_widget=='script')	{
			$semComposeWidgetScript			= new semComposeWidgetScript	($this->item_code);
		}
	//------------------------
	$render;}
}
/*
* Function
*/
class semComposeWidgetFunction {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetFunction';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $item_taxonomy;
	public $item_sub_taxonomy;
	public $item_sticky;
	public $getSlug;
	#public $getWidgetsubTaxonomy;
	public $getQuery;
	public $getPost;
	public $esclude_post;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		if($this->item_tax 	== 'tag')		{$this->item_tax = 'post_tag';}
		if($this->item_tax 	== 'categoria')	{$this->item_tax = 'category';}
		// --
		#echo 'item_slug : '.$this->item_slug.'</br>';
		#echo 'item_tax 	: '.$this->item_tax.'</br>';
		#echo 'escludeID : '.$this->esclude_post.'</br>';
	}
	/*
	* Slug
	*/
	function getSlug(){
		// == Slug Check
		if(!isset($this->item_slug) or empty($this->item_slug)){return false;}
		// == Sanitaze Slug
		$slag=explode(",",$this->item_slug);
		// == Create Binomio Slug / Setting First default Binomio slug:tax
		$x=0;foreach($slag as $xslag) {
			// -- Categoria / Tag Traspose
			$coppia = explode(":",$xslag);			//--
			if(!isset($coppia[1]) or empty($coppia[1])){$coppia[1] = $this->item_tax;}
			// --
			if($coppia[1] == 'tag')			{$coppia[1] = 'post_tag';}
			if($coppia[1] == 'categoria')	{$coppia[1] = 'category';}			
			// --
			$this->getSlug['list'][$x]['slug'] 	= $coppia[0];
			$this->getSlug['list'][$x]['tax'] 	= $coppia[1];
		$x++;}
		// == Primo slug Inserito
		$this->getSlug['primary']['slug']	= $this->getSlug['list'][0]['slug'];
		$this->getSlug['primary']['tax']	= $this->getSlug['list'][0]['tax'];
		// ==
		$this->item_slug 					= $this->getSlug['list'][0]['slug'];
		$this->item_tax 					= $this->getSlug['list'][0]['tax'];
	//-------------
	return $this->getSlug;}
	/*
	* Taxonomy Widget
	*/
	function getWidgetTaxonomy($itemSlug = '',$itemTax = ''){#https://codex.wordpress.org/Function_Reference/get_term_by
		// == Slug Check
		if(!isset($this->item_slug) or empty($this->item_slug)){return false;}
		// ==
		$this->item_taxonomy = get_term_by('slug',$this->item_slug,$this->item_tax);#var_dump($this->getWidgetTaxonomy);
	//------------------------
	return $this->item_taxonomy;}
	/*
	* sub-Taxonomy
	*/
	function getWidgetsubTaxonomy($term_id = ''){
		// == Slug Check
		if(!isset($this->item_slug) or empty($this->item_slug)){return false;}
		// == Tax Check
		if($this->item_tax !== 'category' or (!isset($this->item_taxonomy) or empty($this->item_taxonomy))){return false;}
		// ==
		$this->item_sub_taxonomy = get_categories(array(
			'child_of'      => $this->item_taxonomy->term_id, #'child_of'      => $term_id,
			'hide_empty'	=> true,
			'hierarchical' 	=> 1,
			'depth'			=> 1,
			'parent' 		=> $this->item_taxonomy->term_id,#$term_id,
			'orderby' 		=> 'name',
			'order'   		=> 'ASC'
		));
	return $this->item_sub_taxonomy;}
	/*
	* Query
	* $Function->getQuery($taxonomy->term_id,$this->item_tax,$this->item_sticky,9);
	*/
	function getQuery($data){
		// == default array
		if(!isset($data['stycky']) or empty($data['stycky'])){$data['stycky'] = 'off';}
		#https://developer.wordpress.org/reference/classes/wp_query/
		// ==
		$queryCategory	= '';if(isset($this->item_taxonomy) and !empty($this->item_taxonomy)){if($this->item_tax == 'category')	{$queryCategory	= $this->item_taxonomy->term_id;}}
		$querytag		= '';if(isset($this->item_taxonomy) and !empty($this->item_taxonomy)){if($this->item_tax == 'post_tag')	{$querytag		= $this->item_taxonomy->term_id;}}
		// -------------------------------------------------- Sticky ON
		# https://developer.wordpress.org/themes/functionality/sticky-posts/
		if($data['stycky'] == 'on')	{
			// -- Get Sticky Post ID
				$querystycky					= get_option('sticky_posts');rsort($querystycky);
			// -- 
				$sticky_post_query_id 			= (array) null;
				$sticky_post_query_natural_id 	= (array) null; 
				$sticky_post_query_all_id	 	= (array) null; 
			// -- Riduzione arrat sticky_post
				/*if(count(get_option('sticky_posts'))>100){
				$querystycky	= get_option('sticky_posts');
				rsort($querystycky);
				$querystycky 	= array_slice( $querystycky,0,100);
				update_option('sticky_posts', $querystycky);}*/
			// -------------------------------------------------- recupero lista ID sticky
				if(!empty($querystycky)){
					$sticky_post_query = new WP_Query(array(
						'posts_per_page'   		=> $data['post_max'],
						'showposts'				=> $data['post_max'],
						'offset'           		=> 0,
						'cat'         			=> $queryCategory,
						'category_not_in' 		=> array(get_theme_mod('journal_notinclude_category','')),
						'tag_id' 		   		=> $querytag,
						'post__in'            	=> $querystycky,
						'orderby'          		=> 'date',
						'order'            		=> 'DESC',
						'post__not_in'          => $this->esclude_post,
						'post_type'        		=> 'post',
						'post_status'      		=> 'publish',
						'suppress_filters' 		=> true 
					));
					if($sticky_post_query->have_posts()){
						while($sticky_post_query->have_posts()){$sticky_post_query->the_post();$sticky_post_query_id[] = get_the_ID();}
						#var_dump($sticky_post_query_id);			
					}
				}
				#echo 'sticky_post_query_id - '.count($sticky_post_query_id);echo ' - ';var_dump($sticky_post_query_id);echo '</br>';
			// -------------------------------------------------- recupero lista ID Naturali Mancanti
				if(count($sticky_post_query_id)<$post_max){
					$sticky_post_query_natural = new WP_Query(array(
						'posts_per_page'   		=> $data['post_max']-count($sticky_post_query_id),
						'showposts'				=> $data['post_max']-count($sticky_post_query_id),
						'offset'           		=> 0,
						'cat'         			=> $queryCategory,
						'category_not_in' 		=> array(get_theme_mod('journal_notinclude_category','')),
						'tag_id' 		   		=> $querytag,
						'orderby'          		=> 'date',
						'order'            		=> 'DESC',
						'post__not_in'          => $sticky_post_query_id,
						'post_type'        		=> 'post',
						'post_status'      		=> 'publish',
						'suppress_filters' 		=> true 
					));
					if($sticky_post_query_natural->have_posts()){
						while($sticky_post_query_natural->have_posts()){$sticky_post_query_natural->the_post();$sticky_post_query_natural_id[] = get_the_ID();}
					}	
				}
				#echo 'sticky_post_query_natural_id - '.count($sticky_post_query_natural_id);echo ' - ';var_dump($sticky_post_query_natural_id);echo '</br>';
			// -------------------------------------------------- Unisco gli array ID
				$sticky_post_query_all_id = array_merge($sticky_post_query_id, $sticky_post_query_natural_id);
				#echo 'sticky_post_query_all_id - '.count($sticky_post_query_all_id);echo ' - ';var_dump($sticky_post_query_all_id);echo '</br>';
			// -------------------------------------------------- recupero sticky + natuarali
				if(count($sticky_post_query_all_id)>0){
					$this->getQuery = new WP_Query(array(
						'posts_per_page'   		=> $data['post_max'],
						'showposts'				=> $data['post_max'],
						'offset'           		=> 0,
						'category_not_in' 		=> array(get_theme_mod('journal_notinclude_category','')),
						'post__in'            	=> $sticky_post_query_all_id,
						'post__not_in'          => $this->esclude_post,
						'ignore_sticky_posts' 	=> 1,
						'orderby'				=> 'post__in',
						'post_type'        		=> 'post',
						'post_status'      		=> 'publish',
						'suppress_filters' 		=> true 
					));
					if($this->getQuery->have_posts()){
						$sticky_post_query_all_id = (array) null;
						while($this->getQuery->have_posts()){
							$this->getQuery->the_post();
							$sticky_post_query_all_id[] = get_the_ID();
						}
					}	
				}
				#echo 'sticky_post_query_all_id - '.count($sticky_post_query_all_id);echo ' - ';var_dump($sticky_post_query_all_id);echo '</br>';
				// -- 
				if(!$this->getQuery){return false;}
				#if(!$this->getQuery->have_posts() or !isset($this->getQuery) or empty($this->getQuery)){return false;}
				// -- 
				if($this->getQuery->have_posts()){while($this->getQuery->have_posts()){$this->getQuery->the_post();$this->esclude_post[] = get_the_ID();}}
				#echo 'esclude_post - '.count($this->esclude_post);var_dump($this->esclude_post);echo '</br>';
		}
		// -------------------------------------------------- Sticky OFF
		if($data['stycky'] !== 'on'){
			// -------------------------------------------------- Get-Post
			$this->getQuery = new WP_Query(array(
				'posts_per_page'   		=> $data['post_max'],
				'showposts'				=> $data['post_max'],
				'cat'         			=> $queryCategory,
				'tag_id' 		   		=> $querytag,
				'post__not_in'          => $this->esclude_post,
				'category_not_in' 		=> array(get_theme_mod('journal_notinclude_category','')),
				'offset'           		=> 0,
				'ignore_sticky_posts' 	=> 1,
				'orderby'          		=> 'date',
				'order'            		=> 'DESC',
				'post_type'        		=> 'post',
				'post_status'      		=> 'publish',
				'suppress_filters' 		=> true 
			));
			// -- 
			if(!$this->getQuery->have_posts() or !isset($this->getQuery) or empty($this->getQuery)){return false;}
			// -- 
			if($this->getQuery->have_posts()){while($this->getQuery->have_posts()){$this->getQuery->the_post();$this->esclude_post[] = get_the_ID();}}
		}
	//------------------------
	return $this->getQuery;}
	/*
	* 
	*/
	function getPost($ID){
		// -- Get All Category
		$this->getPost['category']['primary'] 			= $this->getPostCatPrimary($ID);
		// -- GET TAG FIRST
		$this->getPost['tag']['primary'] 				= $this->getPostTagPrimary($ID);
	//------------------------
	return $this->getPost;}	
	/*
	* 
	*/
	function getPostCatPrimary($ID){
		// == Yoast
		if (class_exists('WPSEO_Primary_Term')){
			$primary_term 		= new WPSEO_Primary_Term('category',$ID);
			$primary_term 		= get_term($primary_term->get_primary_term());
			// -- Yost not setting - Give Wordpress category
			if (is_wp_error($primary_term)) {
				// -- all category post
				$primary_term 	= get_the_terms($ID, 'category');
				if(!isset($primary_term) or empty($primary_term)){return false;}
				// -- First category in Post
				return $primary_term[0];
			}
		}
		// == Wordpress
		if (!class_exists('WPSEO_Primary_Term')){
			// -- all category post
			$primary_term 	= get_the_terms($ID, 'category');
			if(!isset($primary_term) or empty($primary_term)){return false;}
			// -- First category in Post
			return $primary_term[0];
		}
		// == Get All Category
		if (is_wp_error($primary_term)){return false;}
		if (isset($primary_term) and !empty($primary_term)){
			// --
			#$catPrimary['slug']			= $primary_term->slug;
			#$catPrimary['id'] 			= $primary_term->term_id;
			#$catPrimary['name']			= $primary_term->name;
			#$catPrimary['link'] 		= get_category_link($primary_term->term_id);
		}
	// ----------------
	}	
	/*
	* 
	*/
	function getPostTagPrimary($ID){
		// -- Get Tag del Post
		$get_post_tag 			= get_the_tags($ID);
		// -- No Tag
		if(!isset($get_post_tag) or empty($get_post_tag)){return $get_post_tag;}
		// -- Get First Tag
		if(isset($get_post_tag) and !empty($get_post_tag)){
			// -- escludi il primo Tag se il widget richiama Tag
			foreach ($get_post_tag as $post_tag){$xslag = '';
				// --
				if(isset($this->getSlug['primary']['tax']) and !empty($this->getSlug['primary']['tax'])){
					if($this->getSlug['primary']['tax'] == 'post_tag'){$xslag = $this->getSlug['primary']['slug'];}
				}
				// -- Tag da Escludere e Recupero del primo Tag
				if($post_tag->slug != $xslag and $post_tag->slug != 'Featured' and $post_tag->slug != 'featured'){
					$post_tag_id			= $post_tag->term_id;
					break;
				}else{unset($post_tag_id);}}
		}
		// -- recupero del primo tag utile
		if(isset($post_tag_id) and !empty($post_tag_id)){
			return get_term_by('term_id',$post_tag_id,'post_tag');
		}else{return false;}
	// ----------------
	}
	/*
	* 
	*/
	function getPostThumbnailAlt($post_ID){
		//--
		if(!isset($post_ID) or empty($post_ID)){return 'Thumbanil alt not retrive. post ID not setting';}
		// --
		$alt = get_post_meta(get_post_thumbnail_id($post_ID), '_wp_attachment_image_alt', true );
		// --
		if(!isset($$alt) or empty($$alt)){$$alt = get_the_title($post_ID);}
	//------------------------
	return $alt;}
	/*
	* 
	*/
	function htmlWidgetLabel($taxonomy,$subtaxonomy){?>
		<?php if(isset($taxonomy->slug) and !empty($taxonomy->slug)){?>
            <div class="position-relative d-flex justify-content-between align-items-center border-line mb-2">
                <a class="h4 link text-left text-uppercase fw-bold text-nowrap" href="<?php echo get_term_link($taxonomy->term_id); ?>" title="<?php echo $taxonomy->name;?>">
                    <?php echo $taxonomy->name; ?>
                </a>              
                <ul class="list-inline list-unstyled m-0">    
                    <?php if(isset($subtaxonomy) and !empty($subtaxonomy)){?>
                        <?php $c=0;foreach($subtaxonomy as $sub_cats){if($c<=1){?>
                            <li class="list-inline-item">
                                <a 
                                class	= "small text-muted link me-1 p-0 text-nowrap" 
                                href	= "<?php echo esc_url(get_category_link($sub_cats->term_id));?>"
                                title 	= "<?php echo $sub_cats->name;?>"
                                ><?php echo $sub_cats->name; ?></a>
                            </li>
                        <?php $c++;}}?>
                    <?php }?>
                     <li class="list-inline-item">
                        <a 
                        class	= "small text-muted link me-1 p-0" 
                        href	= "<?php echo esc_url(get_term_link($taxonomy->term_id));?>"
                        title 	= "<?php echo $taxonomy->name;?>"
                        >Tutte</a>
                    </li>           
                </ul>
            </div>
        <?php }?>
	<?php }
	/*
	* 
	*/
	function htmlPostThumbnail_1($post_category_primary,$post_tag_primary){global $post;?>
		<div class="position-relative d-table mx-auto <?php if(is_sticky()){echo 'sticky-post';}?>">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
				<?php if(has_post_thumbnail()){the_post_thumbnail('large', array(
					'class' => "img-fluid",
					'alt' 	=> $this->getPostThumbnailAlt($post->ID),
					'title' => $this->getPostThumbnailAlt($post->ID)
				));}?>
			</a>
			<div class="background">
				<a class="d-block link text-white" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
					<h3><?php the_title();?></h3>
				</a>
                <div class="d-flex justify-content-between align-items-center small">   
                    <p class="nav-item text-white small"><i class="fa-solid fa-pencil"></i>&nbsp;
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link text-white">
                            <?php echo get_the_author(); ?>
                        </a>
						<?php if(is_sticky()){?>
                            <span> - primo piano</span>
                       <?php }?>                        
                    </p>
                    <p class="nav-item text-white small">
                        <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?><i class="fa-solid fa-tag"></i>&nbsp;
                            <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link text-white">
                                <?php echo $post_tag_primary->name ?>
                            </a>
                        <?php }?>
                    </p>
                </div>
			</div>
		</div>
	<?php }	
}
/*
* Widget - Open 
*/
class semComposeWidgetOpen {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetOpen';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 9));
		// -- Render Widget
		?>
        <div class="open mb-5 overflow-hidden">
			<!-- Item List -->
            <?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
            <div class="row g-1">
				<?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
                    <?php
                        // -- Get Category Primary
                        $post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
                        // -- Get Tag Primary
                        $post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());	
                    ?>
					<?php if($x==0){?>
                        <div class="col-12 col-lg-6 col-xl-6 p-1-">
                            <?php $Function->htmlPostThumbnail_1($post_category_primary,$post_tag_primary)?>
                        </div>
                    <?php }?>     
                    <?php if($x>=1 and $x<=4){?>
                        <?php if(($x == 1 or $x == 3)){?><div class="col-12 col-lg-3 col-xl-3 p-1-"><hr class="d-md-none"><?php }?>
                            <?php if($x == 1 or $x == 3){?><div class="row g-2 g-lg-1"><?php }?><div class="col-12 col-md-6 col-lg-12">
                                <div class="position-relative">
                                    <div class="row d-flex justify-content-between align-items-top g-2 gx-xl-4 gy-xl-0">
                                        <div class="col-4 col-md-12">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                                <?php if(has_post_thumbnail()){the_post_thumbnail('medium', array(
                                                    'class' => "img-fluid",
                                                    'alt' 	=> $Function->getPostThumbnailAlt(get_the_ID()),
                                                    'title' => $Function->getPostThumbnailAlt(get_the_ID())
                                                ));}?>
                                            </a>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            <div class="background-md">
                                                <a class="d-block link text-black text-md-white" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                                    <h6><?php the_title();?></h6>
                                                </a>
                                                <div class="d-flex d-lg-none d-xl-flex justify-content-between align-items-center small">   
                                                    <p class="nav-item small mb-0">
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link text-md-white">
                                                            <?php echo get_the_author(); ?>
                                                        </a>
                                                    </p>
                                                    <p class="nav-item small mb-0">
                                                        <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                                                            <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize text-md-white link">
                                                                <?php echo $post_tag_primary->name ?>
                                                            </a>
                                                        <?php }?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(($x == 2 or $x == 4)){?></div><?php }?></div>
                        <?php if(($x == 2 or $x == 4)){?></div><?php }?>
                    <?php }?>
                    <?php if($x>=5 and $x<=$query->post_count-1){?>
                        <?php if(($x == 5)){?><div class="col-12 col-lg-12 col-xl-12"><hr class="d-lg-none"><div class="row g-2 g-lg-1"><?php }?>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="position-relative">
                                    <div class="row d-flex justify-content-between align-items-top g-2 gx-xl-4 gy-xl-0">
                                        <div class="col-4 col-md-12">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                                <?php if(has_post_thumbnail()){the_post_thumbnail('medium', array(
                                                    'class' => "img-fluid",
                                                    'alt' 	=> $Function->getPostThumbnailAlt(get_the_ID()),
                                                    'title' => $Function->getPostThumbnailAlt(get_the_ID())
                                                ));}?>
                                            </a>
                                        </div>
                                        <div class="col-8 col-md-12">
                                            <div class="background-lg">
                                                <a class="d-block link text-black text-lg-white" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                                    <h6><?php the_title();?></h6>
                                                </a>
                                                <div class="d-flex d-lg-none d-xl-flex justify-content-between align-items-center small">   
                                                    <p class="nav-item small mb-0">
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link text-md-white">
                                                            <?php echo get_the_author(); ?>
                                                        </a>
                                                    </p>
                                                    <p class="nav-item small mb-0">
                                                        <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                                                            <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize text-md-white link">
                                                                <?php echo $post_tag_primary->name ?>
                                                            </a>
                                                        <?php }?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php if(($x == $query->post_count-1)){?></div></div><?php }?>
                    <?php }?>
                <?php }wp_reset_postdata();}?>
            </div>
            <hr>
        </div>
	<?php
	//------------------------
	$this->esclude_post = $Function->esclude_post;
	return;}
}
/*
* Widget - Box
*/
class semComposeWidgetBox {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetBox';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 4));
		// -- Render Widget
		?>
		<div class="box mb-5 overflow-hidden">
            <?php $Function->htmlWidgetLabel($taxonomy,$subtaxonomy);?>
        	<?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
            <div class="row d-flex justify-content-between align-items-top g-2">
            	<?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
					<?php
                        // -- Get Category Primary
                        $post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
					    // -- Get Tag Primary
                        $post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());
                    ?>
					<?php if($x==0){?>
                        <div class="col-12 col-lg-6">
                            <?php $Function->htmlPostThumbnail_1($post_category_primary,$post_tag_primary)?>
                        </div>
					<?php }?>
                    <?php if($x>=1 and $x <= $query->post_count-1){?>
                        <?php if($x == 1){?><div class="col-12 col-lg-6"><hr class="d-lg-none"><?php }?>
                            <div class="row d-flex justify-content-center align-items-top align-items-sm-center pb-1 g-2">
                                <div class="col-4">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                        <?php if(has_post_thumbnail()){the_post_thumbnail('medium', array(
                                            'class' => "img-fluid",
                                            'alt' 	=> $Function->getPostThumbnailAlt(get_the_ID()),
                                            'title' => $Function->getPostThumbnailAlt(get_the_ID())
                                        ));}?>
                                    </a>
                                </div>
                                <div class="col-8">
                                    <a class="d-block h6 link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                                    <div class="d-flex justify-content-between align-items-center small">   
                                        <p class="nav-item text-muted small">di
                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                                                <?php echo get_the_author(); ?>
                                            </a> 
                                        </p>
                                        <p class="nav-item text-muted small">
                                            <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                                                <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link">
                                                    <?php echo $post_tag_primary->name ?>
                                                </a>
                                            <?php }?>
                                        </p>
                                    </div> 
                                </div>
                            </div>
                        <?php if($x == $query->post_count-1){?></div><?php }?>
                    <?php }?>
				<?php }wp_reset_postdata();}?>
                <!-- /close -->
            </div>
            <hr>
		</div>
		<?php
	//------------------------
	$this->esclude_post = $Function->esclude_post;
	return;}	
}
/*
* Widget - BoxXL
*/
class semComposeWidgetBoxXL {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetBoxXL';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 5));
		// -- Render Widget
		?>
		<div class="boxXL mb-5 overflow-hidden">
			<!-- Label Taxonomy -->
            <?php $Function->htmlWidgetLabel($taxonomy,$subtaxonomy);?>
			<!-- Item List -->
        	<?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
            <div class="row d-flex justify-content-between align-items-top g-2">
				<!-- open -->
            	<?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
                    <?php 
						// -- Get Category Primary
						$post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
						// -- Get Tag Primary
						$post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());					
					?>
					<?php if($x==0){?>
                        <div class="col-12 col-lg-6">
                            <?php $Function->htmlPostThumbnail_1($post_category_primary,$post_tag_primary)?>
                        </div>
                    <?php }?>
                    <?php if($x>=1 and $x<=$query->post_count-1){?>
                        <?php if(($x == 1)){?><div class="col-12 col-lg-6"><hr class="d-lg-none"><?php }?>
                            <?php if($x == 1 or $x == 3){?><div class="row g-2"><?php }?>
                                <div class="col-12 col-lg-6">
                                    <div class="row d-flex justify-content-center align-items-xl-center g-2">
                                        <?php if(($x >= 1 and $x <= 2)){?>
                                            <div class="col-4 col-md-4 col-lg-12">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                                    <?php if(has_post_thumbnail()){the_post_thumbnail('medium', array(
                                                        'class' => "img-fluid",
                                                        'alt' 	=> $Function->getPostThumbnailAlt(get_the_ID()),
                                                        'title' => $Function->getPostThumbnailAlt(get_the_ID())
                                                    ));}?>
                                                </a>
                                            </div>
                                        <?php }?>
                                        <div class="<?php if(($x >= 1 and $x <= 2)){?>col-8 col-md-8 col-lg-12<?php }else{?>col-12<?php }?>">
                                            <a class="d-block h6 link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                                            <div class="d-flex justify-content-between align-items-center small">   
                                                <p class="nav-item text-muted small">di 
                                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                                                    <?php echo get_the_author(); ?>
                                                    </a>
                                                </p>
                                                <p class="nav-item text-muted small">
                                                    <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                                                        <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link">
                                                            <?php echo $post_tag_primary->name ?>
                                                        </a>
                                                    <?php }?>
                                                </p>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            <?php if(($x == 2 or $x == 4)){?></div><?php if($x == 2){?><hr class="d-lg-none"><?php }?><?php }?>                
                        <?php if(($x == $query->post_count-1)){?></div><?php }?>
                    <?php }?>                    
				<?php }wp_reset_postdata();}?>
                <!-- /close -->
            </div>
			<hr>
		</div>
		<?php
	//------------------------
	$this->esclude_post = $Function->esclude_post;
	return;}
}
/*
* Widget - Gruppo
*/
class semComposeWidgetGruppo {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetGruppo';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 7));
		// -- Render Widget
		?>
		<div class="gruppo mb-5 overflow-hidden">
			<!-- Label Taxonomy -->
            <?php $Function->htmlWidgetLabel($taxonomy,$subtaxonomy);?>
			<!-- Item List -->
        	<?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
			<div class="row d-flex justify-content-between align-items-top g-2">
				<!-- open -->
            	<?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
                	<?php 
						// -- Get Category Primary
						$post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
						// -- Get Tag Primary
						$post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());					
					?>
					<?php if($x==0){?>
                        <div class="col-12 col-lg-6">
                            <?php $Function->htmlPostThumbnail_1($post_category_primary,$post_tag_primary)?>
                        </div>
                    <?php }?>
                    <?php if($x>=1){?>
                        <?php if(($x == 1 or $x == 4)){?><div class="col-12 col-lg-3"><hr class="d-lg-none"><div class="row"><?php }?>
                            <div class="col-12 col-md-4 col-lg-12">
                                <div class="row d-flex justify-content-between align-items-xl-center">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <a class="d-block h6 link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                                        <div class="d-flex justify-content-between align-items-center small">   
                                            <p class="nav-item text-muted small">di 
                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                                                <?php echo get_the_author(); ?>
                                                </a>
                                            </p>
                                            <p class="nav-item text-muted small">
                                                <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                                                    <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link">
                                                        <?php echo $post_tag_primary->name ?>
                                                    </a>
                                                <?php }?>
                                            </p>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        <?php if(($x == 3 or $x == 6)){?></div><?php if(($x == 3)){?><?php }?></div><?php }?>
                    <?php }?>                    
				<?php }wp_reset_postdata();}?>
                <!-- /close -->
			</div>
			<hr>
		</div>
		<?php
	// ----------------------------------------------------------
	$this->esclude_post = $Function->esclude_post;
	return;}
}
/*
* Widget - Gruppo - XL
*/
class semComposeWidgetGruppoXL {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetGruppoXL';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 5));
		// -- Render Widget
		?>
		<div class="gruppo-XL mb-5 overflow-hidden">
			<!-- Label Taxonomy -->
            <?php $Function->htmlWidgetLabel($taxonomy,$subtaxonomy);?>
			<!-- Item List -->
        	<?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
			<div class="row d-flex justify-content-between align-items-top g-2">
				<!-- open -->
            	<?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
                	<?php 
						// -- Get Category Primary
						$post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
						// -- Get Tag Primary
						$post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());					
					?>
					<?php if($x<=1){?>
                        <div class="col-12 col-md-6 col-xl-4">
							<?php $Function->htmlPostThumbnail_1($post_category_primary,$post_tag_primary)?>
                        </div>
                    <?php }?>
                    <?php if($x>=2 and $x <= $query->post_count-1){?>
                        <?php if(($x == 2)){?><div class="col-12 col-md-12 col-xl-4"><hr class="d-xl-none"><div class="row"><?php }?>
                            <div class="col-12 col-md-4 col-lg-4 col-xl-12">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <a class="d-block h6 link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                                        <div class="d-flex justify-content-between align-items-center small">   
                                            <p class="nav-item text-muted small">di 
                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                                                <?php echo get_the_author(); ?>
                                                </a>
                                            </p>
                                            <p class="nav-item text-muted small">
                                                <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                                                    <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link">
                                                        <?php echo $post_tag_primary->name ?>
                                                    </a>
                                                <?php }?>
                                            </p>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        <?php if(($x == $query->post_count-1)){?></div></div><?php }?>
                    <?php }?>                    
				<?php }wp_reset_postdata();}?>
                <!-- /close -->
			</div>
			<hr>
		</div>
		<?php
	// ----------------------------------------------------------
	$this->esclude_post = $Function->esclude_post;
	return;}
}
/*
* Widget - Article
*/
class semComposeWidgetArticle {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetArticle';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 1));
		// -- Render Widget
		?>
		<div class="article mb-5 overflow-hidden">
			<!-- Label Taxonomy -->
			<?php $Function->htmlWidgetLabel($taxonomy,$subtaxonomy);?>
			<!-- Item List -->
            <!-- open -->
            <?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
            <?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
            	<?php 
					// -- Get Category Primary
					$post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
					// -- Get Tag Primary
					$post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());				
				?>
                <div class="row d-flex justify-content-center align-items-center g-2">
                    <div class="col-12 col-lg-6">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                            <?php if(has_post_thumbnail()){the_post_thumbnail('large', array(
                                'class' => "img-fluid",
                                'alt' 	=> $Function->getPostThumbnailAlt(get_the_ID()),
                                'title' => $Function->getPostThumbnailAlt(get_the_ID())
                            ));}?>
                        </a>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="small">
                            <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                            <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link"><span class="h6">
                                <?php echo $post_tag_primary->name ?></span>
                            </a>
                            <?php }?>
                        </p>                    
                        <a class="d-block link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                            <h3><?php the_title();?></h3>
                        </a>
                        <p class="small"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link"><span class="h6"><?php echo get_the_author(); ?></span></a></p>
                    </div>
                </div>                
            <?php }wp_reset_postdata();}?>
            <!-- /close -->
			<hr>
		</div>
		<?php
	// ---------------------
	$this->esclude_post = $Function->esclude_post;
	return;}
}
/*
* Widget - 4News
*/
class semComposeWidget4News {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidget4News';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- Render Widget
		?>
		<div class="4news mb-5 row g-2 overflow-hidden">
        	<?php $z=0;foreach($slug['list'] as $xslag){?>
             	<?php 		
					// -- recupero della taxonomia dichiarata
					$taxonomy 		= get_term_by('slug',$xslag['slug'],$xslag['tax']);
					// -- se Taxonomy é Category : recupero di eventuali sub
					#$subtaxonomy	= $Function->getWidgetsubTaxonomy($taxonomy->term_id);
					$taxonomy 		= $Function->getWidgetTaxonomy();
					// --
					#$query	 		= $Function->getQuery($taxonomy->term_id,$xslag['tax'],$this->item_sticky,1);
					$query	 		= $Function->getQuery(array('post_max' => 1));
				?>           
            	<div class="col-12 col-md-6 col-xl-3 mb-3">
                    <!-- Label Taxonomy -->
                    <?php $Function->htmlWidgetLabel($taxonomy,$subtaxonomy);?>
                    <!-- open -->
                    <?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
                    <?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
                        <?php 
                            // -- Get Category Primary
                            $post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
                            // -- Get Tag Primary
                            $post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());					
                        ?>
                        <div class="position-relative">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                <?php if(has_post_thumbnail()){the_post_thumbnail('large', array(
                                    'class' => "img-fluid",
                                    'alt' 	=> $Function->getPostThumbnailAlt(get_the_ID()),
                                    'title' => $Function->getPostThumbnailAlt(get_the_ID())
                                ));}?>
                            </a>
                            <div class="background">
                                <a class="d-block link text-white" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                    <h5><?php the_title();?></h5>
                                </a>
                                <div class="d-flex justify-content-between align-items-center small">   
                                    <p class="nav-item text-white small m-0"><i class="fa-solid fa-pencil"></i>&nbsp;
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link text-white">
                                            <?php echo get_the_author(); ?>
                                        </a>
                                        <?php if(is_sticky()){?>
                                            <span> - primo piano</span>
                                       <?php }?>                        
                                    </p>
                                    <p class="nav-item text-white small m-0">
                                        <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?><i class="fa-solid fa-tag"></i>&nbsp;
                                            <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link text-white">
                                                <?php echo $post_tag_primary->name ?>
                                            </a>
                                        <?php }?>
                                    </p>
                                </div>
                            </div>
                        </div>                    
                    <?php }wp_reset_postdata();}?>
                    <!-- /close -->
                </div>                      	
            <?php $z++;}?>
			<hr>
		</div>
		<?php
		// ----------------------------------------------------------
		$this->esclude_post = $Function->esclude_post;
	return;}
}
/*
* Widget - Relativi
*/
class semComposeWidgetRelativi {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetRelativi';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 3));
		// -- Render Widget
		?>
		<div class="single-related mb-5 overflow-hidden">
            <?php $Function->htmlWidgetLabel($taxonomy,$subtaxonomy);?>
            <div class="row d-flex justify-content-start align-items-top mb-2 g-2">
                <?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
            	<?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
					<?php
                        // -- Get Category Primary
                        $post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
                        // -- Get Tag Primary
                        $post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());
                    ?>                
                    <div class="col-12 col-md-4 col-lg-4 mx-auto">                    
                        <div class="row d-flex justify-content-center align-items-xl-center g-2">
                            <div class="col-4 col-md-12">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                    <?php if(has_post_thumbnail()){the_post_thumbnail('medium', array(
                                        'class' => "img-fluid",
                                        'alt' 	=> $Function->getPostThumbnailAlt(get_the_ID()),
                                        'title' => $Function->getPostThumbnailAlt(get_the_ID())
                                    ));}?>
                                </a>
                            </div>
                            <div class="col-8 col-md-12">
                                <a class="d-block h5 link text-black" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                                <div class="d-flex justify-content-between align-items-center small">   
                                    <p class="nav-item text-muted small">di 
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="link">
                                        <?php echo get_the_author(); ?>
                                        </a>
                                    </p>
                                    <p class="nav-item text-muted small">
                                        <?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                                            <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="text-first-capitalize link">
                                                <?php echo $post_tag_primary->name ?>
                                            </a>
                                        <?php }?>
                                    </p>
                                </div> 
                            </div>
                        </div>
					</div>
				<?php }wp_reset_postdata();}?>
                <!-- /close -->  
			</div>
        </div>
	<?php // --------------------------------------------
	$this->esclude_post = $Function->esclude_post;return;}
}
/*
* Widget - Link 
*/
class semComposeWidgetRelativiLink {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetRelativiLink';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		#$query	 		= $Function->getQuery($taxonomy->term_id,$slug['primary']['tax'],NULL,2);
		$query	 		= $Function->getQuery(array('post_max' => 2));
		// -- Render Widget
		?>
        <div class="single-related mb-5 overflow-hidden">
	        <!-- Label Taxonomy -->
            <div class="position-relative d-flex justify-content-between align-items-center border-line mb-2">
                <p class="h5 text-left text-first-uppercase fw-bold text-nowrap text-primary py-1">
                    Leggi Anche...
                </p>              
            </div>
            <!-- Article -->
            <div class="row d-flex justify-content-start align-items-top mb-2 g-2">
				<!-- open -->
                <?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
            	<?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
                	<?php
						// -- Get Category Primary
						$post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
						// -- Get Tag Primary
						$post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());
						// --
						$second_class = "";if($x==1){$second_class = 'text-sm-end';}
						//--
						$label_nota = '<small class="text-muted"><i class="fa-regular fa-star"></i>&nbsp;Altro dalla categoria</small>';
						if($x==1){$label_nota = '<small class="text-muted"><i class="fa-solid fa-hashtag"></i>&nbsp;Potrebbe interessarti</small>';}				
					?>
                    <div class="col-12 col-md-6 <?php echo $second_class;?>">
                        <?php echo $label_nota;?>
                        <a class="d-block h5 link text-black text-first-capitalize" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                    </div>                    
				<?php }wp_reset_postdata();}?>
                <!-- /close -->
            </div>
        </div>
	<?php // --------------------------------------------
	$this->esclude_post = $Function->esclude_post;return;}
}
/*
* Widget - Link 
*/
class semComposeWidgetRelativiSoloLink {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetRelativiSoloLink';
	/*
	* Property
	*/
	public $item_slug;
	public $item_tax;
	public $esclude_post;
	public $item_sticky;
	/*
	* Constract
	*/
	function __construct($item_slug,$item_tax,$item_sticky,$esclude_post){
		// --
		$this->item_slug 		= $item_slug;
		$this->item_tax 		= $item_tax;
		$this->esclude_post 	= $esclude_post;
		$this->item_sticky 		= $item_sticky;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;
		// -- Class Function Widget
		$Function 		= new semComposeWidgetFunction($this->item_slug,$this->item_tax,$this->item_sticky,$this->esclude_post);
		// -- recupero slug - array in return
		$slug 			= $Function->getSlug();
		// -- recupero della taxonomia dichiarata
		$taxonomy 		= $Function->getWidgetTaxonomy();
		// -- se Taxonomy é Category : recupero di eventuali sub
		$subtaxonomy	= $Function->getWidgetsubTaxonomy();
		// --
		$query	 		= $Function->getQuery(array('post_max' => 5));
		// -- Render Widget
		?>
        <div class="single-side-links mb-3 overflow-hidden">
	        <!-- Label Taxonomy -->
            <div class="position-relative d-flex justify-content-between align-items-center border-line mb-2">
                <p class="h5 text-left text-first-uppercase fw-bold text-nowrap text-primary py-1">
                    Ultimi articoli
                </p>              
            </div>           
			<?php if(!$query){echo '<p class="small text-muted">non ci sono articoli da mostrare per questa selezione</p><hr>'; return;} ?>
            <?php $x=-1;if($query->have_posts()){while($query->have_posts()){$x++;$query->the_post();?>
                <?php
                    // -- Get Category Primary
                    $post_category_primary	= $Function->getPostCatPrimary(get_the_ID());
                    // -- Get Tag Primary
                    $post_tag_primary		= $Function->getPostTagPrimary(get_the_ID());
                ?>
                <div class="border p-3 shadow-sm mb-3">
				<?php if(isset($post_tag_primary) and !empty($post_tag_primary)){?>
                    <a href="<?php echo get_tag_link($post_tag_primary->term_id) ?>" class="d-block h6 mb-1 small text-capitalize link"><small><?php echo $post_tag_primary->name ?></small></a>
                <?php }?>
                <a class="d-block h5 link text-black text-first-capitalize small" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title();?></a>
                </div>                  
            <?php }wp_reset_postdata();}?>
            <!-- /close -->
        </div>
	<?php // --------------------------------------------
	$this->esclude_post = $Function->esclude_post;return;}
}
/*
* Widget - Script 
*/
class semComposeWidgetScript {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidgetScript';
	/*
	* Property
	*/
	public $item_code;
	/*
	* Constract
	*/
	function __construct($item_code){
		// --
		$this->item_code 	= $item_code;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {?>
    	<div class="compose-script mb-5 overflow-hidden d-flex justify-content-center align-items-center">
			<?php if(strpos($this->item_code,'<'.'?')!==false){ob_start();eval('?>'.$this->item_code);$this->item_code = ob_get_contents();ob_end_clean();}
            echo $this->item_code;?>
        </div>
	<?php return;}
}
/*
* Widget - 3Featured 
*/
class semComposeWidget3Featured {
	/*
	* The type of control being rendered
	*/
	private $type = 'semComposeWidget3Featured';
	/*
	* Property
	*/
	public $public_property;
	/*
	* 
	*/	
	/*
	* Constract
	*/
	function __construct($public_property){
		// --
		$this->public_property 		= $public_property;
		// --
		$this->__render();
	}
	/*
	* Render
	*/
	function __render() {global $post;

	echo $render;}
}