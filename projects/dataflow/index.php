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
                    <h2>Introduction</h2>
                    <h3>Context</h3>
                    <p>
                        Online privacy has become an increasingly pressing concern in today’s digital age. As more and more personal information is collected and shared online, users are becoming increasingly aware that their data is used for targeted advertising purposes. Targeted advertising is the practice of using data to personalize advertisements to specific individuals based on their online behaviors, a phenomenon which is often not in the general consumer’s best interest.
                    </p>
                    <p>
                        The targeted advertising ecosystem largely remains a black box, with little transparency into how user data is collected, processed, and used. This lack of transparency has led to concerns about the potential for misuse of personal data, and has made it difficult for users to understand and control their online privacy
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
                        While these methodologies are useful, they only propose absolute binary: within the metric they are using to discover communication between advertising entities, relationships exist or do not. Often, these methodologies make conclusions based purely off of the context of the specific study at hand, leading to a fragmented understanding of the targeted advertising ecosystem.
                    </p>

                    <h3>Contributions</h3>
                    <p>
                        This research proposes a framework in which the results of various privacy studies can be aggregated, in which the degree to which entities share data can be gauged. Within the the proposed framework, these relationships are predicted on a certainty gradient, by a measure of confidence derived from a multi-layer graph. This framework will help provide a more comprehensive understanding of the targeted advertising ecosystem and enable us to assess the potential ramifications more accurately.
                    </p>
                    <p>
                        The proposed framework will build upon current methodologies and their results, providing a more complete understanding of the targeted advertising ecosystem. The findings of this research will be useful for individuals who seek to better understand and navigate the complex world of targeted advertising. Therein, we aim to further decisions regarding privacy and security of user data.
                    </p>
                    <h3>Road Map</h3>
                    <p>
                        The paper will begin with an outline of the current landscape of advertising networks: how the networks interact with users, mechanisms to balance the scale of online privacy, and related previous work. Next, the paper will offer background on related technical and legal concepts, definitions, necessary methods, and the technical problems that arise from the proposed framework. To conclude, we propose requirements of a web API which could leverage our research on the user side, discuss validation of our methods, and address limitations and future work.
                    </p>
                    <h2>Motivation</h2>
                    <h3>The perimeter of the Black Box</h3>
                    <p>
                        Communication within ad networks operate as a black box, with little transparency into their inner workings, rendering detection difficult. Surface features of such networks can be determined by observing the attributes of digital advertising in web browsers. However, such methods do not provide a complete or detailed picture of the routes data travels (see figure 1). These ad networks are built by use of web tracking, which occurs via placement of various mechanisms into the browsing environment that an ad entity can use to track the user.
                    </p>
                    <figure>
                        <img>
                        <figcaption>
                            Figure 1: The advertising network black box exists as part of a system that interacts with the user by means of their interaction with a web platform as an input and advertisements for that user as an output.
                        </figcaption>
                    </figure>
                    <p>
                        Cookies are such a mechanism. Although one of their original functions was to save a user’s shopping cart between browser sessions, cookies have evolved to allow a data aggregator to gain insight into a user’s browsing history. When a user visits a web page, web scripts are inserted into the page by a tracker which can access the website’s cookies. This connection allows communication of relevant information to the black box, which produces an advertisement from another web server. Researchers can measure the origin of the scripts that exist on a web page as well as the origin of the servers that return the advertisements, but are limited in observations beyond this communication. The resulting data is a tracking domain communicating with an advertising domain. This level of communication produces the so-called perimeter of the black box.
                    </p>
                    <p>
                        Researchers have endeavored to observe communication past this perimeter. One such study observes that as the web browser loads a tracking script, the server in which the script serves may change as the page is gradually rendered.[2] This is implicit of an information flow as one server communicates to another, passing information. A browser can be instrumented to take a snapshot of each mutation of the script, which gives a more complete picture of who is talking to who and the related information flow during the execution of the script.
                    </p>
                    <p>
                        Other studies, as in [4], have focused on the surface features of Real Time Bidding (RTB) auctions, a mechanism used by trackers to sell advertising space to advertisers. Some of the communication pertaining to space bidding are handled on a client to provide a closer interface to the tracking scripts; something that can be measured by any client machine. These measurements contribute to the mapping of the advertising networks at play.
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
                    <h3>Inferring Relationships</h3>
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
                        Studies which have helped map advertising networks have sought to maximize these feature sets to produce a measurable outcome.[3] Specifically, researchers formulate online personas which are shaped to maximize the targeting of personal advertisements. The methodology involves creating fictitious online personas that represent potential users with specific interests and demographics. By interacting with the ad network, data can be collected with respect to the targeting criteria used by the network. This data can then be used by researchers to gain insight into the targeting methods used by the ad network and the types of personal data being used to inform targeting.
                    </p>
                    <p>
                        The apex of this bewildering chain of inference arms-race is encapsulated by a machine learning study which seeks to infer advertising relationships by leveraging online personas. [3] The study blocks individual trackers from a page, then gathers data points which record the change in behavior. It’s not guaranteed that a blocked tracker would have won a RTB auction, so the effect cannot be guaranteed. Site behavior can instead be predicted with a degree of confidence. Thus, the resultant data acts as a training set for a machine learning algorithm, ATOM, which is used to make an inference of a data sharing relationship between an advertiser and a tracker. It does so with a high degree of accuracy compared to a control set.
                    </p>
                    <h3>User and Regulatory Confidence</h3>
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
                    <figure>
                        <img>
                        <figcaption>
                            Figure 2: Network Examples
                        </figcaption>
                    </figure>
                    <h3>Previous Work</h3>
                    <p>
                        Although the current research on technological privacy law is limited, scholars like Christo Wilson, Zubair Shafiq, and Rishab Nithyanand publish bodies of work which delve into the intricacies of data sharing and disclosures, and the field is ever-growing.
                    </p>
                    <p>
                        To understand and audit new privacy laws and regulations, research first needs to address the current state of the internet and where consumers’ data interests are violated. Data-sharing practices are an element of data aggregator behavior that needs further regulation.
                    </p>
                    <p>
                        In the paper "ATOM: Ad-network Tomography", Nithyanand and Bin Musa address the black box nature of data sharing between data aggregators, and acknowledge that CCPA audits are made difficult by the lack of transparency as to the routes through which data spreads. They propose a framework, ATOM, which enables tracker-blocking strategies, then observes changes in site behavior to theorize advertiser relationships where data spread occurs.[3]
                    </p>
                    <p>
                        In the paper "Tracing Information Flows Between Ad Exchanges Using Retargeted Ads", the authors track information sharing between data aggregators, and develop a new auditing mechanism for examining these relationships. The authors find that existing auditing frameworks that rely on cookie matching "are unable to identify 31% of ad exchange pairs that share data." [2].
                    </p>
                    <p>
                        The authors develop a method which tracks client-to-server-side sharing through retargeted ads. A retargeted ad is an advertisement personalized towards a user with a product they directly interacted with. For example, a Facebook ad for a Target shirt that a user had placed in their Target.com shopping cart would indicate that Facebook and Target may have a data sharing relationship. After crawling the web, the authors formulate an open-source dataset of retargeted ad relationships between data aggregators.
                    </p>
                    <p>
                        In the paper "Inferring Tracker-Advertiser Relationships in the Online Advertising Ecosystem using Header Bidding", the authors also aim to track data sharing relationships not captured by cookiesyncing studies. They propose a new system, KASHF, which uses a machine learning algorithm to predict how advertisers bid for ad space based on the information they have about users.[4]
                    </p>
                    <p>
                        The researchers focus on Header Bidding, a variation of Real Time Bidding (RTB). RTB is a mechanism that determines how ads are dynamically placed on websites for different users, by offering ad space to high-profile advertisers first, then continuing on taking bids from advertisers in a waterfall manner to fill the space. Header Bidding is a more competitive variation on RTB in which advertisers can all place bids simultaneously for ad space depending on the consumer.
                    </p>
                    <p>
                        KASHF can use Header Bidding prediction to analyze data sharing routes between entities by observing bidding by advertisers change depending on the information available to certain trackers about a consumer.
                    </p>
                    <p>
                        The paper "Diffusion of User Tracking Data in the Online Advertising Ecosystem", employs a similar philosophy to KASHF, but with Real Time Bidding instead of Header Bidding. The authors of this paper use the dataset from the paper "Tracing Information Flows Between Ad Exchanges Using Retargeted Ads", and verify these relationships depending on advertiser behavior in RTB. The authors were able to formulate inclusion trees connecting the data spread from tracker data to advertisers. The authors predict that the top advertising companies collect from 91% to 99% of user browsing data. [1][2][4]
                    </p>
                    <p>
                        The methods in the above papers vary, from observation of advertiser bidding, to tracker blocking, but the papers all focus on the same goal as this work: to explore routes through which data sharing occurs. Another similarity between these related works is the nature of their datasets. Each research group tracks relationships between advertisers, trackers, and data aggregators as binary: the relationship does or doesn’t exist. This work aims to aggregate the varying research methods in the field in a gradient, non-binary manner. We acknowledge that an outside observer cannot be sure where data sharing is occurring, and that these datasets exist on a spectrum of confidence. This auditing framework could be expanded and applied to a large body of datasets to create a true image of the state of internet data-sharing. As a proof of concept, we apply the theory to a small subset of data, addressed in section 4.1.
                    </p>
                    <h2>Background and Definitions</h2>
                    <h3>Terminology</h3>
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
                    <h3>Legal Disclosure Mechanisms</h3>
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
                    <h3>Graphs/Networks</h3>
                    <p>
                        A graph 𝐺 (see figure 3b) refers to an abstract mathematical object describing relationships between a set of nodes 𝑉 through edges 𝐸 between them. The degree of a node refers to how many edges it is connected to. The distribution of these values over the entire graph is known as the degree distribution. For some graphs most of the nodes have similar degrees (a uniform distribution) and for others there may be a few nodes with a high number of edges while the rest have a low degree (power-law distribution). Graphs can be either undirected (edges denote a 2-way connection as in figure 3a) or directed (edges denote a 1-way connection as in figure 3a). A network is what we refer to when we use a graph to model real-world relationships.
                    </p>
                    <p>
                        A multi-layer graph 𝐺ˆ(e.g., see figure 3a) is one that has a single set of nodes or points 𝑉 , but multiple types of edge sets 𝐸1, ..., 𝐸𝑁. Each edge set connects the nodes with different types of edges defined as a layer. The edge sets are used to represents varying types of relationships between nodes.
                    </p>
                    <p>
                        For example, suppose we wish to represent two different relationships between entities. Edges in the first layer represent entities that have been inferred to share data, such as in Bashir, et. al. [2]. Edges in the second layer are to be based on corporation ownership data (e.g., Lexus is owned by Toyota). Therefore, a multi-layer graph can represent the same companies, but express a distinction between different varieties of company relationships or, as we will propose, varying confidence that a relationship exists.
                    </p>
                    <figure>
                        <img>
                        <figcaption>
                            Figure 3: Graph examples
                        </figcaption>
                    </figure>
                    <h3>Network Diffusion Process</h3>
                    <p>
                        A network diffusion process M describes how spreading on networks occurs, such as infections or ideas. In this paper, we focus on the diffusion of data. Given a network 𝐺 = (𝑉 , 𝐸,𝑤) (where 𝑉, 𝐸, and 𝑤 represent nodes, edges, and weights, respectively), and an initial set of nodes which possess some personally identifiable information, a network diffusion process is defined by a set of rules which govern how the data is shared and which nodes will ultimately possess that data.
                    </p>
                    <p>
                        As an example, one such process can be defined by the independent cascade model. Let 𝐺 = (𝑉 , 𝐸) be a directed graph with node set 𝑉 and edge set 𝐸. We have a set V ⊆ 𝑉 of initially activated nodes. For this process, once a node is activated it cannot revert to being inactive. After the initial activation, we define discrete time steps 𝑡 for which the process will progress. We define the end of a diffusion process to be when no additional nodes can be activated. After a given diffusion process finishes, 𝜎(V) denotes the number of nodes we expect to be activated given the initially activated nodes V. Since these diffusion models are stochastic, 𝜎(V) is the expectation of a random variable. We will revisit this concept and its relevance in section 4.7.
                    </p>
                    <h2>Materials and Methods</h2>
                    <h3>Data</h3>
                    <h4>Cookie Disclosure Datasets</h4>
                    <p>
                        In 2011, the European ePrivacy Directive (Directive 2009/136/EC), colloquially known as the cookie law, was enacted in Europe. It requires accessible and thorough cookie disclosures from all companies collecting data in the EU, and effectively mandates companies list the types of cookies or actual cookies they use. [7]
                    </p>
                    <p>
                        Many data aggregators therefore have a section of their site with their legal documents or privacy policy containing a cookie-table or cookie-policy (see figure 1). Some companies further provide a list of companies with which they share third-party cookies for advertising or data-tracking purposes.
                    </p>
                    <figure>
                        <figcaption>
                            Table 1: Microsoft advertiser cookie disclosure table.
                        </figcaption>
                    </figure>
                    <p>
                        This data is limited by the fact that it relies on companies to self-disclose, but is easily accessible for the sake of a proof of concept graph. By web scraping for cookie-policies and tracking the standardized formatting and language of the cookie disclosure tables, we can obtain lists of data sharing relationships between data aggregators.
                    </p>
                    <p>
                        In this work, we performed a small scrape of these cookie policies, starting with Microsoft.com, then iterating through Microsoft’s declared cookie-sharing partners to find their cookie tables. With this method, we were able to identify 606 entity relationships across 32 data aggregators including Microsoft, Amazon, Adobe, Ziprecruiter, Taboola, MediaMath, Uber, and Twitter. Moreover, this method provided us with clean, standardized data as a base for the more complex research datasets we also examined.
                    </p>
                    <h4>Synthetic Data</h4>
                    <p>
                        We also outline a method to generate synthetic datasets that mimic the degree distributions of previous datasets we have inspected in section 4.2.2.
                    </p>
                    <h3>Data Processing</h3>
                    <p>
                        The purpose of processing data into a network is to enable us to solve computational problems using those relationships.
                    </p>
                    <h4>Cookie Disclosure Datasets</h4>
                    <p>
                        We process these datasets simply by taking the union of each graph. They are currently unweighted, so we only seek to connect each disclosure together. Some of these individual networks are shown in figure 4 and the aggregated network is shown in figure 5.
                    </p>
                    <figure>

                        <figcaption>
                            Figure 4: Individual networks
                        </figcaption>
                    </figure>
                    <figure>

                        <figcaption>
                            Figure 5: Aggregated network
                        </figcaption>
                    </figure>
                    <figure>

                        <figcaption>
                            Figure 6: Aggregated network degree distribution
                        </figcaption>
                    </figure>
                    <h4>Synthetic Data</h3>
                    <p>
                        We use the dual-Barabási-Albert model [13] with parameters 𝑚1 = 3, 𝑚2 = 1, and 𝑝 = 0.3. We use this model to mimic the nature of datasets inspected so far, which have a highlyconnected core and many degree-1 nodes branching out. In this model, we start with max(𝑚1,𝑚2) nodes. We then iteratively add the remaining nodes one at a time, with probability 𝑝 of having 𝑚1 edges and probability 1 − 𝑝 of having 𝑚2 edges added according to the Barabási-Albert model [14] resulting in a "ground truth" graph 𝐺. We then proceed in two phases:
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
                    <h3>Aggregating Entity Relationship Networks</h3>
                    <p>

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

