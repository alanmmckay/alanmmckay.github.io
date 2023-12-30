<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/projects/social/';

$title = 'Alan McKay | Project | Social Computing';

$meta['title'] = 'Alan McKay | Social Computing';

$meta['description'] = '';

$meta['url'] = 'http://alanmckay.blog/projects/social/';

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <section>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>

                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Project: Social Computing</h1>
                    </header>
                    <p>
                        Consider a dataset which describes interactions between Reddit users for two different subreddits during the span of a specific month.
                        <ul>
                            <li>
                                The given dataset is given as a file which is formatted as an adjacency list. I.e., User1, User2, User3 where User1 replied to a comment made by User2 and another one by User3.
                            </li>
                        </ul>
                    </p>

                    <p>
                        Many different software solutions can be chosen for analysis. Gephi is one that is often recommended. Personal experience has found that Gephi is limited; It is handy for network visualization and generating a set of metrics which are indicative of the properties of the network. There seems to be no mechanism to display the calculated metrics using different scaling factors for any scatterplot graphs. For example, displaying a degree distribution graph in log-log scale doesn't seem to be an available option. To account for this, Python was leveraged, taking advantage of the <code>matplotlib</code>, <code>numpy</code>, and <code>powerlaw</code> libraries.
                        <ul>
                            <li>
                                <code>numpy</code> arrays are used to interface with <code>matplotlib.pyplot</code> and <code>powerlaw</code>.
                            </li>
                            <li>
                                <code>powerlaw</code> allows the generation of a Fitting function for a bin of data. It can also generate relevant alpha values, (the gamma value with respect to the textbook used in this class), for a power-law distribution function. <code>powerlaw</code> also interfaces with matplotlib to allow visual representation of these functions.
                                <ul>
                                    <li>
                                        Relevant class methods are <code>powerlaw.Fit</code> and <code>powerlaw.plot_pdf</code>. Relevant instance methods are <code>powerlaw.Fit(&lt;args&gt;).plot_pdf</code>. Relevant instance variables are <code>powerlaw.Fit(&lt;args&gt;).alpha</code>.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <code>matplotlib.pyplot</code> allows plotting of arrays as scatterplot. It has scaling methods to allow for the display of some graph in log-log scale.
                            </li>
                        </ul>
                        The python files included are ad hoc scripts leveraged to complete the required analysis.
                    </p>

                    <p>
                         It's worth elaborating on what is happening within the represention of the dataset. The existence of some edge in the adjacency list is a means of communication. Communication can be interpreted ambiguously. So it should also be noted that communication here is directed. The node that is representative of a list entry is replying to a comment made by a user within that list entry:
                         <ul>
                            <li>
                                User1 replied to a comment by user2 and another comment by user3;
                            </li>
                            <li>
                                Can be interpreted as (user1 -> user2) and (user1 -> user3)
                            </li>
                         </ul>
                         Thus, an entry of the adjacency list is indicative of the out-degree of a given node, (a node representing a user). To calculate the in-degree of the same node requires parsing through the adjacency list and taking note of how many times communication is directed towards it.
                    </p>

                    <p>
                        This was considered whilst initially examining the data. The initial dataset contains 17406 edges which connect 8129 nodes. While parsing through the data, it can be determined that the minimum out-degree is 1 and the minimum in-degree is 0. Likewise, the maximum out-degree is 203 while the maximum in-degree is 144. While examining the network as an undirected graph, the minimum degree is 1 and the maximum degree is 347.
                    </p>

                    <p>
                        How are the various degrees distributed? The following figures are indicative of distribution:
                    </p>

                    <div class='fig-col'>
                        <a href='../../images/dist-outdeg.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph'>
                                <img src='../../images/dist-outdeg.png'>
                                <figcaption>
                                    Figure 1: Distribution plotting of node out-degrees.
                                </figcaption>
                            </figure>
                        </a>


                        <a href='../../images/dist-indeg.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph'>
                                <img src='../../images/dist-indeg.png'>
                                <figcaption>
                                    Figure 2: Distribution plotting of node-indegrees.
                                </figcaption>
                            </figure>
                        </a>

                        <a href='../../images/dist-degree.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph' style='float:none'>
                                <img src='../../images/dist-degree.png'>
                                <figcaption>
                                    Figure 3: Distribution plotting of node degrees (inbound and outbound)
                                </figcaption>
                            </figure>
                        </a>
                    </div>

                    <p style='clear:both;'>
                        The associated distribution function seems to be exponential in shape. What is this function? The proportion of some node having degree k must be k raised to a negative power: k<sup>-γ</sup>, with some constant factor, c. Discovering the value of this power can be made on the observation that kmax ≈ kmin * N<sup>(1/γ-1)</sup>, where N is the total number of nodes in the network.
                        <ul>
                            <li>
                                Algebraic manipulation can isolate gamma here with application of the logarithm manipulation rules. This generates an approximation of the exponent. The constant factor, c, can be discovered once gamma is found; c = (γ-1)*kmin<sup>-γ+1</sup>
                            </li>
                        </ul>
                        The powerlaw python library makes use of statistical binning to generate these values with respect to a continuous power-law distribution function:
                        <ul>
                            <li>
                                γ-out: 2.931904108581441; c-in: 1.931904108581441
                            </li>

                            <li>
                                γ-in: 2.586342073080467; c-in: 1.5863420730804672
                            </li>

                            <li>
                                γ-total: 2.0875259166393976; c-total: 1.0875259166393976
                            </li>
                        </ul>
                    </p>

                    <p>
                        With gamma values in hand, average expected degrees can be calculated, dependent on statistical moment. This occurs when gamma is in [2,3]. The formula used here is &lt;k&gt; = (γ-1)/(γ-2)*kmin
                        <ul>
                            <li>
                                &lt;kout&gt; ≈ 2.0730717793724676  ≈ &lt;kin&gt; ≈ &lt;k&gt;
                            </li>
                        </ul>
                        Average expected distance can also be computed:
                        <ul>
                            <li>
                                &lt;d&gt; ≈ lnlnN ≈ lnln(8129) ≈ 2.1975793137150044
                            </li>
                        </ul>
                        The actual values computed by Gephi are as such:
                        <ul>
                            <li>
                                &lt;k&gt;: 2.141
                            </li>

                            <li>
                                &lt;d&gt;: 7.07
                            </li>
                        </ul>
                    </p>

                    <p>
                        Curiously, there is a significant difference between the expected distance and the actual distance. This likely is due to the fact the sample set fits in the ultra-small-world regime and the slice taken from reddit doesn't represent the full expected picture.
                    </p>

                    <p>
                        To confirm a power-law distribution, these distributions can be plotted in a log-log scale. The following figures show that a power-law distribution is indeed in play. The light blue points represent the distribution plot. The dotted blue line overlayed by the red line is a plotting of the power-law distribution function (C*k<sup>-γ</sup>).
                    </p>
                    <div class='fig-col'>

                        <a href='../../images/pldist-outdeg.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph'>
                                <img src='../../images/pldist-outdeg.png'>
                                <figcaption>
                                    Figure 4: Power Law Distribution plotting of node-out degrees
                                </figcaption>
                            </figure>
                        </a>

                        <a href='../../images/pldist-indeg.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph'>
                                <img src='../../images/pldist-indeg.png'>
                                <figcaption>
                                    Figure 5: Power Law Distribution plotting of node-in degrees
                                </figcaption>
                            </figure>
                        </a>

                        <a href='../../images/pldist-degree.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph' style='float:none'>
                                <img src='../../images/pldist-degree.png'>
                                <figcaption>
                                    Figure 6: Power Law Distribution plotting of node degrees (inbound and outbound)
                                </figcaption>
                            </figure>
                        </a>
                        <hr>

                    </div>

                    <p style='clear:both;'>
                        Random networks were generated to contrast this data. The algorithm that created these networks ensured the same node count and edge count. It also ensured there exists no node that does not have an edge – as is the case for the reddit data set. The distribution of these networks differ. Consider the following figures:
                    </p>

                    <div class='fig-col'>
                        <a href='../../images/rdist-outdeg.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph'>
                                <img src='../../images/rdist-outdeg.png'>
                                <figcaption>
                                    Figure 7: Distribution plotting of node out-degrees
                                </figcaption>
                            </figure>
                        </a>

                        <a href='../../images/rdist-indeg.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph'>
                                <img src='../../images/rdist-indeg.png'>
                                <figcaption>
                                    Figure 8: Distribution plotting of node in-degrees of Randomized Network
                                </figcaption>
                            </figure>
                        </a>

                        <a href='../../images/rdist-degree.png' target="_blank" rel="noopener noreferrer">
                            <figure class='graph' style='float:none;'>
                                <img src='../../images/rdist-degree.png'>
                                <figcaption>
                                    Figure 9: Distribution plotting of node degrees (outbound and inbound) of Randomized Network
                                </figcaption>
                            </figure>
                        </a>
                    </div>

                    <p style='clear:both;'>
                        The distribution figures are similar for the other four randomized networks. This similarity holds true for the log-log scale plotting of the same data:
                    </p>

                    <a href='../../images/plrdist-degree.png' target="_blank" rel="noopener noreferrer">
                        <figure class='graph'>
                            <img src='../../images/plrdist-degree.png'>
                            <figcaption>
                                Figure 10: Power Law Distribution plotting of node degrees (inbound and outbound) of Randomized Network
                            </figcaption>
                        </figure>
                    </a>

                    <p>
                        The following table of figures are the log-log scale plotting of four other randomized networks, with respect to evaluating out-bound degree:
                    </p>

                    <figure class='col-fig'>

                        <a href='../../images/rdist2-outdeg.png' target="_blank" rel="noopener noreferrer">
                            <img src='../../images/rdist2-outdeg.png'>
                        </a>
                        <a href='../../images/rdist3-outdeg.png' target="_blank" rel="noopener noreferrer">
                            <img src='../../images/rdist3-outdeg.png'>
                        </a>
                        <a href='../../images/rdist4-outdeg.png' target="_blank" rel="noopener noreferrer">
                            <img src='../../images/rdist4-outdeg.png'>
                        </a>
                        <a href='../../images/rdist5-outdeg.png' target="_blank" rel="noopener noreferrer">
                            <img src='../../images/rdist5-outdeg.png'>
                        </a>

                        <figcaption style='clear:both;padding-top:25px'>
                            Figure 12: Power Law distribution plotting of outbound node degrees for four other randomized networks.
                        </figcaption>

                    </figure>

                    <p>
                        These distributions are Poisson/binomial. They do not allow for the reasonable probability of having nodes with large degrees, (degrees that approach kmax). This is emphasized by the values given in the x-axis. The maximum node degree here is anywhere from 7 to 9; much smaller than the maximum node degrees of the Reddit dataset. There seems to be a higher occurrence nodes with degree quantities close to the maximum as well. This is shown in the network representation of the involved data, shown in the following figures:
                    </p>

                    <a href='../../images/rnet-vis.png' target="_blank" rel="noopener noreferrer">
                    <figure class='graph'>
                        <img src='../../images/rnet-vis.png'>
                        <figcaption>
                            Figure 13: Full visualization of randomized network indicates a lack of any hubs. The network seems to have reached a transition where there exists only one component.
                        </figcaption>
                    </figure>
                    </a>

                    <a href='../../images/sfnet-vis.png' target="_blank" rel="noopener noreferrer">
                    <figure class='graph'>
                        <img src='../../images/sfnet-vis.png'>
                        <figcaption>
                            Figure 14: Partial visualization of network representative of the Reddit dataset. Notice the significant hubs which are indicative of a higher degree.
                        </figcaption>
                    </figure>
                    </a>

                    <a href='../../images/sf-outliers.png' target="_blank" rel="noopener noreferrer">
                    <figure class='graph'>
                        <img src='../../images/sf-outliers.png'>
                        <figcaption>
                            Figure 15: Partial visualization of the network representative of the Reddit dataset; structures like these exist in the orbit of the larger connected component of the prior figure. This is a property not observed in the generated randomized networks.
                        </figcaption>
                    </figure>
                    </a>

                    <p>
                        The connectivity of Figure 13 tracks once consideration of average node degree is taken. The average degree measured by Gephi is 2.141. This tracks considering the expected node degree of |E|/|V| which is 17406/8129 =  2.141. Once the average node degree surpasses 1, a randomized graph is in the super critical regime where there exists some gigantic component. This component is not fully connected, though; the average node degree has not reached a point to exceed ln(|V|).
                    </p>

                    <p>
                        The observation of the paragraph above helps us see the property of the complex network given by the Reddit dataset is a scale-free network; a means to visually support this assertion.
                    </p>
                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>

                        </p>
                        <hr>
                    </section>
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>
