<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/writings/safety/';

$title = 'Alan McKay | Writing | Database Extension Gauging Cycling Safety';

$meta['title'] = 'Alan McKay | Database Extension Gauging Cycling Safety';

$meta['description'] = "";

$meta['url'] = 'http://alanmckay.blog/writings/safety/';

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
                    <a>
                        <figure>
                            <img />
                            <figcaption>

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
                                    <a href='https://data.iowadot.gov/datasets/IowaDOT::traffic-information/about'>https://data.iowadot.gov/datasets/IowaDOT::traffic-information/about</a>
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
                                    <a href='https://data.iowadot.gov/datasets/IowaDOT::crash-vehicle-data-sor/about'>https://data.iowadot.gov/datasets/IowaDOT::crash-vehicle-data-sor/about</a>
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
                        For the scope of this project, the activity data is gathered from a personal Strava set of activities via the
                        public developer API, (<a href='https://developers.strava.com/docs/reference/'>https://developers.strava.com/docs/reference/</a>).
                    </p>
                    <h3>Data Prep</h3>
                    <h4>Using the Strava API</h4>
                    <p>
                        Strava allows API access for a developer to access the activities of a user which grants the asking
                        application permission. The process entails registering an application within Strava's system. Each
                        application has a unique client ID. Said application should direct a user to the following URL:
                    </p>
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
https://www.strava.com/oauth/authorize?client_id=&lt;CLIENT_ID&gt;response_type=code&amp;redirect_uri=&lt;APPLICATION_LOCATION&gt;/exchange_token&amp;approval_prompt=force&amp;scope=activity:&lt;SCOPE&gt;
</pre>
                    </code>
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
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
curl -X POST https://www.strava.com/oauth/token \
-F client_id=&lt;CLIENT_ID&gt; \
-F client_secret=&lt;CLIENT_SECRET&gt; \
-F code=&lt;AUTHORIZATION_CODE&gt; \
-F grant_type=authorization_code
</pre>
                    </code>
                    <p>
                        Responds with a user access token to be used via:
                    </p>
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
http GET "https://www.strava.com/api/v3/athlete/activities" "Authorization: Bearer &lt;access token&gt;"
</pre>
                    </code>
                    <p>
                        Which can be piped into a json file.
                    </p>
                    <p>
                        The above http GET query returns, by default, 100 activities. Let's say this information is piped into a
                        json file called morerides.json. A look through the file will expose a lot more attributes and their values
                        than what's required of this database. The attributes are listed here: <a href='https://developers.strava.com/docs/reference/#api-Activities-getLoggedInAthleteActivities'>https://developers.strava.com/docs/reference/#api-Activities-getLoggedInAthleteActivities</a>
                    </p>
                    <p>
                        This data needs to be sanitized. A script was developed to gather this information and generate a csv file
                        which can be imported using pgadmin.
                    </p>
                    <p>
                        The python script developed for this project is as follows:
                    </p>
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
with open('morerides.json','r') as rides_file:
    rides_data = json.load(rides_file)

csv_string = "activity_id,athlete_id,route_id,route,type,location_country"
csv_string = csv_string + ",start_date,start_date_local,timezone\n"

for ride in rides_data:
    if ride['map']['summary_polyline'] and ride['map']['summary_polyline'] != '':
        #gather values:
        activityId = ride['id']
        athleteId = ride['athlete']['id']
        routeId = ride['map']['id']
        route = ride['map']['summary_polyline']
        type = ride['type']
        locationCountry = ride['location_country']
        startDate = ride['start_date']
        startDateLocal = ride['start_date_local']
        timezone = ride['timezone']

        #create row string
        line = str(activityId) + "," + str(athleteId) + "," + str(routeId) + ","
        line = line + str(route) + "," + str(type) + "," + str(locationCountry)
        line = line + "," + str(startDate) + "," + str(startDateLocal)
        line = line + "," + str(timezone) + "\n"

        #concatenate the row string to the csv_string
        csv_string = csv_string + line

with open('rides.csv','w') as rides_file:
    rides_file.write(csv_string)
</pre>
                    </code>
                    <p>
                        This information can now be imported to a staging table. With a schema called "cycling" created, the
                        table definition can be described as:
                    </p>
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
CREATE TABLE cycling.activities_staging
(
    activity_id BIGINT,
    athlete_id BIGINT,
    route_id varchar,
    <mark>encoded_route text COLLATE pg_catalog."default",</mark>
    activity_type char(8),
    location_country varchar,
    start_date timestamp,
    start_date_local timestamp,
    timezone varchar,
    PRIMARY KEY(activity_id)
);
</pre>
                    </code>
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
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
CREATE TABLE cycling.activities
(
    activity_id BIGINT,
    athlete_id BIGINT,
    route_id varchar,
    encoded_route text COLLATE pg_catalog."default",
    activity_type char(8),
    location_country varchar,
    start_date timestamp,
    start_date_local timestamp,
    timezone varchar,
    user_id BIGINT,
    <mark>route geometry(linestring,4326),</mark>
    PRIMARY KEY(activity_id),
    CONSTRAINT fk_athlete
    FOREIGN KEY(user_id)
    REFERENCES cycling.athletes(user_id)
);
</pre>
                    </code>
                    <p>
                        And the data insertion query is as follows:
                    </p>
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
INSERT INTO cycling.activities(
    activity_id,
    athlete_id,
    route_id,
    encoded_route,
    activity_type,
    location_country,
    start_date,
    start_date_local,
    timezone,
    user_id,
    route)
SELECT staging.activity_id,
        staging.athlete_id,
        staging.route_id,
        staging.encoded_route,
        staging.activity_type,
        staging.location_country,
        staging.start_date,
        staging.start_date_local,
        staging.timezone,
        u.user_id,
        <mark>(SELECT ST_AsEWKT(ST_LineFromEncodedPolyline(staging.encoded_route)))</mark>
            FROM cycling.activities_staging as staging
            JOIN cycling.athletes as u ON strava_athlete_id = athlete_id
;
</pre>
                    </code>
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
                    <a>
                        <figure>
                            <img />
                            <figcaption>

                            </figcaption>
                        </figure>
                    </a>
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
        <script>
            function setCodeContainerSize(){
                elements = document.getElementsByClassName('code');
                for(i=0;i<elements.length;i++){
                    element = elements[i];
                    width = window.outerWidth;
                    if (width > 800){
                        width = 800;
                    }else{
                        width = width*.9;
                    }
                    element.style.width = width + "px";
                }
            }

            window.onresize = function(){
                setCodeContainerSize();
            }

            setCodeContainerSize();
        </script>
    </body>
</html>
