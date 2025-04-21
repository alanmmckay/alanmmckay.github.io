<?php

$canonical = 'https://alanmckay.blog/writings/hacker_news_extension/';

$title = 'Alan McKay | Project | Browser Extension - HN New Comment Highlight';

$meta['title'] = 'Alan McKay | Browser Extension - HN New Comment Highlight';

$meta['description'] = 'Detail of a browser extension which augments the user interface of a given post to inform the user of any new comments since their last visit.';

$meta['url'] = 'https://alanmckay.blog/projects/hacker_news_extension/';

$relative_path = "../../";

include('../../header.php');

produce_front_matter("HN New Comment Highlight","Projects");
?>
                    <figure>
                        <img class='large_promo' src='images/chrome-marquee_promo_tile.png' />
                        <img class='small_promo' style='max-width:440px' src='images/chrome_small_promo_tile.png' />
                    </figure>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>
                            This page contains documentation pertaining to a browser extension that I've created which enhances the user interface of Y-Combinator's <a href="https://news.ycombinator.com/news">Hacker News</a> forum. The meta-data of the extension contains the following as a description:
                        </p>
                        <blockquote>
                            Refresh a Hacker News [HN] page and highlight new comments since the last visit.
                        </blockquote>
                        <p>
                            To view this meta-data, and the project as a whole, visit its GitHub repository at <a href="https://github.com/alanmmckay/HN-new_comment_highlight">HN-new_comment_highlight</a>. Read on to get a better feel of what this extension accomplishes and how these goals are accomplished.
                        </p>
                        <hr>
                    </section>
                    <header>
                        <h1>Hacker News - New Comment Highlight</h1>
                    </header>
                    <p>
                        Sometimes Y Combinator's Hacker News (HN) has an interesting post with an even more interesting comment section. As discussion grows, HN places comment threads in an unpredictable manner. Navigating multiple conversations can be a bit difficult considering how comment threads are nested and might move around relative to other primary comments. This extension seeks to rectify this problem as the user revisits the page looking for new comments.
                    </p>
                    <p>
                        This extension works by using <code>chrome.storage.local</code> to keep track of the unix timestamps noted by HN markup. It observes the timestamp given in the initial post upon revisiting a page and takes a look at each subsequent comment's timestamp and uses this information to determine how many new comments have been made. The extension informs the user that there are new comments within the header of the primary post:
                    </p>
                    <figure>
                        <img src='images/main_post_comment_counter.png'>
                    </figure>
                    <p>
                        Additionally, the primary post's header has a link inserted that allows the user to jump to the first unread post. Each subsequent post will also have links embedded that allows the user to jump to the next.
                    </p>
                    <p>
                        The comments that have been added since a pages' last visit will also be modified to signify that it is new. This is indicated by changing the time element's font-weight and color while also setting the background color of the comment's content:
                    </p>
                    <figure>
                        <img src='images/new_comment_highlighting.png'>
                    </figure>
                    <p>
                        Comment threads are tracked for up to a month after the lastest comment since the lastest visit of a page. Afer this month, they are trimmed from local storage (<code>storage.local</code>) upon visiting some HN post.
                    </p>
                    <section class='info'>
                        <hr>
                        <h2>How to Install</h2>
                        <p>
                            As of writing this README, this extension hasn't been added to the <a href="https://chromewebstore.google.com/">Chrome Web Store</a>. In the meantime, this extension can be side loaded into chromium-based browsers. Start by downloading this repository. If not familiar with git, the repository can be downloaded by selecting the &lt; &gt; code  button near the top of the repository and selecting Download ZIP.
                        </p>
                        <figure>
                            <img src='images/download_zip.png'>
                        </figure>
                        <p>
                            Extract the resultant archive using a utility such as <a href="https://github.com/alanmmckay/HN-new_comment_highlight/blob/main/images/download_zip.png">7zip</a>.
                        </p>
                        <h3>Chromium Browsers</h3>
                        <p>
                            To install on a browser based on chromium, access the <code>extensions</code> menu and click through to <code>Manage extensions</code>.
                        </p>
                        <figure>
                            <img src='images/access_extensions_menu.png'>
                        </figure>
                        <p>
                            This will open a new tab with to extension manager. Here, select the <code>Load unpacked</code> button located in the top-left of the manager.
                        </p>
                        <figure>
                            <img src='images/load_unpacked.png'>
                        </figure>
                        <p>
                            Select the folder that was extracted from the initial zip archive.
                        </p>
                        <h3>Gecko Browsers</h3>
                        <p>
                            More information noted within source repository issue <a href="https://github.com/alanmmckay/HN-new_comment_highlight/issues/3">#3</a>.
                        </p>
                    </section>
                    <!--section class='info'>
                        <hr>
                        <h3 id='id-changelog'>Change Log</h3>
                            <ul>
                                <li>

                                </li>
                                <li>

                                </li>
                                <li>

                                </li>
                            </ul>
                        <hr>
                    </section-->
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
        <!--script src='../../js/project_functions.js?04'></script-->
        <!--script>
            window.addEventListener('load', function(){setCodeSizeSliders(14)});
        </script-->
    </body>
</html>

