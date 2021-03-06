<header id="masthead" class="site-header" role="banner">
    <hgroup>
        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                  title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
                                  rel="home"><?php bloginfo('name'); ?></a></h1>

        <h2 class="site-description"><?php bloginfo('description'); ?></h2>
    </hgroup>
    <nav id="site-navigation" class="main-navigation" role="navigation">
        <h3 class="menu-toggle"><?php _e('Menu', 'twentytwelve'); ?></h3>
        <a class="assistive-text" href="#content"
           title="<?php esc_attr_e('Skip to content', 'twentytwelve'); ?>"><?php _e('Skip to content', 'twentytwelve'); ?></a>
    </nav>
    <!-- #site-navigation -->
    <?php $header_image = get_header_image();
    if (!empty($header_image)) : ?>
        <img src="<?php echo esc_url($header_image); ?>"
             class="header-image"
             width="<?php echo get_custom_header()->width; ?>"
             height="<?php echo get_custom_header()->height; ?>"
             alt=""/>
    <?php endif; ?>
</header><!-- #masthead -->
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="../">Bootswatch</a>

            <div class="nav-collapse collapse" id="main-menu">
                <ul class="nav" id="main-menu-left">
                    <li><a onclick="pageTracker._link(this.href); return false;"
                           href="http://news.bootswatch.com">News</a></li>
                    <li><a id="swatch-link" href="../#gallery">Gallery</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Preview <b class="caret"></b></a>
                        <ul class="dropdown-menu" id="swatch-menu">
                            <li><a href="../default/">Default</a></li>
                            <li class="divider"></li>
                            <li><a href="../amelia/">Amelia</a></li>
                            <li><a href="../cerulean/">Cerulean</a></li>
                            <li><a href="../cosmo/">Cosmo</a></li>
                            <li><a href="../cyborg/">Cyborg</a></li>
                            <li><a href="../flatly/">Flatly</a></li>
                            <li><a href="../journal/">Journal</a></li>
                            <li><a href="../readable/">Readable</a></li>
                            <li><a href="../simplex/">Simplex</a></li>
                            <li><a href="../slate/">Slate</a></li>
                            <li><a href="../spacelab/">Spacelab</a></li>
                            <li><a href="../spruce/">Spruce</a></li>
                            <li><a href="../superhero/">Superhero</a></li>
                            <li><a href="../united/">United</a></li>
                        </ul>
                    </li>
                    <li class="dropdown" id="preview-menu">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Download <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a target="_blank" href="bootstrap.min.css">bootstrap.min.css</a></li>
                            <li><a target="_blank" href="bootstrap.css">bootstrap.css</a></li>
                            <li class="divider"></li>
                            <li><a target="_blank" href="variables.less">variables.less</a></li>
                            <li><a target="_blank" href="bootswatch.less">bootswatch.less</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav pull-right" id="main-menu-right">
                    <li><a rel="tooltip" target="_blank" href="http://builtwithbootstrap.com/" title=""
                           onclick="_gaq.push(['_trackEvent', 'click', 'outbound', 'builtwithbootstrap']);"
                           data-original-title="Showcase of Bootstrap sites &amp; apps">Built With Bootstrap <i
                                class="icon-share-alt"></i></a></li>
                    <li><a rel="tooltip" target="_blank" href="https://wrapbootstrap.com/?ref=bsw" title=""
                           onclick="_gaq.push(['_trackEvent', 'click', 'outbound', 'wrapbootstrap']);"
                           data-original-title="Marketplace for premium Bootstrap templates">WrapBootstrap <i
                                class="icon-share-alt"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>