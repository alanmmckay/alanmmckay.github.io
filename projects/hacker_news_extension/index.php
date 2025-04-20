<?php

$canonical = 'https://alanmckay.blog/writings/hacker_news_extension/';

$title = 'Alan McKay | Project | Browser Extension - HN New Comment Highlight';

$meta['title'] = 'Alan McKay | Browser Extension - HN New Comment Highlight';

$meta['description'] = '';

$meta['url'] = 'https://alanmckay.blog/projects/hacker_news_extension/';

$relative_path = "../../";

include('../../header.php');

produce_front_matter("HN New Comment Highlight","Projects");
?>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>

                        </p>
                        <p>


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
                    <figure style='max-width:500px'>
                        <img src=''>
                    </figure>
                    <p>
                        Additionally, the primary post's header has a link inserted that allows the user to jump to the first unread post. Each subsequent post will also have links embedded that allows the user to jump to the next.
                    </p>
                    <p>
                        The comments that have been added since a pages' last visit will also be modified to signify that it is new. This is indicated by changing the time element's font-weight and color while also setting the background color of the comment's content:
                    </p>
                    <figure style='max-width:500px'>
                        <img src=''>
                    </figure>
                    <p>
                        Comment threads are tracked for up to a month after the lastest comment since the lastest visit of a page. Afer this month, they are trimmed from local storage (<code>storage.local</code>) upon visiting some HN post.
                    </p>
                    <section class='info'>
                        <hr>
                        <h2>How to Install</h2>
                        <p>
                            As of writing this README, this extension hasn't been added to the Chrome Web Store. In the meantime, this extension can be side loaded into chromium-based browsers. Start by downloading this repository. If not familiar with git, the repository can be downloaded by selecting the &lt; &gt; code  button near the top of the repository and selecting Download ZIP.
                        </p>
                        <figure style='max-width:500px'>
                            <img src=''>
                        </figure>
                        <p>
                            Extract the resultant archive using a utility such as 7zip.
                        </p>
                        <h3>Chromium Browsers</h3>
                        <p>
                            To install on a browser based on chromium, access the <code>extensions</code> menu and click through to <code>Manage extensions</code>.
                        </p>
                        <figure style='max-width:500px'>
                            <img src=''>
                        </figure>
                        <p>
                            This will open a new tab with to extension manager. Here, select the <code>Load unpacked</code> button located in the top-left of the manager.
                        </p>
                        <figure style='max-width:500px'>
                            <img src=''>
                        </figure>
                        <p>
                            Select the folder that was extracted from the initial zip archive.
                        </p>
                        <h3>Gecko Browsers</h3>
                        <p>
                            More information noted within source repository issue #3.
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

