<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/projects/protocol/';

$title = 'Alan McKay | Project | Population Protocol';

$meta['title'] = 'Alan McKay | Population Protocol';

$meta['description'] = '';

$meta['url'] = 'http://alanmckay.blog/projects/protocol/';

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
                            The following is a summary of research conducted to help earn my Bachelor's of Science in Computer Science. The research was an exploration of a model of computation called the Population Protoocol. Those who have studied Theory of Computer Science should find it intuitive.
                        </p>
                        <p>
                            A presentation was given discussing the particulars of this research and can be viewed via <a href='https://youtu.be/Gcv3333bIZE'>YouTube</a>. General administrative information pertaining to the research and the presentation can be viewed via the University of Northern Iowa's <a href='https://scholarworks.uni.edu/surp/2020/all/10/'>SURP 2020 Symposium</a> website. Finally, a repository of the work done can be viewed via my personal <a href='https://github.com/alanmmckay/population_protocol_simulator'>GitHub</a> page.
                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Research: Population Protocol</h1>
                    </header>
                    <h2>Background</h2>
                    <p>
                        The modern computer uses a specific computational model that allows it to compute the set of functions which affords the utility that its users are familiar with. This computational model is the Boolean Circuit, often associated with 0’s, 1’s, and the various circuits which manipulate these values.
                    </p>

                    <p>
                        Another model of computation is the Turing Machine.  A Turing Machine can be thought of as a set of nodes which determine the various states of a machine in conjunction with an infinite tape that allows the machine to read and write values. This model is able to compute the same set of problems as the Boolean Circuit model.
                    </p>

                    <p>
                        A new model has recently emerged: The Population Protocol. This new model was conceived by Angluin et al. <a href='#references1'>[1]</a><a href='#references2'>[2]</a> in the mid 2000’s, the primary motivator being distributed computing. Theory has since been established, proving that the set of problems the model can solve is a subset of the previously discussed models. This subset is still powerful. Research has been done since exploring possible ways of expanding the model to afford more computational power and to find ways to make the model more reliable.
                    </p>

                    <h2>The Model</h2>
                    <p>
                        The Population Protocol consists of a set of anonymous agents which randomly interact with each other. Each agent is a Finite State Machine, or a memory register, which holds a value from a predefined set of values. The state of an agent may change depending on an interaction with another. The conditions and results which define these special interactions are noted in a transition function. The protocol carries out these interactions within the set of agents indefinitely.
                    </p>

                    <p>
                        Formally, a Population Protocol consists of the following elements:
                        <ul>
                            <li> Set Q; finite set of possible states for an agent </li>
                            <li> Set Σ; a finite input alphabet </li>
                            <li> Input map ι;  an input map from Σ to Q, where ι(σ) represents the initial state of an agent whose input is σ</li>
                            <li> Output map ω; an output map from Q to the output range Y, where ω(q) represents the output value of an agent in state q </li>
                            <li> Transition function δ; a transition relation that describes how pairs of agents interact</li>
                        </ul>
                    </p>

                    <h2>Algorithms, Simulations, and Analysis</h2>
                    <p>
                        Consider a scenario in which a group of birds are given sensory tags. These sensors are very primitive and throw a flag when an individuals’ temperature reaches a certain threshold. The sensors can also communicate with each other when they are within a certain range. Does a protocol exist that allows these sensors to communicate to the population if an individual’s temperature has reached the specific threshold?
                    </p>
                    <p>
                        Consider the following protocol:
                    </p>
                        <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:35em;padding-left:10px'>
Q = {L,H}
Σ = {L,H}
ι(x) = x
ω(x) = x
δ = {
    (L,L) -> (L,L),
    (L,H) -> (H,H),
    (H,L) -> (H,H),
    (H, H) -> (H,H)
    }
