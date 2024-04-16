<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'https://alanmckay.blog/projects/safety/';

$title = 'Alan McKay | Project | Cycling Safety Database';

$meta['title'] = 'Alan McKay | Cycling Safety Database';

$meta['description'] = "Project description of building a PostGIS database which cumulates DOT traffic information to provide safety insights for cyclists.";

$meta['url'] = 'https://alanmckay.blog/projects/safety/';

$relative_path = "../../";

include('../../header.php');

?>
        <section id='writingsWrapper' style='min-width:300px;'>
            <section>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>
                            A primary facet to continuing my education through graduate school is to hone my ability to effectively
                            communicate with people of other disciplines. Iowa city has done a good job facilitating this. It is here
                            that people seem to be more receptive to general discourse. Being an instructor at the university has also
                            exposed me to interactions with people of different majors and has given insight to how one of a particular
                            study may tend to think in terms of solving a problem.
                        </p>
                        <p>
                            Ultimately, a computer scientist is tasked with building a logical model to solve some real world problem.
                            The study of the algorithm is a means to generalize problem solving; it is a means to be exclusive from some
                            domain. Having a firm grasp on this should allow one to step into any domain and solve the problems specific
                            to that domain. They may not be as up to speed as one who has been immersed, but it does not take long for a
                            good computer scientist to get there.
                        </p>
                        <p>
                            When I first started my studies, one of the classes during the first semester at community college was a
                            database design course. This was necessary to understand how a website may store information. I learned a
                            structured query language before any markup language and before any scripting language.
                        </p>
                        <p>
                            I’ve learned a lot since then. During the fall semester of 2022 I decided to circle back to the study of
                            databases. This time in a new domain - Geography. I took the upper-level Introduction to Geographic Databases
                            course to get a good feel of the functionality of a database management system such as PostGIS.
                        </p>
                        <p>
                            The following is a report pertaining to a project started within this course. Work is still being done here;
                            it is incomplete. I believe these efforts are worthwhile beyond the coursework. The section describing the
                            motivation of the project should make this apparent. It is hopeful that the general idea can be integrated
                            into any applicable service, if not implemented as a service others may use.
                        </p>
                    <hr>
                    </section>
                    <header>
                    <h1>
                        Database Extension Gauging Cycling Safety
                    </h1>
                    </header>
                    <h2>Motivation</h2>
                    <p>
                        Bicycling safety is a question often avoided. This is in part due to the wider culture being subservient to
                        the automobile. The cyclist is an annoyance to the car and the car is an annoyance to the cyclist. As a
                        result, firm opinions are rooted in terms of who is to blame for these inconveniences. To provide a safe
                        environment for one to cycle is an inconvenience to anyone driving a car, (and the taxpayer who doesn't
                        cycle), thus change likely doesn't occur. The best option a cyclist often has is to try to avoid traffic.
                    </p>
                    <p>
                        There exists a set of resources a cyclist can take advantage of to gauge safety. Google maps may
                        highlight trails that are commutable which are exclusive from automobile access. These maps may not
                        be complete. Bikemaps.org is a resource for cyclists to communicate frequently traveled cycling routes
                        in tandem with providing map pins to communicate cycling incidents. These incidents include bicycle
                        collisions, near misses, hazards, and thefts. Unfortunately, the data set for these cycling incidents and
                        routes are solely dependent on explicit contribution, and thus don't give a complete gauge of safety.
                        Iowa, for example, only has two incidents noted and pinned. Five more can be added from personal
                        experience.
                    </p>
                    <p>
                        This motivates the question of what other, (more complete), data sources can be used to help gauge
                        overall cycle safety. The department of transportation provides two interesting sets that may help an
                        individual gauge this:
                    </p>
                    <ul>
                        <li>
                            Authoritative Annual Average Daily Traffic (AADT) volume is a spatial set of data in which traffic
                            volume is measured for a wide range of roadways. Here, each roadway has this measure
                            associated with its geographic description. This will give a cyclist a relative idea whether a road
                            is busy and thus determine whether it should be avoided or if some other route or path that
                            crosses the road should be avoided. It can also give a good idea if their cycling routes are in a
                            worrisome proximity to these roadways.
                        </li>
                        <li>
                            Iowa Crash Vehicle Data (SOR) is a spatial set of data in which traffic crashes and their
                            geographic coordinates are reported. These coordinates can be used to further determine
                            overall safety - an area of a road with more crashes reported is less safe than those with lesser.
                        </li>
                    </ul>
                    <p>
                        Adding these two sources of information to a platform, (such as bikemaps.org), can allow a user to
                        determine which of the cycling routes are more safe or less safe. It seems that bikemaps.org does not
                        allow a user to take advantage of viewing their individual Strava cycling activities in this context. One
                        cannot sign in and view their Strava activity routes and query where these routes meet proximity or
                        cross potentially dangerous roadways.
                    </p>
                    <p>
                        Thus, an infrastructure needs to be added to allow a user to sign on, authenticate, and associate their
                        activities from Strava to the routes displayed in such a system. This motivates the creation of a database
                        for this project - to house user information that can be associated with activity information which is
                        geometrically associated with traffic volume (AADT) and crash vehicle data (SOR).
                    </p>
                    <p>
                        The following is a UML diagram describing such a database:
                    </p>
                    <a href='./images/erd-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure>
                            <img src='./images/erd-gis.webp' alt='A UML diagram describing the database discussed in this report.'/>
                            <figcaption>
                                Preliminary UML diagram
                            </figcaption>
                        </figure>
                    </a>
                    <h2>Data</h2>
                    <p>
                        Mentioned prior is a set of data sources: AADT, SOR, and Strava activities. It is indeed possible to gather
                        up these collections of data where the geographical scope involved is the entirety of the United States.
                        This is not feasible for this proof-of-concept project. Instead, the scope will be restricted to the state of
                        Iowa. Thus, the data sources used are:
                    </p>
                    <ul>
                        <li>
                            Iowa Authoritative Annual Daily Traffic (AADT) volume
                            <ul>
                                <li>
                                    <a href='https://data.iowadot.gov/datasets/IowaDOT::traffic-information/about' target="_blank" rel="noopener noreferrer">Data Source: DOT Traffic Information</a>
                                </li>
                                <li>
                                    Data attributes and types are given in the weblink above. The important/relevant
                                    attributes to be maintained are:
                                    <ul>
                                        <li>
                                            AADT: A quantity that represents the annual average daily traffic count.
                                        </li>
                                        <li>
                                            ROUTE_ID: an identifier for the geometry associated with the line.
                                        </li>
                                        <li>
                                            EFFECTIVE_START_DATE and EFFECTIVE_END_DATE.
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            Iowa Crash Vehicle Data (SOR)
                            <ul>
                                <li>
                                    <a href='https://data.iowadot.gov/datasets/IowaDOT::crash-vehicle-data-sor/about' target="_blank" rel="noopener noreferrer">Data Source: DOT Crash Vehicle Information</a>
                                </li>
                                <li>
                                    Data attributes and types are given in the weblink above. The important/relevant
                                    attributes to be maintained are:
                                    <ul>
                                        <li>
                                            OBJECTID
                                        </li>
                                        <li>
                                            CRASH_YEAR
                                        </li>
                                        <li>
                                            XCOORD and YCOORD
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <p>
                        It is likely that bikemaps.org is using Strava metro to gather anonymized cycling routes for their activity
                        reporting. Such information would be good in terms of generating estimated volume for a given cycling
                        segment. Using this data for this project has two obstacles.
                    </p>
                    <ul>
                        <li>
                            Using the Strava Metro API requires authorization which involves a timely application process.
                        </li>
                        <li>
                            The data is anonymized. This poses a problem for a user who is interested in taking a closer look
                            at their own Strava activities.
                        </li>
                    </ul>
                    <p>
                        For the scope of this project, the activity data is gathered from a personal Strava set of activities via the <a href='https://developers.strava.com/docs/reference/' target="_blank" rel="noopener noreferrer">public developer API</a>.
                    </p>
                    <h3>Data Prep</h3>
                    <h4>Using the Strava API</h4>
                    <p>
                        Strava allows API access for a developer to access the activities of a user which grants the asking
                        application permission. The process entails registering an application within Strava's system. Each
                        application has a unique client ID. Said application should direct a user to the following URL:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:125px;overflow:auto' max-height='125' src='code/01.html'>
                        </iframe>
                    </figure>
                    <p>The bracketed attributes can be described as:</p>
                    <ul>
                        <li>
                            &lt;CLIENT_ID&gt;: The unique client ID previously described.
                        </li>
                        <li>
                            &lt;APPLICATION_LOCATION&gt;: The universal resource indicator to redirect once permission is
                            granted or denied. For development, http://localhost can be used.
                        </li>
                        <li>
                            &lt;SCOPE&gt;: The scope of the read; the tier of information to be granted access. For this project,
                            activity:read_all was used. The read_all attribute allows private activities to be scraped.
                        </li>
                    </ul>
                    <p>
                        Once the redirect occurs, an authorization token is given via get parameterization. This can then be
                        used to communicate to Strava that authorization has been given. A post request to the API with the
                        client id, client secret token (given upon application creation), and authorization code generates a
                        response with an access code to use to query the API. I.e.,
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:215px;overflow:auto' max-height='215' src='code/02.html'>
                        </iframe>
                    </figure>
                    <p>
                        Responds with a user access token to be used via:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:125px;overflow:auto' max-height='125' src='code/03.html'>
                        </iframe>
                    </figure>
                    <p>
                        Which can be piped into a json file.
                    </p>
                    <p>
                        The above http GET query returns, by default, 100 activities. Let's say this information is piped into a
                        json file called morerides.json. A look through the file will expose a lot more attributes and their values
                        than what's required of this database. The attributes are listed <a href='https://developers.strava.com/docs/reference/#api-Activities-getLoggedInAthleteActivities' target="_blank" rel="noopener noreferrer">here</a>.
                    </p>
                    <p>
                        This data needs to be sanitized. A script was developed to gather this information and generate a csv file
                        which can be imported using pgadmin.
                    </p>
                    <p>
                        The python script developed for this project is as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:875px;overflow:auto' max-height='875' src='code/04.html'>
                        </iframe>
                    </figure>
                    <p>
                        This information can now be imported to a staging table. With a schema called "cycling" created, the
                        table definition can be described as:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:425px;overflow:auto' max-height='425' src='code/05.html'>
                        </iframe>
                    </figure>
                    <p>
                        Highlighted is a column called "encoded_route". Strava stores its polyline information as an encoded
                        polyline string. This is a syntax used by services such as open street map. Indeed, Strava does not inform
                        developers which geographic projection system is used. This was surmised by the fact open street map
                        uses WGS84. The fact that this data exists as an encoded datatype motivates the reason why a staging
                        table exists in the first place. This is to allow casting as a multiline datatype when populating the
                        activities table occurs. (Essentially, a transactional failsafe.)
                    </p>
                    <p>
                        The activities table is created via:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:545px;overflow:auto' max-height='560' src='code/06.html'>
                        </iframe>
                    </figure>
                    <p>
                        And the data insertion query is as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:770px;overflow:auto' max-height='770' src='code/07.html'>
                        </iframe>
                    </figure>
                    <p>
                        What has not been shared is the creation of an athletes table. This table creation is a trivial matter.
                        What's important is the join statement of the insertion query which adheres to the foreign key
                        constraint of the tables involved.
                    </p>
                    <h4>Using data of the Department of Transportation</h4>
                    <p>
                        The transition from shape file to staging table was straight forward in terms of the data associated with
                        the DOT sources. Staging tables are indeed required, though, as these data sets contain redundant
                        information, sparse data on account of the 40+ attributes for each source, and the storage required to
                        house all this. Trimming this fat will hope the project maintain scope and performance.
                    </p>
                    <a href='./images/01-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure style='border-bottom:1px solid #7b869d;border-top:1px solid #7b869d'>
                            <img src='./images/01-gis.webp' alt='A screenshot showing the significant differences in sizes between data tables.'/>
                            <figcaption>
                                Note the contrast of storage between the production tables and their staging counterparts.
                            </figcaption>
                        </figure>
                    </a>
                    <br>
                    <p>
                        The traffic volume table can be described as:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:375px;overflow:auto' max-height='375' src='code/08.html'>
                        </iframe>
                    </figure>
                    <p>
                        This contains the information that's required, and no more. There are two obstacles in terms of
                        migrating the relevant data from its staging table and the production table:
                    </p>
                    <ul>
                        <li>
                            The Spatial reference system differs with this datum. The SRID is 3857, contrary to 4326.
                            Conversion here is initially trivial, until it's realized that the measurements contain z-values.
                            Thus, the data needs to be flattened to a two-dimensional plane.
                        </li>
                        <li>
                            The data gathered from AADT contains reports from a wide range of years. It could be the case
                            that a certain road has information associated with the years 2015, 2016, and 2020. Whereas
                            another road may only have information associated with the year 2021. The most recent year
                            needs to be considered.
                        </li>
                    </ul>
                    <p>
                        The following insertion query addresses these two obstacles:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:220px;overflow:auto' max-height='220' src='code/09.html'>
                        </iframe>
                    </figure>
                    <p>
                        (Note that the shapefiles have poorly named attributes; "effective_" is the column name for the
                        attribute describing the effective start date.)
                    </p>
                    <p>
                        Migration from the SOR staging table to populate vehicle crashes within the crashes table was much
                        simpler. An application of the ST_Force2D function, along with the ST_Transform, were leveraged and
                        the range of years was restricted to any crash after 2017. (This restriction can easily be levied for
                        production deployment).
                    </p>
                    <h3>Visualizing the Data</h3>
                    <p>
                        The data can now start being used. The following figure shows the grouping of activities gathered via
                        Strava being displayed:
                    </p>
                    <a href='./images/02-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure style='border-bottom:1px solid #7b869d;border-top:1px solid #7b869d'>
                            <img src='./images/02-gis.webp' alt='A map showing a set of lines that chart cycling routes taken from Strava.'/>
                            <figcaption>
                                Mapping of Strava activities
                            </figcaption>
                        </figure>
                    </a>
                    <br>
                    <p>
                        The following shows these activities overlaying the traffic network. Keep in mind that each road segment has an associated AADT value:
                    </p>
                    <a href='./images/03-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure style='border-bottom:1px solid #7b869d;border-top:1px solid #7b869d'>
                            <img src='./images/03-gis.webp' alt='A map showing the previous strava mappings that are overlaying a set of lines describing public roads.'/>
                            <figcaption>
                                Strava activities overlaying AADT mapping
                            </figcaption>
                        </figure>
                    </a>
                    <br>
                    <p>
                        And then traffic crash reporting can be overlayed:
                    </p>
                    <a href='./images/04-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure style='border-bottom:1px solid #7b869d;border-top:1px solid #7b869d'>
                            <img src='./images/04-gis.webp' alt='A map showing the previous strava and public road mappings that are overlayed by a set of points describing locations of motorized crashes.'/>
                            <figcaption>
                                Strava activity and AADT mappings in overlayed by SOR crash plottings.
                            </figcaption>
                        </figure>
                    </a>
                    <br>
                    <p>
                        Queries gauging proximity safety can start being employed. I.e.,
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/10.html'>
                        </iframe>
                    </figure>
                    <h2>Segmentation</h2>
                    <p>
                        One facet of the database has yet to be discussed. The entity that is a Cycling Segment. The intention for
                        this table is to provide a space to house individual segments that constitute a multiline. Each segment,
                        (a single/mono-line as far as the database is concerned; not to be confused with a Strava segment), is to
                        have some quantifier which tracks the amount of activities that share it. This will allow the viewing of
                        some metric which can help determine the amount of cyclists that commute the segment which can
                        help hone safety measures. (The more cyclist that travel on a segment may be a positive indicator for
                        safety). It may also be easier to isolate which Strava activities cross a motorized roadway and help
                        measure the safety of a particular route.
                    </p>
                    <p>
                        First step of this process is to find the individual points that constitute a multiline. ST_DumpPoints is a
                        good start in this effort. It produces an index for each point being produced along with the geometry.
                        Consider the following query:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/11.html'>
                        </iframe>
                    </figure>
                    <p>
                        This query produces a set of results in which the route_id is associated with a set of points which are
                        also given an index. Let's assign this to a view called list_points. The task is now to wrap these points up
                        into individual lines. This can be accomplished with the following query:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/12.html'>
                        </iframe>
                    </figure>
                    <p>
                        What makes the above query work is the logic in the where clause. The statement "<code>lp2.path_index
                        - lp1.path_index = 1</code>" ensures that points are contiguous form a line. Performing basic algebraic
                        manipulation to the statement can help highlight this. The statement “<code>lp1.route_id =
                        lp2.route_id</code>” ensures that the points selected for the st_makeline function are only from the same
                        activity.
                    </p>
                    <p>
                        The latest selection query segments each activity into a set of mono-lines. There is one remaining
                        problem though - overlap is not factored! If these lines are to be stored in the segments table, there
                        would be a lot of redundant information stored. Consider the following figures:
                    </p>
                    <a href='./images/05-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure style='border-top:1px solid #7b869d'>
                            <img src='./images/05-gis.webp' alt='A map showing the initial Strava activity mappings where the lines are now represented by their vertices.'/>
                            <figcaption>
                                Individual plotting of vertices for each activity polyline. Scale of 1:20929. Query used was <code>SELECT * FROM list_points</code>
                            </figcaption>
                        </figure>
                    </a>
                    <br>
                    <a href='./images/06-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure style='border-top:1px solid #7b869d;'>
                            <img src='./images/06-gis.webp' alt='A map showing the vertices of the initial Strava activity mappings with a more precise scale.'/>
                            <figcaption>
                                Same plotting of vertices for activity polylines. Scale is now 1:5232; Same query as previous figure.
                            </figcaption>
                        </figure>
                    </a>
                    <br>
                    <a href='./images/07-gis.webp' target="_blank" rel="noopener noreferrer">
                        <figure style='border-bottom:1px solid #7b869d;border-top:1px solid #7b869d'>
                            <img src='./images/07-gis.webp' alt='A zoomed in scale of the initial Strava activities exposing many redundant lines.'/>
                            <figcaption>
                                Conversion of polyline vertex plotting to contiguous monolines. Scale is now 1:654.
                            </figcaption>
                        </figure>
                    </a>
                    <p>
                        This exposes a problem in terms of storage. It should not be necessary to store all these lines. The
                question is what geometric threshold should be used to consider one line segment as equivalent as
                another. Intuitively, this threshold should either be geometric scale or distance.
                    </p>
                    <h2>Current status and the future of this project</h2>
                    <p>
                        The problem exposed in the previous section is a problem yet to be solved. It is uncertain if there exists
                        a geometric function, (or set of functions), within postgres to quickly help solve this issue. Alternatively,
                        a threshold of proximity needs to be discussed with someone who is close to the field of Geography.
                    </p>
                    <p>
                        Once this problem is solved, queries can be employed to show which activities include a segment that
                        either cross a motorized roadway and/or run within a certain distance of. The number of intersections
                        and distance running in proximity can be used in tandem with traffic volume measurement and crash
                        counts to present some safety measure for a region within the activity. This data can also be used in a
                        regional scope to give an idea of which regions/territories are safer for cycling.
                    </p>
                    <p>
                        The scope of this project has been from the perspective as a computer scientist instead of a geographer.
                        The primary motivation is to help a cyclist make informed decisions. Some often take the term "help" to
                        be a means to dictate through result of research and analysis. My goal has been to develop a tool others
                        may use. This goal is close to being accomplished in terms of providing a solid foundation. Once
                        achieved, the foundation may be built upon as a web application or be proposed to a group such as
                        those who maintain and develop bikemaps.org
                    </p>
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
        <script src='../../js/project_functions.js'></script>
        <script>
            setCodeSizeSliders();
        </script>
    </body>
</html>
