<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
status_dict = {"origin":False,"greycut":False,"temperature":False,"sweeps":dict(),"finished":0,"total":3+totalsweeps,"progress":0}

for i in range(0,totalsweeps):
    status_dict['sweeps']["sweep"+str(i)] = False

write_to_json(filename.split('.')[-2]+'-status.json',json.dumps(status_dict))
<?php
    require($root_directory."code_footer.html");
?>
