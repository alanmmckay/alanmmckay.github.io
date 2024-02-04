<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'https://alanmckay.blog/projects/dataflow/';

$title = 'Alan McKay | Projects | Privacy and Data Flow';

$meta['title'] = 'Alan McKay | Privacy and Data Flow';

$meta['description'] = '';

$meta['url'] = 'https://alanmckay.blog/projects/dataflow/';

$relative_path = "../../";

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
                        <h1>Estimating Flow and Validating Disclosures</h1>
                    </header>
                    <h2>1&nbsp;&nbsp;&nbsp;&nbsp; Introduction</h2>
                    <h3>1.1&nbsp;&nbsp;&nbsp; Context</h3>
                    <p>
                        Online privacy has become an increasingly pressing concern in today’s digital age. As more and more personal information is collected and shared online, users are becoming increasingly aware that their data is used for targeted advertising purposes. Targeted advertising is the practice of using data to personalize advertisements to specific individuals based on their online behaviors, a phenomenon which is often not in the general consumer’s best interest.
                    </p>
                    <p>
                        The targeted advertising ecosystem largely remains a black box, with little transparency into how user data is collected, processed, and used. This lack of transparency has led to concerns about the potential for misuse of personal data, and has made it difficult for users to understand and control their online privacy.
                    </p>
                    <p>
                        To address this issue, various methodologies have been developed to measure and analyze the targeted advertising ecosystem. These methodologies aim to provide insights into how data is collected and used, ultimately helping users make more informed decisions about their online privacy.
                    </p>
                    <p>
                        One approach to measuring the targeted advertising ecosystem is to observe and analyze the outcomes of communication between online entities. This includes analyzing the behavior of online advertising networks, tracking pixels, and cataloging third-party cookies. These observations provide a glimpse into how user data is collected and used, and can help identify potential privacy risks.
                    </p>
                    <p>
                        Another approach is to leverage machine learning to predict communication patterns within ad-networks. This process relies on observing the effect of manipulating a single piece of data in the ad-network and noting how the network responds.
                    </p>
                    <p>
                        While these methodologies are useful, they only propose an absolute binary decision with respect to the metric being used to discover the communication between advertising entities. That is, they only answer the question of whether a relation exists or not. It is often that these methodologies make conclusions based purely on the context of the specific study at hand, leading to a fragmented understanding of the targeted advertising ecosystem.
                    </p>

                    <h3>1.2&nbsp;&nbsp;&nbsp; Contribution</h3>
                    <p>
                        This research proposes a framework in which the results of various privacy studies can be aggregated; in which the degree to which entities share data can be gauged. Within the the proposed framework, these relationships are predicted on a certainty gradient, by a measure of confidence derived from a multi-layer graph. This framework will help provide a more comprehensive understanding of the targeted advertising ecosystem and enable an assessment to the potential ramifications to a more accurate degree.
                    </p>
                    <p>
                        The proposed framework will build upon current methodologies and their results, providing a more complete understanding of the targeted advertising ecosystem. The findings of this research will be useful for individuals who seek to better understand and navigate the complex world of targeted advertising. Therein, we aim to further decisions regarding privacy and security of user data.
                    </p>
                    <h3>1.3&nbsp;&nbsp;&nbsp; Road Map</h3>
                    <p>
                        The proposal will begin with an outline of the current landscape of advertising networks: how the networks interact with users, mechanisms to balance the scale of online privacy, and related previous works. Following this, the proposal will offer background on related technical and legal concepts, definitions, necessary methods, and the technical problems that arise from the proposed framework. The proposal then concludes with discussion of the potential of a web API, discussion of validation to the methodology, and an address to the limitations and future work.
                    </p>
                    <h2>2&nbsp;&nbsp;&nbsp;&nbsp; Motivation</h2>
                    <h3>2.1&nbsp;&nbsp;&nbsp; The perimeter of the Black Box</h3>
                    <p>
                        Communication within ad networks operate as a black box, with little transparency into their inner workings, rendering detection difficult. Surface features of such networks can be determined by observing the attributes of digital advertising in web browsers. However, such methods do not provide a complete or detailed picture of the routes data travels (see figure 1). These ad networks are built by use of web tracking, which occurs via placement of various mechanisms into the browsing environment that an ad entity can use to track the user.
                    </p>
                    <figure class='graph'>
                        <img src='../../images/black_box_diagram.png'>
                        <figcaption>
                            Figure 1: The advertising network black box exists as part of a system that interacts with the user by means of their interaction with a web platform as an input and advertisements for that user as an output.
                        </figcaption>
                    </figure>
                    <p>
                        Cookies are such a mechanism. Although one of their original functions was to save a user’s shopping cart between browser sessions, cookies have evolved to allow a data aggregator to gain insight into a user’s browsing history. When a user visits a web page, web scripts are inserted into the page by a tracker which can access the website’s cookies. This connection allows communication of relevant information to the black box, which produces an advertisement from another web server. Researchers can measure the origin of the scripts that exist on a web page as well as the origin of the servers that return the advertisements, but are limited in observations beyond this communication. The resulting data is a tracking domain communicating with an advertising domain. This level of communication produces the so-called perimeter of the black box.
                    </p>
                    <p>
                        Researchers have endeavored to observe communication past this perimeter. One such study observes that as the web browser loads a tracking script, the server in which the script serves may change as the page is gradually rendered.<a href='#references2'>[2]</a> This is implicit of an information flow as one server communicates to another, passing information. A browser can be instrumented to take a snapshot of each mutation of the script, which gives a more complete picture of who is talking to who and the related information flow during the execution of the script.
                    </p>
                    <p>
                        Other studies, as in <a href='#references4'>[4]</a>, have focused on the surface features of Real Time Bidding (RTB) auctions, a mechanism used by trackers to sell advertising space to advertisers. Some of the communication pertaining to space bidding are handled on a client to provide a closer interface to the tracking scripts; something that can be measured by any client machine. These measurements contribute to the mapping of the advertising networks at play.
                    </p>
                    <p>
                        As time has progressed, users have become privy to some of the approaches advertising entities have taken to track them. This increase in awareness has led many to disable functionality within their web browser; disabling cookies, for example. Data aggregators counteract these evasive measures by users by conceiving new approaches, such as fingerprinting, to track user browsing history without reliance on the storage of a user’s browsing environment. Browser fingerprinting works by collecting information about a user’s browser, such as the version, installed plugins, fonts, and device characteristics, such as screen resolution and operating system. This information is then combined to create a unique identifier or "fingerprint" for the user’s device.
                    </p>
                    <p>
                        Advertising entities use browser fingerprinting to track users across different websites and build a profile of their interests and behavior. This allows the continuation of the delivery of targeted ads based on the user’s browsing history and preferences. Data gathered via fingerprinting can contribute to the building of a user’s browsing profile, whether cookies are enabled or not. Data pertaining to a specific fingerprint can then be collated between advertising entities using a universal identifier.
                    </p>
                    <p>
                        Fingerprinting along with a push from client-side RTB to serverside are two reactions from advertisers which are emblematic of the privacy arms-race occurring online. These reactionary efforts seek to obfuscate data-sharing; an effort to fortify the perimeter of the black box.
                    </p>
                    <h3>2.2&nbsp;&nbsp;&nbsp; Inferring Relationships</h3>
                    <p>
                        An advertising entity infers what a given user may like to purchase by evaluating their browsing history. This history is important as it allows the examination of patterns of a user’s behavior. These patterns can be used to make the best recommendation given the context of the user. An advertisement mechanism within the black box will likely serve out an advertisement option in which it has the most confidence that the user will engage with.
                    </p>
                    <p>
                        The key terms at this point are: inference, pattern, and confidence. Advertising entities likely leverage machine learning to help make these decisions. Machine learning and AI are concepts that seek to emulate that which the human brain is traditionally better at performing: pattern matching. Consider the CAPTCHA: a piece of web software where human users recognize patterns of images which helps a website filter out bots. CAPTCHA data is currently being repurposed as a training set for machine learning algorithms used by self driving cars: recognizing traffic signals, crosswalks, and various automobiles.
                    </p>
                    <p>
                        Machine learning operates on a set of conditions and makes a set of decisions based on conditions known as features. Each decision made is tailored to maximize the integrity of the feature set. A selfdriving car may look at an image feed and conclude that a certain arrangement of pixels has a strong correlation to the set of pixels that we, users of CAPTCHA, have associated as a feature of a traffic light and provided as training data for the AI.
                    </p>
                    <p>
                        In the context of advertising, a similar algorithm likely evaluates the conditions of the user. In this case, the feature set includes browsing history, purchase history, and any other relevant actions. The machine learning algorithm tries to match this pattern to a personalized advertisement. How this algorithm ultimately makes the decision is often a black box even for those who maintain it. As a result, the process of running live data points on a machine learning algorithm to calculate an output is dubbed an "inference system."
                    </p>
                    <p>
                        Studies which have helped map advertising networks have sought to maximize these feature sets to produce a measurable outcome.<a href='#references3'>[3]</a> Specifically, researchers formulate online personas which are shaped to maximize the targeting of personal advertisements. The methodology involves creating fictitious online personas that represent potential users with specific interests and demographics. By interacting with the ad network, data can be collected with respect to the targeting criteria used by the network. This data can then be used by researchers to gain insight into the targeting methods used by the ad network and the types of personal data being used to inform targeting.
                    </p>
                    <p>
                        The apex of this bewildering chain of inference arms-race is encapsulated by a machine learning study which seeks to infer advertising relationships by leveraging online personas. <a href='#references3'>[3]</a> The study blocks individual trackers from a page, then gathers data points which record the change in behavior. It’s not guaranteed that a blocked tracker would have won a RTB auction, so the effect cannot be guaranteed. Site behavior can instead be predicted with a degree of confidence. Thus, the resultant data acts as a training set for a machine learning algorithm, ATOM, which is used to make an inference of a data sharing relationship between an advertiser and a tracker. It does so with a high degree of accuracy compared to a control set.
                    </p>
                    <h3>2.3&nbsp;&nbsp;&nbsp; User and Regulatory Confidence</h3>
                    <p>
                        The tension of obfuscation is something advertising entities have generally been domineering. What they can infer about the user is not reciprocated. Legislation and law is starting to help balance the scale in this regard. Regulations are starting to provide mechanisms for users to ask an advertising entity what exactly it is that they know about a user and who they shared that information with. This provides the user an easier look at the perimeter of the black box. Should they choose, the user can look past the perimeter by following the chain of entities whom the data was shared with and request disclosures from each of them. This can be time consuming and hinges on the entities involved being compliant with the regulations in place.
                    </p>
                    <p>
                        For a regulatory auditor to validate compliance, (and for a user to trust feedback from advertising entities), a set of tools need to be leveraged. Some of these tools should consider what has been historically validated through data of relationships gathered via studies. These tools should also be flexible to accept data from future works. These works can be future studies which explore a specific feature of the advertising network. It should also consider data returned from feedback of compliance; Advertising entities who explicitly state that they have a communication channel with another entity and have shared information on this channel.
                    </p>
                    <p>
                        One such tool should also present the amalgamation of this information in a digestible manner. It should consider the weight of confidence relevant to all features brought forth from the differing sets of data and present a user a visual of the network that reflects this collection of features. The tool should allow a user to anonymously define its context - the type of devices they use, the websites and platforms they visit, type of content they digest, the region in which they live, etc. It should also allow a user to declare which ad entities have disclosed that they’ve used data of the user and which entities it has been shared with. With this information, the network will then help the user infer which advertising entities likely have their data based on these relationships. This inference will be associated with some level confidence.
                    </p>
                    <p>
                        The visual tool will estimate data flow and help validate disclosure. It will present confidence of inference by presenting the advertising entities within a graph such that the context the user provides will cluster entities who are likely communicating the user’s information (see figure 2b). This paper will formalize such a tool. Formalization requires the definition of the concepts in the next section.
                    </p>
                    <figure class='fig-col'>
                        <figure class='graph'>
                            <img src='../../images/random_network.png' style='max-width:200px;'>
                            <figcaption>
                                (a) Conceptual slice of the discovered advertising network.
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='../../images/scale_free_network.png' style='max-width:200px;'>
                            <figcaption>
                                (b) A concept of the network processed through the tool.
                            </figcaption>
                        </figure>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 2: Network Examples
                        </figcaption>
                    </figure>
                    <h3>2.4&nbsp;&nbsp;&nbsp; Previous Work</h3>
                    <p>
                        Although the current research on technological privacy law is limited, scholars like Christo Wilson, Zubair Shafiq, and Rishab Nithyanand publish bodies of work which delve into the intricacies of data sharing and disclosures, and the field is ever-growing.
                    </p>
                    <p>
                        To understand and audit new privacy laws and regulations, research first needs to address the current state of the internet and where consumers’ data interests are violated. Data-sharing practices are an element of data aggregator behavior that needs further regulation.
                    </p>
                    <p>
                        In the paper "ATOM: Ad-network Tomography", Nithyanand and Bin Musa address the black box nature of data sharing between data aggregators, and acknowledge that CCPA audits are made difficult by the lack of transparency as to the routes through which data spreads. They propose a framework, ATOM, which enables tracker-blocking strategies, then observes changes in site behavior to theorize advertiser relationships where data spread occurs.<a href='#references3'>[3]</a>
                    </p>
                    <p>
                        In the paper "Tracing Information Flows Between Ad Exchanges Using Retargeted Ads", the authors track information sharing between data aggregators, and develop a new auditing mechanism for examining these relationships. The authors find that existing auditing frameworks that rely on cookie matching "are unable to identify 31% of ad exchange pairs that share data." <a href='#references2'>[2]</a>.
                    </p>
                    <p>
                        The authors develop a method which tracks client-to-server-side sharing through retargeted ads. A retargeted ad is an advertisement personalized towards a user with a product they directly interacted with. For example, a Facebook ad for a Target shirt that a user had placed in their Target.com shopping cart would indicate that Facebook and Target may have a data sharing relationship. After crawling the web, the authors formulate an open-source dataset of retargeted ad relationships between data aggregators.
                    </p>
                    <p>
                        In the paper "Inferring Tracker-Advertiser Relationships in the Online Advertising Ecosystem using Header Bidding", the authors also aim to track data sharing relationships not captured by cookiesyncing studies. They propose a new system, KASHF, which uses a machine learning algorithm to predict how advertisers bid for ad space based on the information they have about users.<a href='#references4'>[4]</a>
                    </p>
                    <p>
                        The researchers focus on Header Bidding, a variation of Real Time Bidding (RTB). RTB is a mechanism that determines how ads are dynamically placed on websites for different users, by offering ad space to high-profile advertisers first, then continuing on taking bids from advertisers in a waterfall manner to fill the space. Header Bidding is a more competitive variation on RTB in which advertisers can all place bids simultaneously for ad space depending on the consumer.
                    </p>
                    <p>
                        KASHF can use Header Bidding prediction to analyze data sharing routes between entities by observing bidding by advertisers change depending on the information available to certain trackers about a consumer.
                    </p>
                    <p>
                        The paper "Diffusion of User Tracking Data in the Online Advertising Ecosystem", employs a similar philosophy to KASHF, but with Real Time Bidding instead of Header Bidding. The authors of this paper use the dataset from the paper "Tracing Information Flows Between Ad Exchanges Using Retargeted Ads", and verify these relationships depending on advertiser behavior in RTB. The authors were able to formulate inclusion trees connecting the data spread from tracker data to advertisers. The authors predict that the top advertising companies collect from 91% to 99% of user browsing data. <a href='#references1'>[1]</a><a href='#references2'>[2]</a><a href='#references4'>[4]</a>
                    </p>
                    <p>
                        The methods in the above papers vary, from observation of advertiser bidding, to tracker blocking, but the papers all focus on the same goal as this work: to explore routes through which data sharing occurs. Another similarity between these related works is the nature of their datasets. Each research group tracks relationships between advertisers, trackers, and data aggregators as binary: the relationship does or doesn’t exist. This work aims to aggregate the varying research methods in the field in a gradient, non-binary manner. We acknowledge that an outside observer cannot be sure where data sharing is occurring, and that these datasets exist on a spectrum of confidence. This auditing framework could be expanded and applied to a large body of datasets to create a true image of the state of internet data-sharing. As a proof of concept, we apply the theory to a small subset of data, addressed in section 4.1.
                    </p>
                    <h2>3&nbsp;&nbsp;&nbsp;&nbsp; Background and Definitions</h2>
                    <h3>3.1&nbsp;&nbsp;&nbsp; Terminology</h3>
                    <ul>
                        <li>
                            <i>Personally Identifiable Information (PII)</i>: Information that can identify, or be aggregated to identify, an individual.
                        </li>
                        <li>
                            <i>Entity</i>: A company or corporation with the ability to store and share the personal data of individuals.
                        </li>
                        <li>
                            <i>Data sharing</i>: The exchange of an individual’s information between two entities.
                        </li>
                        <li>
                            <i>Confidence Score</i>: A score attached to an edge as a weight between two entity nodes capturing the confidence that a relationship exists between them.
                        </li>
                        <li>
                            <i>Relationship Network</i>: A network 𝐺 detailing the relationships between entities. The node set is defined as the entities and the weighted edge set is defined by a measure of the data sharing relationship between them.
                        </li>
                        <li>
                            <i>Aggregated Relationship Network</i>: Given a set of 𝑁 relationship networks 𝐺1, ...,𝐺𝑁 consisting of node set 𝑉 and edge sets 𝐸1, ..., 𝐸𝑁 , an aggregated relationship network combines the edge sets into a single graph with edge weights that quantify a confidence score of data sharing between pairs of entities.
                        </li>
                        <li>
                            <i>Observed Data Possession</i>: When an entity is observed to possess personally identifiable information.
                        </li>
                        <li>
                            <i>Network Topology</i>: The description of a network structure, often with a node degree distribution as a hallmark.
                        </li>
                        <li>
                            <i>Data Proliferation</i>: The expected fraction of entities in an aggregated relationship network to possess personally identifiable information after a network diffusion process.
                        </li>
                    </ul>
                    <h3>3.2&nbsp;&nbsp;&nbsp; Legal Disclosure Mechanisms</h3>
                    <p>
                        Current data regulation laws worldwide are by-in-large modeled after Europe’s General Data Protection Regulation (GDPR), which was established in 2016 and outlines eight rights: the right of access, the right to rectification, the right to erasure, the right to restrict processing, the right to data portability, the right to object, and the right to opt out of automated decision making. These rights enable consumers to access the data that companies collect about them, correct inaccuracies, and remove consent for data-sharing as easily as they provided it. Since the ratification of GDPR, Data Protection Authorities (DPAs) across Europe have levied thousands of warnings and fines to data aggregators.
                    </p>
                    <p>
                        In the past years, laws and regulations enacting the same rights as GDPR have cropped up around the world. Some of the most influential have been the California Consumer Protection Act (CCPA) in 2018 amended by the California Privacy Rights Act (CPRA) in 2020, China’s Personal Information Protection Law (PIPL) in 2021, and most recently the European Digital Marketing Act (DMA) in 2023.
                    </p>
                    <p>
                        The "right to access" codified in these laws allows users to receive a full copy of the data collected about them, including a requirement for logging data processing and tracking disclosure of data sharing to third parties. However, there is currently no American federal data privacy law. Therefore, apart from states like California who have implemented independent data laws, data sharing to thirdparties continues unchecked.
                    </p>
                    <p>
                        Within CCPA, third party sharing is limited. Per section 1798.115.1.2 of CCPA, personal information shared with a third party cannot be further shared or sold without explicit notice to the user. Therefore, through these legal frameworks and disclosures, relationship networks should reach no further than one degree out from the source. Data regulations may trend towards restricting data sharing between companies, but current research nevertheless tracks large data sharing networks. If a consumers’ data reaches Alphabet or Meta, the spread continues to their huge web of partners with little to no oversight from regulatory bodies.
                    </p>
                    <p>
                        An individual disclosure from some entity 𝐴 will contain a set of entities 𝐵1, ..., 𝐵𝑛 that 𝐴 claims to have shared data with. It is unlikely that entity 𝐴 will falsely report instances of sharing, that is, we assume to get a negligible amount of false positives. The more likely scenario is that an entity will omit instances of sharing that did happen, so we expect to receive more false negatives than false positives. Therefore, these disclosures may present a pathway for some researchers to explore connections between data aggregators. However, under CCPA, companies can take 45-90 days to share this data, and accuracy and level of detail may vary. This paper presents a different approach to mapping these networks, that could then be compared and audited by CCPA disclosures.
                    </p>
                    <h3>3.3&nbsp;&nbsp;&nbsp; Graphs/Networks</h3>
                    <p>
                        A graph 𝐺 (see figure 3b) refers to an abstract mathematical object describing relationships between a set of nodes 𝑉 through edges 𝐸 between them. The degree of a node refers to how many edges it is connected to. The distribution of these values over the entire graph is known as the degree distribution. For some graphs most of the nodes have similar degrees (a uniform distribution) and for others there may be a few nodes with a high number of edges while the rest have a low degree (power-law distribution). Graphs can be either undirected (edges denote a 2-way connection as in figure 3a) or directed (edges denote a 1-way connection as in figure 3a). A network is what we refer to when we use a graph to model real-world relationships.
                    </p>
                    <p>
                        A multi-layer graph 𝐺&#770; (e.g., see figure 3a) is one that has a single set of nodes or points 𝑉 , but multiple types of edge sets 𝐸1, ..., 𝐸𝑁. Each edge set connects the nodes with different types of edges defined as a layer. The edge sets are used to represents varying types of relationships between nodes.
                    </p>
                    <p>
                        For example, suppose we wish to represent two different relationships between entities. Edges in the first layer represent entities that have been inferred to share data, such as in Bashir, et. al. <a href='#references2'>[2]</a>. Edges in the second layer are to be based on corporation ownership data (e.g., Lexus is owned by Toyota). Therefore, a multi-layer graph can represent the same companies, but express a distinction between different varieties of company relationships or, as we will propose, varying confidence that a relationship exists.
                    </p>
                    <figure class='fig-col'>
                        <figure class='graph'>
                            <img src='../../images/multi-layered-graph.png' style='max-width:200px;'>
                            <figcaption>
                                (a) Multi-layer graph with 4 nodes and 2 layers.
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='../../images/multi-layered-graph-weights.png' style='max-width:200px;'>
                            <figcaption>
                                (b) Weighted and directed graph with 4 nodes and 5 edges.
                            </figcaption>
                        </figure>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 3: Graph examples.
                        </figcaption>
                    </figure>
                    <h3>3.4&nbsp;&nbsp;&nbsp; Network Diffusion Process</h3>
                    <p>
                        A network diffusion process M describes how spreading on networks occurs, such as infections or ideas. In this paper, we focus on the diffusion of data. Given a network 𝐺 = (𝑉 , 𝐸,𝑤) (where 𝑉, 𝐸, and 𝑤 represent nodes, edges, and weights, respectively), and an initial set of nodes which possess some personally identifiable information, a network diffusion process is defined by a set of rules which govern how the data is shared and which nodes will ultimately possess that data.
                    </p>
                    <p>
                        As an example, one such process can be defined by the independent cascade model. Let 𝐺 = (𝑉 , 𝐸) be a directed graph with node set 𝑉 and edge set 𝐸. We have a set V ⊆ 𝑉 of initially activated nodes. For this process, once a node is activated it cannot revert to being inactive. After the initial activation, we define discrete time steps 𝑡 for which the process will progress. We define the end of a diffusion process to be when no additional nodes can be activated. After a given diffusion process finishes, 𝜎(V) denotes the number of nodes we expect to be activated given the initially activated nodes V. Since these diffusion models are stochastic, 𝜎(V) is the expectation of a random variable. We will revisit this concept and its relevance in section 4.7.
                    </p>
                    <h2>4&nbsp;&nbsp;&nbsp;&nbsp; Materials and Methods</h2>
                    <h3>4.1&nbsp;&nbsp;&nbsp; Data</h3>
                    <h4>4.1.1&nbsp;&nbsp; Cookie Disclosure Datasets</h4>
                    <p>
                        In 2011, the European ePrivacy Directive (Directive 2009/136/EC), colloquially known as the cookie law, was enacted in Europe. It requires accessible and thorough cookie disclosures from all companies collecting data in the EU, and effectively mandates companies list the types of cookies or actual cookies they use. <a href='#references7'>[7]</a>
                    </p>
                    <p>
                        Many data aggregators therefore have a section of their site with their legal documents or privacy policy containing a cookie-table or cookie-policy (see Table 1). Some companies further provide a list of companies with which they share third-party cookies for advertising or data-tracking purposes.
                    </p>
                    <figure>
                        <table style='background-color:#f1f1f1;padding:5px;'>
                            <thead>
                                <tr>
                                    <th>Cookies</th>
                                    <th>Domain</th>
                                    <th>Descritpion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>_gads</td>
                                    <td>google.com</td>
                                    <td class='table-description'>
                                        This cookie is associated with the DoubleClick for Publisher service from Google. Its purpose is to do with the showing of adverts on the site, for which the owner may earn some revenue.
                                    </td>
                                </tr>
                                <tr>
                                    <td>_uin_an, _uin</td>
                                    <td>sonobi.com</td>
                                    <td class='table-description'>
                                        This cookie is owned by Sonobi, an automated audience buying and selling platform for online advertising.
                                    </td>
                                </tr>
                                <tr>
                                    <td>_cc_aud</td>
                                    <td>lotame.com</td>
                                    <td class='table-description'>
                                        This domain is owned by Lotame. The main business activity is: Data Management Platform - Targeting/Advertising.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <figcaption>
                            Table 1: Advertiser cookie disclosure table provided by Microsoft.
                        </figcaption>
                    </figure>
                    <p>
                        This data is limited by the fact that it relies on companies to self-disclose, but is easily accessible for the sake of a proof of concept graph. By web scraping for cookie-policies and tracking the standardized formatting and language of the cookie disclosure tables, we can obtain lists of data sharing relationships between data aggregators.
                    </p>
                    <p>
                        In this work, we performed a small scrape of these cookie policies, starting with Microsoft.com, then iterating through Microsoft’s declared cookie-sharing partners to find their cookie tables. With this method, we were able to identify 606 entity relationships across 32 data aggregators including Microsoft, Amazon, Adobe, Ziprecruiter, Taboola, MediaMath, Uber, and Twitter. Moreover, this method provided us with clean, standardized data as a base for the more complex research datasets we also examined.
                    </p>
                    <h4>4.1.2&nbsp;&nbsp; Synthetic Data</h4>
                    <p>
                        We also outline a method to generate synthetic datasets that mimic the degree distributions of previous datasets we have inspected in section 4.2.2.
                    </p>
                    <h3>4.2&nbsp;&nbsp;&nbsp; Data Processing</h3>
                    <p>
                        The purpose of processing data into a network is to enable us to solve computational problems using those relationships.
                    </p>
                    <h4>4.2.1&nbsp;&nbsp; Cookie Disclosure Datasets</h4>
                    <p>
                        We process these datasets simply by taking the union of each graph. They are currently unweighted, so we only seek to connect each disclosure together. Some of these individual networks are shown in figure 4 and the aggregated network is shown in figure 5.
                    </p>
                    <figure class='fig-col'>
                        <figure class='graph'>
                            <img src='graphs/cbre.png' style='max-width:250px;'>
                            <figcaption>
                                CBRE
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='graphs/all-live-doubleclick-sites.png' style='max-width:250px;'>
                            <figcaption>
                                All-Live_DoubleClick.Net-Sites
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='graphs/linkedin.png' style='max-width:250px;'>
                            <figcaption>
                                Linkedin
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='graphs/microsoft.png' style='max-width:250px;'>
                            <figcaption>
                                Microsoft
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='graphs/roundup.png' style='max-width:250px;'>
                            <figcaption>
                                Roundup
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='graphs/roundup2.png' style='max-width:250px;'>
                            <figcaption>
                                Roundup2
                            </figcaption>
                        </figure>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 4: Individual networks
                        </figcaption>
                    </figure>
                    <figure>
                        <img src='graphs/gagg.png' style='max-width:350px;'>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 5: Aggregated network
                        </figcaption>
                    </figure>
                    <figure>
                        <img src='graphs/gagg_degreedist.png' style='max-width:350px;'>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 6: Aggregated network degree distribution
                        </figcaption>
                    </figure>
                    <h4>4.2.2&nbsp;&nbsp; Synthetic Data</h3>
                    <p>
                        We use the dual-Barabási-Albert model <a href='#references13'>[13]</a> with parameters 𝑚1 = 3, 𝑚2 = 1, and 𝑝 = 0.3. We use this model to mimic the nature of datasets inspected so far, which have a highlyconnected core and many degree-1 nodes branching out. In this model, we start with max(𝑚1,𝑚2) nodes. We then iteratively add the remaining nodes one at a time, with probability 𝑝 of having 𝑚1 edges and probability 1 − 𝑝 of having 𝑚2 edges added according to the Barabási-Albert model <a href='#references14'>[14]</a> resulting in a "ground truth" graph 𝐺. We then proceed in two phases:
                    </p>
                    <p>
                        <u>Phase 1</u>: We begin by removing 𝑁<sub>𝑝1</sub> (determined by sampling from a uniform distribution in a given range) nodes and 𝐸<sub>𝑝1</sub> edges from 𝐺, resulting in 𝐺′. We then assign weights 𝑤<sub>𝑖𝑗</sub> ∈ [1, 10] sampled from a Pareto distribution to each edge in 𝐺′.
                    </p>
                    <p>
                        Phase 2: Stemming from 𝐺′, we produce a set of 𝐾 networks. Foreach network initialized to 𝐺′<sub>𝑘</sub> ← 𝐺′, perform the following:
                        <ol>
                            <li>
                                Choose 𝑁<sub>𝑝2</sub> nodes uniformly at random to remove from 𝐺′<sub>k</sub>
                            </li>
                            <li>
                                Repeat 𝐸<sub>𝑝2</sub> times:
                                <ul>
                                    <li>
                                        Randomly sample a value 𝑑 ∈ [𝑑<sub>1</sub>, 𝑑<sub>2</sub>], where 𝑑<sub>1</sub> ≥ 1 and 𝑑<sub>2</sub> ≤ 10 are given endpoints of a range of values.
                                    </li>
                                    <li>
                                        Choose an edge uniformly at random from 𝐺′<sub>𝑘</sub> and assign its weight to 𝑤′<sub>𝑖𝑗</sub> ← max(0,𝑤′<sub>𝑖𝑗</sub> − 𝑑).
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Remove any completely disconnected nodes.
                            </li>
                        </ol>
                        We are left with a set of synthetic entity relationship networks 𝐺<sub>𝑆𝑌𝑁</sub> = {𝐺′<sub>1</sub>, ...,𝐺′<sub>𝑘</sub>}.
                    </p>
                    <h3>4.3&nbsp;&nbsp;&nbsp; Aggregating Entity Relationship Networks</h3>
                    <p>
                        The following section defines the main component of our framework: a mathematical approach to combine multiple networks into one multi-layer graph that gives a confidence scores for each edge.
                    </p>
                    <p>
                        We define <i>collapsing</i> a set of entity relationship networks 𝐺<sub>𝑀</sub> = 𝐺<sub>1</sub>, ...,𝐺<sub>𝑁</sub> by aggregating their edge weights to reflect an overall relationship between nodes. We define this as a collapse function 𝐶 : 𝑉 × 𝑉 → R that maps each pair of nodes (𝑢, 𝑣) ∈ 𝑉 × 𝑉 to a <i>confidence score</i> that represents how sure we are of a data sharing relationship between entities.
                    </p>
                    <p>
                        Given an aggregation function agg(·), we must define a custom function 𝑓<sub>𝑘</sub> : 𝑤<sub>𝑢𝑣</sub> → R<sub>+</sub> that standardizes the relationship 𝑤𝑢𝑣 between nodes in each entity relationship network 𝐺<sub>𝑘</sub> for 𝑘 ∈ 1, ..., 𝑁. The aggregation function agg(·) could be any combination of terms, such as a sum or average.
                    </p>
                    <p>
                        We define our collapse function 𝐶(·) as
                        <br>
                        <br>
                        <code>
                            𝐶(𝑢, 𝑣) = agg(𝑓<sub>1</sub>(𝑤<sub>𝑢𝑣</sub>),...,𝑓<sub>𝑁</sub>(𝑤<sub>𝑢𝑣</sub>))
                        </code>
                        <br>
                        <br>
                        We then arrive at our aggregated entity relationship network 𝐺&#770; = (𝑉, 𝐸&#770;, 𝑤&#770;), where 𝑤&#770;<sub>𝑢𝑣</sub> = 𝐶(𝑢, 𝑣) ∀𝑢, 𝑣 ∈ 𝑉. As an example, consider the following:
                    </p>
                    <p>
                        Suppose we obtain five datasets, three of which connect Company A to Company B, and two of which connect Company A to Company B but not to Company C. Each dataset could represent its own relationship graph. However, all five could be combined into one aggregated relationship network (illustrated in figure 7). We propose the above method to weight the edges representing relationships between entities to encapsulate that we cannot know with certainty whether data sharing is occurring.
                    </p>
                    <figure>
                        <img src='graphs/agg_reg.png' style='max-width:450px;'>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 7: Aggregation example of 5 relationship entity graphs with 3 nodes.
                        </figcaption>
                    </figure>
                    <h4>4.3.1&nbsp;&nbsp; Comparison of Potential Aggregation Functions</h4>
                    <p>
                        Once we have a standardized confidence score provided by the functions 𝑓<sub>𝑘</sub>(·) (described in section 4.3.2), we have many choices for the aggregation function agg(·). Let 𝑓<sub>𝑘</sub>(𝐺<sub>𝑘</sub>) denote the function mapping every edge weight in the edge set of 𝐺<sub>𝑘</sub> to a standardized confidence score.
                        <ul>
                            <li>
                                <i>agg(𝐺<sub>𝑀</sub> ) = average(𝑓<sub>1</sub>(𝐺<sub>1</sub> ),...,𝑓<sub>𝑁</sub> (𝐺<sub>𝑁</sub> ))</i>: Using an average may result in lost information - if there is a single source with high confidence, that instance would be lost in the average with many smaller instances.
                            </li>
                            <li>
                                 <i>agg(𝐺𝑀 ) = </i>&sum;<sub>𝑘=1</sub><sup>𝑁</sup><i> 𝑓<sub>𝑘</sub> (𝐺<sub>𝑘</sub> )</i>: Using a sum as an aggregation would result in an opposite problem as the previous point. Suppose we have many low-confidence weights and they are added together, resulting in a single high confidence weight in the aggregated network. Since we likely do not want to convey a high confidence in such a relationship, this represents a problem.
                            </li>
                            <li>
                                 <i>agg(𝐺<sub>𝑀</sub>) = max<sub>1≤𝑘≤𝑁</sub> (𝑓<sub>1</sub> (𝐺<sub>1</sub> ),...,𝑓<sub>𝑁</sub> (𝐺<sub>𝑁</sub> ))</i>: Taking the maximum over confidence weights is the most promising aggregation function we have come up with so far. Low confidence scores do not convey a confidence that there is not a sharing relationship between two entities, only that the evidence for it is not apparent from their methods. If someone comes up with conclusive evidence, we want it to be reflected in the aggregated entity relationship network.
                            </li>
                        </ul>
                    </p>
                    <h4>4.3.2&nbsp;&nbsp; Parameterized 𝑓<sub>𝑘</sub></h4>
                    <p>
                         The weight 𝑤<sub>𝑢𝑣</sub> for each network layer must be described. A confidence scoring must be given with respect to the source of the network. Currently, the primary source of these discovered networks is via academic study such as those discussed in related works. Another source is via disclosure policy afforded by regulation.
                    </p>
                    <p>
                        An academic study produces a graph of binary connections with a degree of confidence. This confidence is based on the strength of the study. Closer scrutiny of a given study may cause one to notice ambiguity in control. This is due to the fact a given study may capture a wide range of features for the sake of generating a response from some entity. These features range from the set of devices being used to the personas employed.
                    </p>
                    <p>
                        Advertisers ultimately make decisions based on some demographic. Browsing history helps determine the correct demographic. This observation gives insight into implicit features a study may explore which then can be used to determine its own confidence score. Table 2 begins to highlight the features which contribute to these inferences.
                    </p>
                    <p>
                        Given some <i>&lt;Persona&gt;</i>, an <i>&lt;Entity&gt;</i> will seek to find a match to some subset of <i>&lt;Demographics&gt;</i> in combination with a subset of <i>&lt;Content Categories&gt;</i>, (of which a <i>&lt;Persona&gt;</i> is also defined as the combination of these two subsets.) Which features can be used to infer these combinations? The answer to this question is discovered by tracing the the possible productions of the grammar given in Table 2. Each non-terminal used in a production plays a role in strengthening the confidence of the production; something which is required for developing a confident weight 𝑤<sub>𝑢𝑣</sub>.
                    </p>
                    <figure>
                        <code>
                            <pre class='code info-code' style='margin:auto;'>
        &lt;Aggregation&gt; :: (&lt;Personas&gt; | &lt;Devices&gt;)
                         &lt;Platforms&gt;

           &lt;Personas&gt; :: &lt;Persona&gt; &lt;Personas&gt; | ∅

            &lt;Persona&gt; :: &lt;Browsing History&gt;
                         &lt;Disclosure History&gt;

   &lt;Browsing History&gt; :: &lt;Platforms&gt; &lt;Devices&gt;

          &lt;Platforms&gt; :: &lt;Platform&gt; &lt;Platforms&gt; | ∅

           &lt;Platform&gt; :: &lt;Target Demographics&gt;
                         &lt;Content Categories&gt;
                         &lt;Entities&gt; &lt;Devices&gt;

            &lt;Devices&gt; :: &lt;Device&gt; &lt;Devices&gt; | ∅

             &lt;Device&gt; :: &lt;Hardware&gt; &lt;Software&gt;

           &lt;Entities&gt; :: &lt;Entity&gt; &lt;Entities&gt;

             &lt;Entity&gt; :: &lt;Tracker&gt; | &lt;Advertiser&gt; |
                         &lt;Platform&gt; | ∅

            &lt;Tracker&gt; :: &lt;Target Demographics&gt;
                         &lt;Content Categories&gt;

         &lt;Advertiser&gt; :: &lt;Target Demographics&gt;
                         &lt;Content Categories&gt;

