<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
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
<?php
    require($root_directory."code_footer.html");
?>
