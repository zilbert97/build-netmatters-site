<header id="sticker">
    <div class="main-header">

        <!-- Flex Item 1 -->
        <div id="logo-container">
            <!-- Site logo -->
            <a href="/">
                <img src="img/netmatters-logo-large.png" alt="Netmatters logo" class="logo">
            </a>
        </div>

        <!-- Flex Item 2 -->
        <input type="checkbox" id="toggle"> <!-- Hidden checkbox to toggle button visibiltiy at large breakpoint -->

        <!-- Flex Item 3 -->
        <div id="search-container">
            <input type="text" placeholder="Search..." id="search-input">
            <a id="search-icon" href="#">
                <span class="icon-magnifying-glass"></span>
            </a>

            <button class="button" type="button" id="search-button">
                <span class="icon-magnifying-glass"></span>
            </button>
        </div>

        <!-- Flex Item 4 -->
        <div id="buttons-container">
            <a class="button" id="support-button" href="#">
                <span class="icon-mouse"></span>
                <span class="button-text">Support</span>
            </a>

            <a class="button" id="contact-button" href="/contact.php">
                <span class="icon-paperplane"></span>
                <span class="button-text">Contact</span>
            </a>

            <div id="voip-icon">
                <a href="#">
                    <span class="icon-phone_in_talk"></span>
                </a>
                <hr />
            </div>
        </div>

        <!-- Flex Item 5 -->
        <div id="hamburger-container">
            <!-- Inactive as requires JS to trigger active state (class "is-active") -->
            <button id="hamburger-button" class="hamburger hamburger--spin" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
                <span class="burger-text">Menu</span>
            </button>
        </div>

    </div> <!-- .main-header -->

    <div id="nav-container">
        <nav id="nav-inner">
            <ul>

                <li class="nav-item" id="li-web-design">
                    <a href="#">
                        <span class="icon-code"></span>
                        <span class="nav-item-name">
                            <small>Web</small><br>design
                        </span>
                    </a>
                    <div class="subnav">
                        <ul>
                            <li class="subnav-item"><a href="#">Stylish websites</a></li>
                            <li class="subnav-item"><a href="#">Ecommerce stores</a></li>
                            <li class="subnav-item"><a href="#">Branding</a></li>
                            <li class="subnav-item"><a href="#">Apps</a></li>
                            <li class="subnav-item"><a href="#">Web hosting</a></li>
                            <li class="subnav-item"><a href="#">Pay monthly websites</a></li>
                        </ul>
                    </div>
                </li> <!-- .nav-item -->

                <li class="nav-item" id="li-it-support">
                    <a href="#">
                        <span class="icon-display"></span>
                        <span class="nav-item-name">
                            <small>IT</small><br>support
                        </span>
                    </a>
                    <div class="subnav">
                        <ul>
                            <li class="subnav-item"><a href="#">Managed IT</a></li>
                            <li class="subnav-item"><a href="#">Business IT</a></li>
                            <li class="subnav-item"><a href="#">Office 365</a></li>
                            <li class="subnav-item"><a href="#">Consultancy</a></li>
                            <li class="subnav-item"><a href="#">Cloud provider</a></li>
                            <li class="subnav-item"><a href="#">Data backup</a></li>
                        </ul>
                    </div>
                </li> <!-- .nav-item -->

                <li class="nav-item" id="li-telecoms-services">
                    <a href="#">
                        <span class="icon-phone_in_talk"></span>
                        <span class="nav-item-name">
                            <small>Telecoms</small><br>services
                        </span>
                    </a>
                    <div class="subnav">
                        <ul>
                            <li class="subnav-item"><a href="#">Gigabit vouchers</a></li>
                            <li class="subnav-item"><a href="#">Hosted voip</a></li>
                            <li class="subnav-item"><a href="#">Business voip</a></li>
                            <li class="subnav-item"><a href="#">Business broadband</a></li>
                            <li class="subnav-item"><a href="#">Leased line</a></li>
                            <li class="subnav-item"><a href="#">3CX systems</a></li>
                        </ul>
                    </div>
                </li> <!-- .nav-item -->

                <li class="nav-item" id="li-bespoke-software">
                    <a href="#">
                        <span class="icon-apps"></span>
                        <span class="nav-item-name">
                            <small>Bespoke</small><br>software
                        </span>
                    </a>
                    <div class="subnav">
                        <ul>
                            <li class="subnav-item"><a href="#">Workflow solutions</a></li>
                            <li class="subnav-item"><a href="#">Automation</a></li>
                            <li class="subnav-item"><a href="#">System integration</a></li>
                            <li class="subnav-item"><a href="#">Database management</a></li>
                            <li class="subnav-item"><a href="#">Sharepoint</a></li>
                            <li class="subnav-item"><a href="#">ERP</a></li>
                        </ul>
                    </div>
                </li> <!-- .nav-item -->

                <li class="nav-item" id="li-digital-marketing">
                    <a href="#">
                        <span class="icon-bar-graph"></span>
                        <span class="nav-item-name">
                            <small>Digital</small><br>marketing
                        </span>
                    </a>
                    <div class="subnav">
                        <ul>
                            <li class="subnav-item"><a href="#">Search (SEO)</a></li>
                            <li class="subnav-item"><a href="#">Paid (PPC)</a></li>
                            <li class="subnav-item"><a href="#">Conversion (cro)</a></li>
                            <li class="subnav-item"><a href="#">Email</a></li>
                            <li class="subnav-item"><a href="#">Social media</a></li>
                            <li class="subnav-item"><a href="#">Content</a></li>
                        </ul>
                    </div>
                </li> <!-- .nav-item -->

                <li class="nav-item" id="li-cyber-security">
                    <a href="#">
                        <span class="icon-security"></span>
                        <span class="nav-item-name">
                            <small>Cyber</small><br>security
                        </span>
                    </a>
                    <div class="subnav">
                        <ul>
                            <li class="subnav-item"><a href="#">Assessment</a></li>
                            <li class="subnav-item"><a href="#">Management</a></li>
                            <li class="subnav-item"><a href="#">Penetration testing</a></li>
                            <li class="subnav-item"><a href="#">Cyber essentials</a></li>
                            <li class="subnav-item"><a href="#">PCI/DSS</a></li>
                            <li class="subnav-item"><a href="#">Hacker prevention</a></li>
                        </ul>
                    </div>
                </li> <!-- .nav-item -->

            </ul>
        </nav> <!-- #nav-inner -->
    </div> <!-- #nav-container -->

</header>
