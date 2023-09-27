<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<label id="searchLabel" for="search">
	<span class="style-hidden">Enter Your email here</span>
	<input type="text" aria-labelledby="searchLabel" value="<?php the_search_query(); ?>" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="Search now" />
</form>