&lt;Target Demographics&gt; :: &lt;Demographic&gt; &lt;Demographics&gt;

       &lt;Demographics&gt; :: &lt;Demographic&gt; &lt;Demographics&gt; | ∅
                            </pre>
                        </code>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Table 2: Interplay of Entities and Persona can be surmised using BNF notation. <i>&lt;Aggregation&gt;</i> is representative of the means in which inferences can be made: via research or disclosure.
                        </figcaption>
                    </figure>
                    <p>
                        This schema is also capable of considering productions that are <i>only</i> inferred from a <i>&lt;Persona&gt;</i>. This is indicative of an alternative form of aggregation - legal disclosure. How this type of production is weighted against another hinges upon discussion in section 4.4. The level of confidence in these types of productions also hinges on how well defined the non-terminals are. If an individual decides to contribute to the aggregated network by disclosing only the entities involved and not their own browsing history, then the effect this layer has on others should be less than one which discloses browsing history.
                    </p>
                    <p>
                        It can be observed that a production leads to non-terminal which itself does not make a production. These terms, like the others, are indicative of another set of information. These sets are dependent on the business rules set in place by the market being examined.
                    </p>
                    <p>
                        The semantics of <i>&lt;Hardware&gt;</i> and <i>&lt;Software&gt;</i> is dependent upon what is available to the public for use. <i>&lt;Hardware&gt;</i> can be the set of hardware components that compose a device. <i>&lt;Software&gt;</i> can be evaluated as the pieces of software, and their properties, that are used to interact with the ecosystem. This can ultimately represent a device fingerprint. The semantics of <i>&lt;Content Categories&gt;</i> and <i>&lt;Demographic&gt;</i> are more in tune with <i>&lt;Entity&gt;</i> expectations. These semantics provide the semantics of what a <i>&lt;Persona&gt;</i> is, which is ultimately what an <i>&lt;Entity&gt;</i> is interested in and attempts to infer.
                    </p>
                    <p>
                        To define these sets is another combinatorics problem which requires more insight into the ecosystem at play. To gain this insight requires further study which constrains the control to garner reaction on a tighter range of features. Insight can also be gained by the inclusion of more datasets as network layers which will help provide a correlation between various subsets of features and thus improving confidence overall. How a given network layer chooses to define some weight 𝑤<sub>𝑢𝑣</sub> needs to consider all these factors in order to help an aggregated network have optimal confidence.
                    </p>
                    <h3>4.4&nbsp;&nbsp;&nbsp; Disclosure Reliability Analysis</h3>
                    <p>
                        As described above in section 3.2, there exist legal frameworks that require entities to disclose information to individuals about the possession and sharing activity of personal information, such as GDPR or CCPA right to access. Although individuals can contact data protection authorities in Europe to verify GDPR right to access requests, that can be time consuming. In the US, enforcement is limited or non-existent, and no such auditing framework exists.
                    </p>
                    <p>
                        An individual with an incomplete right to access disclosure or one with dubious veracity given to them has no recourse. How can they verify the declared third-party sharing of their data is accurate or complete? This motivates the question of how to validate and audit individual disclosures, i.e., determine whether the company is omitting details.
                    </p>
                    <p>
                        We assume that false disclosures will only exhibit false negatives, i.e., the entity is not telling the whole truth. Our proposed framework can expose some of these instances of non-compliance. One such example would be if a disclosure reveals wide-spread data sharing, but is missing some entities which share high-confidence relationships with the original data aggregator.
                    </p>
                    <p>
                        Using the aggregated relationship network described in section 4.3, we may compare the set of expected data sharing instances with the set of reported instances.
                    </p>
                    <h3>4.5&nbsp;&nbsp;&nbsp; Observing Missing Data Transmission Links</h3>
                    <p>
                        Suppose we observe the presence of an individual’s personal data possessed by a set of entities within the aggregated relationship network, where the data was only given to a proper subset of those entities. If the nodes in which we observe that possession are not directly connected by edges, how did the data flow between them?
                    </p>
                    <p>
                        We can infer these flows of data in a similar fashion to the missing infections problem outlined in Rozenshtein <i>et. al</i>. <a href='#references10'>[10]</a>, by constructing a minimum Steiner tree using the observed nodes as terminals and computing over the inverse edge weights.
                    </p>
                    <h5 style='margin-bottom:0px;'>Definition 1. Minimum Steiner Tree</h5>
                    <p style='margin-top:0px;'>
                        A minimum Steiner tree 𝑇 is a minimum spanning tree (MST) which contains a subset of nodes (terminals) 𝑉<sub>𝑇</sub> ⊆ 𝑉 .
                    </p>
                    <p>
                        We formally state the problem as follows:
                        <ul>
                            <li>
                                Given: An aggregated relationship network 𝐺&#770;<sub>𝑝</sub> = (𝑉 ,𝐸&#770;,𝑤&#770;<sub>𝑖𝑗</sub><sup>𝑝</sup> )(where 𝑤&#770;<sub>𝑖𝑗</sub><sup>𝑝</sup> = (1/𝑤&#770;<sub>𝑖𝑗</sub>)), a set of observed data possessions, and a network diffusion model M.
                            </li>
                            <li>
                                Find: A Steiner tree whose node set represents inferred data possessions.
                            </li>
                        </ul>
                    </p>
                    <p>
                        We acknowledge this is a simplification of any actual algorithms that may be developed since the minimum steiner tree problem is known to be NP-hard <a href='#references10'>[10]</a>. The context of the problem is extremely relevant in the development of approximation algorithms in this setting. Approximate solutions must not generate trees that are extremely unlikely given the terminals, so approximation guarantees are necessary to establish confidence in any solutions.
                    </p>
                    <h3>4.6&nbsp;&nbsp;&nbsp; Additional Relationship Inferrence</h3>
                    <p>
                        In order to bolster our existing network, we may infer additional sharing relationships using the output we generate in section 4.5. This application is less broad, but we illustrate it through an example below.
                    </p>
                    <div class='aside' style='margin:0px;'>
                    <figure>
                        <img src='graphs/aern_5x5.png'>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;'>
                            Figure 8: Example aggregate entity relationship network with 5 nodes and 5 edges.
                        </figcaption>
                    </figure>
                    <p>
                        Return to the case of five datasets compiled into one aggregated entity relationship network, as below, but this time with five nodes, 𝑉 = {𝐴, 𝐵,𝐶, 𝐷, 𝐸}, with an edge set {𝐸<sub>1</sub>, 𝐸<sub>2</sub>, 𝐸<sub>3</sub>, 𝐸<sub>4</sub>, 𝐸<sub>5</sub>} = {(𝐴, 𝐵, 0.6), (𝐵, 𝐷, 0.9), (𝐴,𝐶, 0.1), (𝐶, 𝐷, 0.1), (𝐶, 𝐸, 0.1)} as seen in figure 8.
                    </p>
                    <figure class='responsive_aside' style='max-width:400px;'>
                        <img src='graphs/aern_5x5.png' style='max-width:200px;'>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 8: Example aggregate entity relationship network with 5 nodes and 5 edges.
                        </figcaption>
                    </figure>
                    <p>
                        Consider Figure 9a. This represents an individual providing data to Company A, and at some later time, receiving an inquiry from Company D. The data has clearly travelled from Company A to Company D, but due to the black box nature of data sharing between data aggregators, the route is unclear. With an aggregated network of confidence scores such as this proposed framework, a researcher could infer with higher confidence that the data travelled the green route through Company B to Company D, and might have higher confidence in dismissing the orange route through Company C. Then, they could infer that Company B holds the data.
                    </p>
                    <p>
                        However, they could further reexamine the confidence network, with the new data point that they have just witnessed of spread from Company A to Company D. This section of the research inquiry suggests that a framework of aggregated relationship networks could account for an evolution of confidence scores as new data becomes available. Perhaps a researcher could now infer a higher strength of relationship between Companies A and B and B and D, having witnessed real data spread between the two.
                    </p>
                    </div>
                    <p>
                        A more stark example appears in the below 𝐹𝑖𝑔𝑢𝑟𝑒 (𝑏), with an edge set with an edge set {𝐸1, 𝐸2, 𝐸3, 𝐸4, 𝐸5} = {(𝐴, 𝐵, 0.4), (𝐵, 𝐷, 0.4), (𝐴,𝐶, 0.4), (𝐶, 𝐷, 0.1), (𝐶, 𝐸, 0.1)}. This represents an individual providing data to Company A, and at some later time, receiving an inquiry from Company E. Again, data spread has occurred between Company A and Company E through some path, but in this case, working from the current known networks, a researcher could infer that Company C passed the data to Company E and that Company C holds the data. The researcher can also be more confident that the data travelled the blue route through Company C, and dismiss the purple route with more confidence.
                    </p>
                    <figure class='fig-col'>
                        <figure class='graph'>
                            <img src='graphs/saern01.png' style='max-width:200px;'>
                            <figcaption>
                                (a) Path tracking of data from primary source 𝐴 to final source 𝐷.
                            </figcaption>
                        </figure>
                        <figure class='graph'>
                            <img src='graphs/saern02.png' style='max-width:200px;'>
                            <figcaption>
                                (b) Path tracking of data from primary source 𝐴 to final source 𝐸.
                            </figcaption>
                        </figure>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 9: Examples of data injected into networks.
                        </figcaption>
                    </figure>
                    <p>
                        In this example, it seems that the data was shared from Company A to Company C to Company E. Previously, the relationship network had assigned a low confidence score to the relationships between each of these node. With the new information of data spread from Company C to Company E, the relationship network could be altered in two ways:
                        <ol>
                            <li>
                                Suppose that an entity node 𝐹 is missing, which has a strong confidence score relationship to both Company A and Company 𝐸.
                            </li>
                            <li>
                                Consider that the new data regarding data spread increases our confidence that strong relationships exist between 𝐴, 𝐶 and 𝐸, and increase each confidence score for 𝐸3 and 𝐸5.
                            </li>
                        </ol>
                    </p>
                    <h3>4.7&nbsp;&nbsp;&nbsp; Estimating Proliferation Risk Given Initial Entry Points</h4>
                    <p>
                        If you are a consumer considering giving a certain piece of personally identifiable information to a company, how would you know the risk that entails? Assuming you are aware of the general privacy risks of sharing data, how can you make an informed decision about how much to share? By analyzing the output of network diffusion models over an aggregated relationship network, we may gather estimates about how prolifically that data will spread dependent upon where it is added into the network. In this setting, we hypothesize that the level of proliferation is highly dependent upon the topology of the network, such as in Ganesh <i>et. al</i> <a href='#references8'>[8]</a>.
                        <ul>
                            <li>
                                Given: An aggregated relationship network 𝐺&#770; = (𝑉, 𝐸&#770;, 𝑤&#770;<sub>𝑖𝑗</sub>), a set of hypothetical data possessions (initial points), and a network diffusion model M.
                            </li>
                            <li>
                                Find: The expected data proliferation across 𝐺&#770; of the PII in the entry points.
                            </li>
                        </ul>
                        One way to model this diffusion process is to convert the edge weights to be interpreted as probabilities and run an independent cascade simulation over it.
                    </p>
                    <h2>5&nbsp;&nbsp;&nbsp;&nbsp; Translation to consumer-facing API</h2>
                    <p>
                        For this framework to provide a viable effect as an auditing tool to compare hypothesized data spread, it must exist in a user-interface. We propose a web app with an API that would allow for simple interaction between individuals and the proposed framework (see figure 10).
                    </p>
                    <figure>
                        <img src='graphs/disclosure_ui.png' style='border:solid 3px #CCCCCC'>
                        <figcaption style='clear:both;text-align:center;padding-top:5px;font-weight:bold;'>
                            Figure 10: Possible mock wireframe of a user interface interacting with an API for the proposed relation network auditing framework.
                        </figcaption>
                    </figure>
                    <p>
                        The proposed web app should have the following functions:
                        <ul>
                            <li>Users can can view and explore the aggregate network by means of moving and zooming to get a high level understanding of the data sharing network.</li>
                            <li>Users can click and drag to redraw and realign the network for different types of views.</li>
                            <li>Users can add new data by use of the API to mock and envision possible variations of the network.</li>
                            <li>Users can split and explore the composite relational networks to see the different individual networks that make up the aggregate network.</li>
                            <li>Users can adjust confidence scores to see hypothesized shifts in related confidences.</li>
                            <li>Users can search and filter by entity, confidence scores, or paths to get a clearer picture of how data might spread under different types of conditions and scenarios.</li>
                            <li>Users can set and save possible data spread paths to audit their existing hypothesized data spread.</li>
                        </ul>
                    </p>
                    <p>
                        Offering such a web app could be done in a centralized manner, where each user has access to the same instance of the framework that is built on verified data, and additional data that is submitted is thoroughly vetted before being added to the framework for others to see and use. Giving each user a unique instance of the network that they can edit for themselves, where the framework only offers some baseline data that isn’t necessarily verified, would likely be a better solution for a number of reasons. This is explored further in section 7.
                    </p>
                    <p>
                        It should be noted that different types of representations could also be conceived, such as desktop or mobile application, however a web app would have the lowest barrier to entry both in terms of development and usage.
                    </p>
                    <h2>6&nbsp;&nbsp;&nbsp;&nbsp; Verification of methods</h2>
                    <p>
                        Since an actual ground truth (see section 7.1) concerning how data spreads, (which may not be viably represented given the complexity of the process), methods like the ones discussed in this paper will likely never be able to be thoroughly validated, but they may be able to garner insight into some of the dynamics of aggregated relationship networks. One method of validating our methods would be to generate a synthetic "ground truth" network as well as a set of synthetic individual entity relationship as described in section 4.2.2. Solutions to our problems would then be compared to the behavior of data spread in the ground truth network.
                    </p>
                    <h2>7&nbsp;&nbsp;&nbsp;&nbsp; Discussion</h2>
                    <h3>7.1&nbsp;&nbsp;&nbsp; Limitations</h3>
                    <p>
                        The ground truth, what is occurring in the real world, versus the aggregated relationship graph is a main point of contention when discussing this framework. The real world contexts in which the framework can be used is limited, however as a general tool for individuals and researchers to gauge a measure confidence it can be highly effective. This is obviously dependent on the data that is used within the framework.
                    </p>
                    <p>
                        Many problem settings are highly dependent upon the accuracy of the aggregated relationship network. If two entities are connected through another and we accuse the middleman of sharing data when the other two were in fact sharing directly (but not reflected by the network), the accusation would be unjust. Warranting such accusations requires a much finer level of evidence and isn’t the main objective for the proposed framework.
                    </p>
                    <p>
                        How data is shared in the real world obviously varies from one entity to another. Whether data is shared between entities is one question, however what kind of data and in what format and context it is shared is another question, an arguably much more difficult one at that. Creating high level abstractions of data sharing will only tell part of the story, and the further up in abstraction one goes, the less details of the real interactions that are occurring are kept. Finding the right level of abstraction for the use case in question is key, and it seems that the proposed framework is positioned where it needs to be with currently available information and methodologies to answer the questions many individuals and researchers pose.
                    </p>
                    <p>
                        The precision of the confidence score ultimately relies upon the given data. Creating a precise network with representative confidence scores is only possible by developing methods that extract the obfuscated information from the black box that is in the middle of an-arms race. With increasing legislation, required disclosures, and a growing number of researchers devising methods to gather this information, it seems that the proposed confidence scores, and in turn the framework, will have great utility.
                    </p>
                    <h3>7.2&nbsp;&nbsp;&nbsp; Possible Extensions</h3>
                    <p>
                        A natural extension of this project would be to increase the types of data the framework can work with. Similar to the idea discussed in section 5, allowing data to be supplied by means of an API that accepts different types of files would help by making any work done with the framework much more streamlined. Ideally, this should allow both individual data points and data sets. Beyond this, allowing data that isn’t binary and weighing it appropriately, similar to the binary relationships, would help when more detailed information about relationships is available.
                    </p>
                    <p>
                        The framework is intended to be an auditing tool for individuals and researchers, however an entity could also use the framework in an adversarial sense. Considering a publicly accessible implementation of the framework with the option of anyone being able to contribute to a centralized multi-layer graph, an arms-race between auditors and entities could ensue, similar to that currently seen in the online privacy ecosystem. Obfuscation of the relationships between entities in this manner would essentially be an extension of the obfuscation occurring in the context of the advertising network black box discussed in section 2.1. Publishing an accessible and modifiable implementation of this framework should be done with caution. Datasets must be carefully considered and any individual data points should be well backed. Ultimately, it comes to verification in the aforementioned issue of the ground truth versus an aggregated relationship graph.
                    </p>
                    <h2>References</h2>
                    <ul style='list-style-type:none;'>
                        <li id='references1'>
                            [1] M.A. Bashir and C. Wilson. Diffusion of User Tracking Data in the Online Advertising Ecosystem. Proceedings on Privacy Enhancing Technologies (PETS). 2018.
                        </li>
                        <li id='references2'>
                            [2] M.A. Bashir, S. Arshad, W. Robertson, and C. Wilson. Tracing Information Flows between Ad Exchanges Using Retargeted Ads. Proceedings of the 25th USENIX Conference on Security Symposium, USENIX Association. 481-496, 2016.
                        </li>
                        <li id='references3'>
                            [3] M. Bin Musa and R. Nithyanand. ATOM: Ad-Network Tomography. Proceedings on Privacy-Enhancing Technologies Symposium. 295–313, 2022.
                        </li>
                        <li id='references4'>
                            [4] J. Cook, R. Nithyanand, and Z. Shafiq. Inferring Tracker-Advertiser Relationships in the Online Advertising Ecosystem using Header Bidding. Proceedings on Privacy-Enhancing Technologies Symposium. 65-82, 2020.
                        </li>
                        <li id='references5'>
                            [5] Built With. 2023. Available from: https://pro.builtwith.com/report/export/48d5ac51-1c24-4df8-944d-d05b5ff8d032
                        </li>
                        <li id='references6'>
                            [6] Enlyft. 2023. Available from: https://enlyft.com/tech/products/googledoubleclick
                        </li>
                        <li id='references7'>
                            [7] European ePrivacy Directive. 2011. Available from the European Data Protection Supervisor at: https://edps.europa.eu/data-protection/our-work/subjects/eprivacy-directive_en
                        </li>
                        <li id='references8'>
                            [8] A. Ganesh, L. Massoulie, and D. Towsley. The effect of network topology on the spread of epidemics. Proceedings IEEE 24th Annual Joint Conference of the IEEE Computer and Communications Societies. 1455-1466, 2005.
                        </li>
                        <li id='references9'>
                            [9] B. Rose. The Commodification of Personal Data and the Road to Consumer Autonomy Through the CCPA. Brooklyn Journal of Corporate, Financial, and Commercial Law. 2021.
                        </li>
                        <li id='references10'>
                            [10] P. Rozenshtein, A. Gionis, B.A. Prakash, and J. Vreeken. Reconstructing an Epidemic Over Time. Association for Computing Machinery. 1835–1844, 2016.
                        </li>
                        <li id='references11'>
                            [11] N.Samarin, S. Kothari, Z. Siyed, P. Wijesekera, J. Fischer, C. Hoofnagle, and S. Egelman. Investigating the Compliance of Android App Developers with the CCPA. IEEE Security, 2021.
                        </li>
                        <li id='references12'>
                            [12] M. Van Nortwick and C. Wilson. Setting the Bar Low: Are Websites Complying with the Minimum Requirements of CCPA. Proceedings on Privacy-Enhancing Technologies Symposium. 2022.
                        </li>
                        <li id='references13'>
                            [13] N. Moshiri. The dual-Barabási-Albert model. arXiv physics.soc-ph. 2018.
                        </li>
                        <li id='references14'>
                            [14] R. Albert and A. Barabási. Statistical mechanics of complex networks. Reviews of Modern Physics. 1-74(47-97), 2002.
                        </li>
                    </ul>
                    <!--section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>

                        </p>
                        <hr>
                    </section-->
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>