</pre>
                        </code>
                    <p>
                        The above protocol is equivalent to running an AND boolean operation on a population where L=1 and H=0.
                    </p>
                    <p>
                        A bird’s sensor switches from L to H when it’s temperature reaches the threshold. When it interacts with another bird, it will then communicate this fact. The following is one possible set of interactions a group of  5 birds may exhibit when one has a status of H:
                    </p>
                    <figure>
                        <img src="../../images/pp_A.png" style="max-width:400px;"/>
                        <figcaption style='max-width:450px;margin:auto;margin-top:1%;'>
                            Figure A.
                        </figcaption>
                    </figure>
                    <p>
                        Note the above set of interactions is a subset of a set of potential interactions. Within this superset exists an infinite amount of sets which may contain an infinite amount of interactions. The fifth step highlights this reason by showing two agents have interacted with each other redundantly. That is, the interaction has no bearing on progressing the state of the population to convergence. It is by the convergence of a solution enforced by a loose fairness condition that these algorithms are evaluated and developed.
                    </p>
                    <p>
                        This Population Protocol helps highlight some of the pitfalls of the model. What happens if the agent initially marked with H fails before it is able to interact with another? Fault tolerance is an aspect Dr. Berns and I are looking into.
                    </p>
                    <section class='info'>
                        <hr>
                        <h3>Expanded Algorithms</h3>
                        <p>
                            What if a population wants to report if a certain percentage meets a threshold? One approach is to allow each agent access to 3 finite state machines. One to track a numerator, another to track a denominator, and the third as a boolean value to determine if an agent has already been evaluated for computation.
                        </p>
                        <!--div class='aside'>
                            <figure class='narrow'>
                                <img src='../../images/pp_B.png' style='width:95%;max-width:150px'/>
                                <figcaption>
                                    Figure B.
                                </figcaption>
                            </figure-->
                            <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:40em;padding-left:10px'>
Q = {L -/-, H -/-, 0 n/m, 1 x/y} where n,m,x, y are Integers
Σ = {L, H}
ι(x) = x
ω(0 n/m) = ω(1 n/m) = n/m
δ = {
    (H -/-,H -/-) -> (2/2, 2/2),
    (L -/-, H -/-) -> (1/2, 1/2),
    (H -/-, L -/-) -> (1/2, 1/2),
    (L -/-, L -/-) -> (0/2, 0/2),
    (0 n/m, 0 x/y) -> (0 (n+x)/(m+y), (1 (n+x)/(m+y)),
    (0 n/m, 1 x/y) -> (0 n/m, 1 n/m)
    }
</pre>
                            </code>
                            <p>
                                This Algorithm can be used in conjunction with leader election and epidemics<a href='#references3'>[3]</a><a href='#references4'>[4]</a> to ensure data is ready to be collected.  Once it is, the collector simply has to check the given ratio.
                            </p>
                        <!--/div-->
                        <hr>
                    </section>
                    <p>
                        To help better understand the concept as a whole, we have built a simulator which keeps track of the iterations of a protocol’s execution while monitoring relevant data such as redundant interactions that may contribute to developing more complex algorithms for this model. Figure B represents a heatmap of redundant interactions between agents of a population of 15. Figures A, and B both include graphs output by the simulator we have constructed.
                    </p>
                    <hr>
                    <h2> Future and Application </h2>
                    <div class='aside'>
                    <figure class='narrow'>
                        <img src="../../images/pp_C.png" style='max-width:200px;'/>
                        <figcaption>
                            Figure B.
                        </figcaption>
                    </figure>
                    <p>
                        With the simulator we’ve built, the goal is to be able to implement and test a suite of population protocols to explore fault tolerance. Heatmap output should help us hone in on any potential bottlenecks caused by more advanced algorithms involving agents with differing roles.
                    </p>

                    <p>
                        This specific heat map (Figure B) shows the set of agents and each potential path of interaction.  Higher intensity of color between a pair of agents indicates a greater amount of redundant interactions between the two. This emphasizes the fact that an agent’s failure may cause problems in terms of the execution of the protocol as it’s information may be critical for convergence.
                    </p>
                    <p>
                        Exploration of this computational model will allow us to make the most of the primitive computational power afforded by simple hardware. This can be extended to automated drone communication. Beyond development of the simulator, we would like to develop and test practical application with the usage of drones and drones communicating with sensory networks.
                    </p>
                    </div>
                    <h2>References</h2>
                    <ul style='list-style-type:none;'>
                        <li id='references1'>[1] Angluin, Dana ; Aspnes, James ; Diamadi, Zoë ; Fischer, Michael ; Peralta, René. Computation in networks of passively mobile finite-state sensors. Distributed Computing, 2006, Vol.18(4), pp.235-253</li>

                        <li id='references2'>[2]  Aspnes, James &amp; Ruppert, Eric. 2009. An Introduction to Population Protocols. Bulletin of The European Association for Theoretical Computer Science - EATCS. 93</li>

                        <li id='references3'>[3]  Angluin, Dana ; Aspnes, James ; Eisenstat, David. Fast computation by population protocols with a leader. Distributed Computing, 2008, Vol.21(3), pp.183-199</li>

                        <li id='references4'>[4] Alistarh, Dan &amp; Gelashvili, Rati. (2018). Recent Algorithmic Advances in Population Protocols. ACM SIGACT News. 49. 63-73.</li>
                    </ul>
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>
