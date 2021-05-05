<body class="home_page">
        <!-- if script not working -->
        <noscript>
            <div class="no-script-msg">Javascript is disabled in your browser. Some functionalities will not work properly. Please enable it.</div>
        </noscript>
        <!-- Header -->
        <header class="header <?= (isset(PAGE['HEADER_COLOR']))?@PAGE['HEADER_COLOR']:""?>">
            <div class="header-cover">
                <button type="button" class="menu-toggler" title="menu-toggler">
                    <span>
                        <p class="font-none">...</p>
                    </span>
                    <span>
                        <p class="font-none">...</p>
                    </span>
                </button>
                <a href="<?=getUrl('index.php')?>" class="header-logo" title="logo">
                    <p class="font-none">logo</p>
                    <img src="<?=getUrl('assets/images/logo.png')?>" alt="logo" title="logo">
                </a>
                <a href="<?=getUrl('contact.php')?>" class="get-quote" title="get-quote">
                    <p class="font-none">quote</p>
                    <p>GET QUOTE</p>
                    <span></span>
                </a>
            </div>
        </header>