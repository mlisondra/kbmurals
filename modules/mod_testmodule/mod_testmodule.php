<?php
defined( '_JEXEC' ) or die;
/*
	$category = get_category_by_title('Get Help');
	$articles = get_category_articles($category);
	
	echo '<ul>';
	foreach($articles as $article){
		$newUrl = ContentHelperRoute::getArticleRoute($article->id.':'.$article->alias, $category);
		// better check if SEF option is enable!
		$router = new JRouterSite(array('mode'=>JROUTER_MODE_SEF));
		$newUrl = $router->build($newUrl)->toString(array('path', 'query', 'fragment'));
		// SEF URL !
		$newUrl = str_replace('/administrator/', '', $newUrl); //echo $newUrl;
		$newUrl = str_replace('component/content/article/', '', $newUrl);
		
		//$link_to_article = '<a href="/index.php?option=com_content&view=article&id='.$article->id.'">'.$article->title.'</a>';
		$link_to_article = '<a href="/index.php/'.$article->alias.'".>'.$article->title.'</a>';
		echo '<li>'.$link_to_article.'</li>';
	} echo '</ul>';
	
								$article =& JTable::getInstance("content");
							$article->load(83);
							echo $article->get("introtext");
	

function get_category_by_title($title){
	$db = JFactory::getDBO();
	$query = "SELECT id FROM `ppy7i_categories` WHERE title = '".$title."'"; 
	$db->setQuery($query);
	$result = $db->loadObject();
	return $result->id;
}

function get_category_articles($category_id){
	$db = JFactory::getDBO();
	$query = "SELECT `id`,`title`,`alias` FROM `ppy7i_content` WHERE catid = '".$category_id."' ORDER BY `ordering` ASC";
	$db->setQuery($query);
	$result = $db->loadObjectList(); //print_r($result);
	return $result;
}
	*/	
?>

<!--<form name="contact_form" id="contact_form">
First Name <input type="text" name="first_name"><br/><br/>
Last Name <input type="text" name="first_name"><br/><br/>
<br/>
<input type="button" name="click_me" value="Click Me" id="click_me">
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#click_me').click(function(){
			alert('hi');
		});
	});
</script>
-->


			<div id="categories">
				<a href="###" class="cat"><img src="images/categories_tropical.jpg" /><h4>Tropical</h4></a>
				<a href="###" class="cat"><img src="images/categories_food_wine.jpg" /><h4>Food and Wine</h4></a>
				<a href="###" class="cat right"><img src="images/categories_abstract.jpg" /><h4>Abstract</h4></a>
				<a href="###" class="cat"><img src="images/categories_floral.jpg" /><h4>Floral</h4></a>
				<a href="###" class="cat"><img src="images/categories_travel.jpg" /><h4>Travel</h4></a>
				<a href="###" class="cat right"><img src="images/categories_animals.jpg" /><h4>Animals</h4></a>
				<a href="###" class="cat"><img src="images/categories_children.jpg" /><h4>Children</h4></a>
				<a href="###" class="cat"><img src="images/categories_sea_life.jpg" /><h4>Sea Life</h4></a>
				<a href="###" class="cat right"><img src="images/categories_tuscan.jpg" /><h4>Tuscan</h4></a>
				<a href="###" class="cat"><img src="images/categories_western.jpg" /><h4>Western</h4></a>
				<a href="###" class="cat"><img src="images/categories_.jpg" /><h4>Artists</h4></a>
				<a href="###" class="cat right"><img src="images/categories_.jpg" /><h4>Create Your Own</h4></a>
				<div>
					<h4>About Tile Murals</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec purus elit. Donec et sem vel tellus consequat posuere. Vestibulum tristique ultrices sapien, vitae scelerisque neque sagittis eu. Nam eu tellus rutrum tellus vehicula tincidunt a imperdiet felis. Quisque justo nisi, porttitor quis fermentum in, adipiscing laoreet purus. Integer sed tellus a metus posuere rutrum at vitae sapien. Phasellus ac volutpat leo. Nullam vel ipsum turpis, sollicitudin congue lorem. Duis vel lorem purus, nec rutrum nisl. Ut nunc justo, ullamcorper quis rutrum ut, volutpat sed lorem. Nunc neque lacus, molestie eget dapibus nec, sodales sed quam. Phasellus faucibus eros orci. Aenean porttitor, quam vitae sagittis venenatis, nunc felis suscipit tellus, ac convallis risus quam in mi. Etiam consequat mollis rhoncus.</p>
				</div>
			</div>

