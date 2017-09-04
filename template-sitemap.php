<?php
/**
 * Template Name: Sitemap Template
 */

get_header(); ?>

<section id="primary" class="content-area">
<main id="main" class="site-main" role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
     
<!-- Der Titel der WordPress-Seite -->        
<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->
	
 <div class="entry-content"><!-- Der eigentliche Inhalt kommt in diesen <div> Container, damit sich das Ergebnis dem Rest der Website im Layout anpasst -->       

<?php while ( have_posts() ) : the_post(); // Wir öffnen die Loop ?>

        <h3>Seiten</h3>
        <ul>
            <?php wp_list_pages("title_li="); // Alle WordPress-Seiten als <li> Element auflisten ?>
        </ul>
        <h3>Feeds</h3>
        <?php // Blog- und Kommentarfeed anzeigen ?>
        <ul>
            <li>
                <a title="Full content" href="feed:<?php bloginfo('rss2_url');?>">Main RSS</a>
            </li>
            <li>
                <a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url');?>">Comment Feed</a>
            </li>
        </ul>
        <h3>Kategorien</h3>
        <ul>
            <?php wp_list_categories( 'sort_column=name&optioncount=1&hierarchical=0&feed=&title_li=' ); // Alle vergebenen Kategorien auflisten ?>
        </ul>
        <?php if (function_exists('wp_tag_cloud')) { // Abfrage ob Tags existieren, wenn nicht, wird der Bereich nicht angezeigt. ?>
        <h3>Tags</h3>
            <span id="sidebar-tagcloud">
            <?php wp_tag_cloud('smallest=10&largest=18'); // Alle Tags in einer Tag-Cloud auflisten ?>
        </span>
        <?php } // Ende Abfrage, ob Tags existieren ?>

        <h3>Alle Blog Posts:</h3>
        <ul>
            <?php $archive_query = new WP_Query('showposts=1000&cat=-8'); // Alle Blogposts auflisten - hier 1.000 Stück, kann auch reduziert werden auf die letzten 15 oder so.
                        while ($archive_query->have_posts()) : $archive_query->the_post();  // Extra Loop für die Blogposts
            ?>
            <li>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title();?>"><?php the_title();?></a>
                (<?php comments_number('0', '1', '%'); // Zeigt die Anzahl der Kommentare pro Beitrag an ?>)
            </li>
            <?php endwhile; // Wir schliessen die extra Loop für die Blogposts ?>
            <?php wp_reset_query(); // Die Nutzung einer Loop mit WP_Query() muss wieder resettet werden, ansonsten können Probleme auftauchen ?>
        </ul>

<?php endwhile; // Wir schliessen die Loop ?>
   
</div><!-- end entry-content -->
</article><!-- end article -->
</main><!-- end site-main -->
</section><!-- end content-area -->

<?php get_footer(); ?>